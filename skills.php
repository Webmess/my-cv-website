<?php
include 'connect.php';

// Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_skill'])) {
    $skillName = htmlspecialchars($_POST['skill']);
    
    $stmt = $pdo->prepare("INSERT INTO skills (skill) VALUES (?, ?)");
    $stmt->execute([$skill]);
}

// Read
$stmt = $pdo->query("SELECT * FROM skills");
$skills = $stmt->fetchAll();

// Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_skill'])) {
    $id = $_POST['id'];
    $skillName = htmlspecialchars($_POST['skill']);
    
    $stmt = $pdo->prepare("UPDATE skills SET skill = ? WHERE id = ?");
    $stmt->execute([$skill, $id]);
}

// Delete
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM skills WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skills Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Manage Skills</h1>

    <!-- Create Form -->
    <h2>Add Skill</h2>
    <form method="post">
        <input type="text" name="skill" placeholder="Skill Name" required>
        <button type="submit" name="add_skill">Add</button>
    </form>

    <!-- Display and Update Form -->
    <h2>Skills List</h2>
    <table>
        <tr>
            <th>Skill</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($skills as $skill): ?>
            <tr>
                <td><?= htmlspecialchars($skill['skill']) ?></td>
                <td>
                    <!-- Update Form -->
                    <form method="post" class="update-form">
                        <input type="hidden" name="id" value="<?= $skill['id'] ?>">
                        <input type="text" name="skill_name" value="<?= htmlspecialchars($skill['skill']) ?>">
                        <button type="submit" name="update_skill">Update</button>
                    </form>

                    <!-- Delete Link -->
                    <a href="?delete_id=<?= $skill['id'] ?>" class="delete-link" onclick="return confirm('Are you sure you want to delete this entry?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>