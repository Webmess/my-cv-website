<?php
include 'connect.php';

// Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_education'])) {
    $institution = htmlspecialchars($_POST['institution']);
    $degree = htmlspecialchars($_POST['degree']);
    $year = htmlspecialchars($_POST['year']);
    
    $stmt = $pdo->prepare("INSERT INTO education (institution, degree, year) VALUES (?, ?, ?)");
    $stmt->execute([$institution, $degree, $year]);
}

// Read
$stmt = $pdo->query("SELECT * FROM education");
$educations = $stmt->fetchAll();

// Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_education'])) {
    $id = $_POST['id'];
    $institution = htmlspecialchars($_POST['institution']);
    $degree = htmlspecialchars($_POST['degree']);
    $year = htmlspecialchars($_POST['year']);
    
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Management</title>
</head>
<body>
    <h1>Manage Education Information</h1>

    <!-- Create Form -->
    <h2>Add Education</h2>
    <form method="post">
        <input type="text" name="institution" placeholder="Institution" required>
        <input type="text" name="degree" placeholder="Degree" required>
        <input type="text" name="year" placeholder="Year" required>
        <button type="submit" name="add_education">Add</button>
    </form>

    <!-- Display and Update Form -->
    <h2>Education List</h2>
    <table border="1">
        <tr>
            <th>Institution</th>
            <th>Degree</th>
            <th>Year</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($educations as $education): ?>
            <tr>
                <td><?= htmlspecialchars($education['institution']) ?></td>
                <td><?= htmlspecialchars($education['degree']) ?></td>
                <td><?= htmlspecialchars($education['year']) ?></td>
                <td>
                    <!-- Update Form -->
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $education['id'] ?>">
                        <input type="text" name="institution" value="<?= htmlspecialchars($education['institution']) ?>" required>
                        <input type="text" name="degree" value="<?= htmlspecialchars($education['degree']) ?>" required>
                        <input type="text" name="year" value="<?= htmlspecialchars($education['year']) ?>" required>
                        <button type="submit" name="update_education">Update</button>
                    </form>

                    <!-- Delete Link -->
                    <a href="?delete_id=<?= $education['id'] ?>" onclick="return confirm('Are you sure you want to delete this entry?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>