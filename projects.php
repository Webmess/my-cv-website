<?php
include 'connect.php';

// Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_project'])) {
    $projectName = $_POST['project_name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    
    $stmt = $pdo->prepare("INSERT INTO projects (project_name, description, date) VALUES (?, ?, ?)");
    $stmt->execute([$projectName, $description, $date]);
}

// Read
$stmt = $pdo->query("SELECT * FROM projects");
$projects = $stmt->fetchAll();

// Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_project'])) {
    $id = $_POST['id'];
    $projectName = $_POST['project_name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    
    $stmt = $pdo->prepare("UPDATE projects SET project_name = ?, description = ?, date = ? WHERE id = ?");
    $stmt->execute([$projectName, $description, $date, $id]);
}

// Delete
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$id]);
}
?>