<?php
include 'connect.php';

// Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_experience'])) {
    $company = htmlspecialchars($_POST['company']);
    $role = htmlspecialchars($_POST['role']);
    $duration = htmlspecialchars($_POST['duration']);
    
    $stmt = $pdo->prepare("INSERT INTO experience (company, role, duration) VALUES (?, ?, ?)");
    $stmt->execute([$company, $role, $duration]);
}

// Read
$stmt = $pdo->query("SELECT * FROM experience");
$experiences = $stmt->fetchAll();

// Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_experience'])) {
    $id = $_POST['id'];
    $company = htmlspecialchars($_POST['company']);
    $role = htmlspecialchars($_POST['role']);
    $duration = htmlspecialchars($_POST['duration']);
    
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Experience Management</title>
</head>
<body>
    <h1>Manage Work Experience</h1>

    <!-- Create Form -->
    <h2>Add Experience</h2>
    <form method="post">
        <input type="text" name="company" placeholder="Company" required>
        <input type="text" name="role" placeholder="Role" required>
        <input type="text" name="duration" placeholder="Duration" required>
        <button type="submit" name="add_experience">Add</button>
    </form>

    <!-- Display and Update Form -->
    <h2>Experience List</h2>
    <table border="1">
        <tr>
            <th>Company</th>
            <th>Role</th>
            <th>Duration</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($experiences as $experience): ?>
            <tr>
                <td><?= htmlspecialchars($experience['company']) ?></td>
                <td><?= htmlspecialchars($experience['role']) ?></td>
                <td><?= htmlspecialchars($experience['duration']) ?></td>
                <td>
                    <!-- Update Form -->
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $experience['id'] ?>">
                        <input type="text" name="company" value="<?= htmlspecialchars($experience['company']) ?>" required>
                        <input type="text" name="role" value="<?= htmlspecialchars($experience['role']) ?>" required>
                        <input type="text" name="duration" value="<?= htmlspecialchars($experience['duration']) ?>" required>
                        <button type="submit" name="update_experience">Update</button>
                    </form>

                    <!-- Delete Link -->
                    <a href="?delete_id=<?= $experience['id'] ?>" onclick="return confirm('Are you sure you want to delete this entry?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>