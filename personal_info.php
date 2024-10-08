<?php
include 'connect.php';

// Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_personal_info'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    
    $stmt = $pdo->prepare("INSERT INTO personal_info (name, email, contact) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $contact]);
}

// Read
$stmt = $pdo->query("SELECT * FROM personal_info");
$personalInfos = $stmt->fetchAll();

// Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_personal_info'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    
    $stmt = $pdo->prepare("UPDATE personal_info SET name = ?, email = ?, contact = ? WHERE id = ?");
    $stmt->execute([$name, $email, $contact, $id]);
}

// Delete
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM personal_info WHERE id = ?");
    $stmt->execute([$id]);
}
?>