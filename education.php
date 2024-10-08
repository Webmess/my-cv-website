<?php
include 'connect.php';

// Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_education'])) {
    $institution = $_POST['institution'];
    $degree = $_POST['degree'];
    $year = $_POST['year'];
    
    $stmt = $pdo->prepare("INSERT INTO education (institution, degree, year) VALUES (?, ?, ?)");
    $stmt->execute([$institution, $degree, $year]);
}

// Read
$stmt = $pdo->query("SELECT * FROM education");
$educations = $stmt->fetchAll();

// Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_education'])) {
    $id = $_POST['id'];
    $institution = $_POST['institution'];
    $degree = $_POST['degree'];
    $year = $_POST['year'];
    
    $stmt = $pdo->prepare("UPDATE education SET institution = ?, degree = ?, year = ? WHERE id = ?");
    $stmt->execute([$institution, $degree, $year, $id]);
}

// Delete
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM education WHERE id = ?");
    $stmt->execute([$id]);
}
?>