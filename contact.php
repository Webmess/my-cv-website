<?php

include 'connect.php';
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
    
    // Check if form data is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);
        
        // Prepare and execute the INSERT statement
        $stmt = $pdo->prepare("INSERT INTO contact (name, email, message) VALUES (:name, :email, :message)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        
        if ($stmt->execute()) {
            echo "Message sent successfully!";
            // Optionally, redirect back to index.html or display a success message
        } else {
            echo "Failed to send message.";
        }
    }
} catch (PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
}