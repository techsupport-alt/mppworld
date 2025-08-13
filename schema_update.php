<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Database Schema</title>
    <link href="public/assets/css/tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-6">🔧 Database Schema Update</h1>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_schema'])) {
            require_once 'backend/config/database.php';
            
            try {
                $pdo = getDatabaseConnection();
                
                echo "<div class='bg-blue-900 p-4 rounded mb-4'>";
                echo "<h2 class='text-xl font-bold mb-2'>📋 Updating volunteer_registrations table schema...</h2>";
                
                // Drop existing table
                $pdo->exec("DROP TABLE IF EXISTS volunteer_registrations");
                echo "<p class='text-green-400'>✓ Dropped existing volunteer_registrations table</p>";
                
                // Create new table with comprehensive fields
                $createTableSQL = "
                CREATE TABLE volunteer_registrations (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    
                    -- Personal Information
                    full_name VARCHAR(255) NOT NULL,
                    email VARCHAR(255) UNIQUE NOT NULL,
                    phone_number VARCHAR(20) NOT NULL,
                    gender ENUM('male', 'female') NOT NULL,
                    age INT NOT NULL CHECK (age >= 16 AND age <= 100),
                    country VARCHAR(100) DEFAULT 'Nigeria',
                    state VARCHAR(100) NOT NULL,
                    church_affiliation VARCHAR(255) DEFAULT '',
                    
                    -- Volunteer Preferences
                    duration ENUM('7', '14', '21', '40') NOT NULL,
                    start_date DATE NOT NULL,
                    time_of_day ENUM('morning', 'afternoon', 'night', 'flexible') NOT NULL,
                    service_type ENUM(
                        'intercession', 
                        'technical', 
                        'ushering', 
                        'logistics', 
                        'protocol', 
                        'medical', 
                        'sanitation', 
                        'praise'
                    ) NOT NULL,
                    
                    -- Spiritual Background
                    born_again ENUM('yes', 'no') NOT NULL,
                    holy_spirit ENUM('yes', 'no') NOT NULL,
                    prayer_frequency ENUM('daily', 'weekly', 'occasionally', 'rarely') NOT NULL,
                    bible_study ENUM('daily', 'weekly', 'monthly', 'occasionally', 'rarely') NOT NULL,
                    
                    -- Emergency Contact
                    emergency_name VARCHAR(255) NOT NULL,
                    emergency_phone VARCHAR(20) NOT NULL,
                    emergency_relationship VARCHAR(100) NOT NULL,
                    
                    -- Consent Fields
                    commitment_consent TINYINT(1) DEFAULT 1,
                    devotional_consent TINYINT(1) DEFAULT 1,
                    
                    -- Metadata
                    status ENUM('pending', 'approved', 'rejected', 'active', 'completed') DEFAULT 'pending',
                    notes TEXT,
                    assigned_team VARCHAR(100),
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    
                    INDEX idx_email (email),
                    INDEX idx_service_type (service_type),
                    INDEX idx_duration (duration),
                    INDEX idx_status (status),
                    INDEX idx_start_date (start_date),
                    INDEX idx_created_at (created_at)
                )";
                
                $pdo->exec($createTableSQL);
                echo "<p class='text-green-400'>✓ Created new volunteer_registrations table with comprehensive fields</p>";
                
                // Insert sample data
                $sampleDataSQL = "
                INSERT INTO volunteer_registrations (
                    full_name, email, phone_number, gender, age, state,
                    duration, start_date, time_of_day, service_type,
                    born_again, holy_spirit, prayer_frequency, bible_study,
                    emergency_name, emergency_phone, emergency_relationship
                ) VALUES 
                (
                    'John Adebayo', 'john.adebayo@example.com', '+234-801-234-5678', 
                    'male', 28, 'Lagos',
                    '21', '2024-01-15', 'morning', 'intercession',
                    'yes', 'yes', 'daily', 'daily',
                    'Mary Adebayo', '+234-801-234-5679', 'Wife'
                ),
                (
                    'Grace Okafor', 'grace.okafor@example.com', '+234-802-345-6789', 
                    'female', 32, 'Abuja',
                    '14', '2024-01-20', 'night', 'praise',
                    'yes', 'yes', 'daily', 'weekly',
                    'Peter Okafor', '+234-802-345-6790', 'Husband'
                ),
                (
                    'David Emeka', 'david.emeka@example.com', '+234-803-456-7890', 
                    'male', 25, 'Anambra',
                    '40', '2024-01-25', 'flexible', 'technical',
                    'yes', 'no', 'weekly', 'weekly',
                    'Ruth Emeka', '+234-803-456-7891', 'Sister'
                )";
                
                $pdo->exec($sampleDataSQL);
                echo "<p class='text-green-400'>✓ Inserted sample volunteer registrations</p>";
                
                // Verify the table structure
                $stmt = $pdo->query("DESCRIBE volunteer_registrations");
                $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                echo "<h3 class='text-lg font-bold mt-4 mb-2'>📋 New table structure:</h3>";
                echo "<div class='grid grid-cols-2 gap-2 text-sm'>";
                foreach ($columns as $column) {
                    echo "<div class='bg-gray-800 p-2 rounded'>";
                    echo "<strong>{$column['Field']}</strong>: {$column['Type']}";
                    echo "</div>";
                }
                echo "</div>";
                
                // Count records
                $stmt = $pdo->query("SELECT COUNT(*) FROM volunteer_registrations");
                $count = $stmt->fetchColumn();
                echo "<p class='text-yellow-400 mt-4'>📊 Total volunteer registrations: $count</p>";
                
                echo "<p class='text-green-400 text-xl mt-4'>✅ Database schema update completed successfully!</p>";
                echo "<p class='text-blue-400'>You can now use the updated volunteer form with comprehensive questionnaire.</p>";
                echo "</div>";
                
            } catch (PDOException $e) {
                echo "<div class='bg-red-900 p-4 rounded mb-4'>";
                echo "<p class='text-red-400'>❌ Database error: " . htmlspecialchars($e->getMessage()) . "</p>";
                echo "</div>";
            } catch (Exception $e) {
                echo "<div class='bg-red-900 p-4 rounded mb-4'>";
                echo "<p class='text-red-400'>❌ Error: " . htmlspecialchars($e->getMessage()) . "</p>";
                echo "</div>";
            }
        }
        ?>
        
        <?php if (!isset($_POST['update_schema'])): ?>
        <div class="bg-yellow-900 p-4 rounded mb-6">
            <h2 class="text-xl font-bold mb-2">⚠️ Important Notice</h2>
            <p>This will update the volunteer_registrations table to support the new comprehensive volunteer questionnaire form.</p>
            <p class="mt-2"><strong>This action will:</strong></p>
            <ul class="list-disc ml-6 mt-2">
                <li>Drop the existing volunteer_registrations table (if exists)</li>
                <li>Create a new table with comprehensive fields</li>
                <li>Add sample data for testing</li>
            </ul>
            <p class="mt-2 text-red-400"><strong>Warning:</strong> Any existing volunteer data will be lost!</p>
        </div>
        
        <form method="POST" class="space-y-4">
            <button 
                type="submit" 
                name="update_schema" 
                value="1"
                class="bg-orange-600 hover:bg-orange-700 px-6 py-3 rounded text-white font-bold"
                onclick="return confirm('Are you sure you want to update the database schema? This will delete existing volunteer data!')"
            >
                🔧 Update Database Schema
            </button>
        </form>
        <?php endif; ?>
        
        <div class="mt-8">
            <a href="index.php" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded text-white">
                ← Back to Homepage
            </a>
            
            <a href="test_forms_backend.php" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded text-white ml-4">
                🧪 Test Forms
            </a>
        </div>
    </div>
</body>
</html>
