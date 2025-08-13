<?php
/**
 * Script to update volunteer_registrations table schema
 * Run this once to update the database structure for comprehensive volunteer form
 */

require_once 'backend/config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    echo "Updating volunteer_registrations table schema...\n\n";
    
    // Drop existing table
    $pdo->exec("DROP TABLE IF EXISTS volunteer_registrations");
    echo "✓ Dropped existing volunteer_registrations table\n";
    
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
    echo "✓ Created new volunteer_registrations table with comprehensive fields\n";
    
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
    echo "✓ Inserted sample volunteer registrations\n";
    
    // Verify the table structure
    $stmt = $pdo->query("DESCRIBE volunteer_registrations");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\n📋 New table structure:\n";
    foreach ($columns as $column) {
        echo "  - {$column['Field']}: {$column['Type']}\n";
    }
    
    // Count records
    $stmt = $pdo->query("SELECT COUNT(*) FROM volunteer_registrations");
    $count = $stmt->fetchColumn();
    echo "\n📊 Total volunteer registrations: $count\n";
    
    echo "\n✅ Database schema update completed successfully!\n";
    echo "\nYou can now use the updated volunteer form with comprehensive questionnaire.\n";
    
} catch (PDOException $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
