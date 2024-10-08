<?php
include 'connect.php';

// Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_experience'])) {
    $company = $_POST['company'];
    $role = $_POST['role'];
    $duration = $_POST['duration'];
    
    $stmt = $pdo->prepare("INSERT INTO experience (company, role, duration) VALUES (?, ?, ?)");
    $stmt->execute([$company, $role, $duration]);
}

// Read
$stmt = $pdo->query("SELECT * FROM experience");
$experiences = $stmt->fetchAll();

// Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_experience'])) {
    $id = $_POST['id'];
    $company = $_POST['company'];
    $role = $_POST['role'];
    $duration = $_POST['duration'];
    
    $stmt = $pdo->prepare("UPDATE experience SET company = ?, role = ?, duration = ? WHERE id = ?");
    $stmt->execute([$company, $role, $duration, $id]);
}

// Delete
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM experience WHERE id = ?");
    $stmt->execute([$id]);
}
?>