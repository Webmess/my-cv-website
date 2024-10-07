<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection details
$dsn = "mysql:host=localhost;dbname=cv_database";
$dbusername = "root";
$dbpassword = "";

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Test the connection
    $stmt = $pdo->query("SELECT 1");
    echo "Connection successful!";
} catch (PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
}
