<?php
require_once 'backend/config/database.php';

try {
    $db = new Database();
    $conn = $db->getConnection();
    
    // Check recent volunteer registrations
    $stmt = $conn->query("SELECT id, full_name, email, service_type, duration, start_date, registered_at FROM volunteer_registrations ORDER BY id DESC LIMIT 3");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Recent Volunteer Registrations:\n";
    echo "================================\n";
    foreach ($results as $row) {
        echo "ID: {$row['id']}\n";
        echo "Name: {$row['full_name']}\n";
        echo "Email: {$row['email']}\n";
        echo "Service: {$row['service_type']}\n";
        echo "Duration: {$row['duration']} days\n";
        echo "Start Date: {$row['start_date']}\n";
        echo "Registered: {$row['registered_at']}\n";
        echo "----------------------------\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
