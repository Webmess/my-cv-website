<?php
include 'connect.php';

// Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_project'])) {
    $projectName = htmlspecialchars($_POST['project_title']);
    $description = htmlspecialchars($_POST['description']);
    
    $stmt = $pdo->prepare("INSERT INTO projects (project_title, description) VALUES (?, ?, ?)");
    $stmt->execute([$projectName, $description, $date]);
}

// Read
$stmt = $pdo->query("SELECT * FROM projects");
$projects = $stmt->fetchAll();

// Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_project'])) {
    $id = $_POST['id'];
    $projectName = htmlspecialchars($_POST['project_title']);
    $description = htmlspecialchars($_POST['description']);
    
    $stmt = $pdo->prepare("UPDATE projects SET project_title = ?, description = ? WHERE id = ?");
    $stmt->execute([$projectName, $description, $date, $id]);
}

// Delete
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->execute([$id]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management</title>
</head>
<body>
    <h1>Manage Projects</h1>

    <!-- Create Form -->
    <h2>Add Project</h2>
    <form method="post">
        <input type="text" name="project_title" placeholder="Project Title" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <button type="submit" name="add_project">Add</button>
    </form>

    <!-- Display and Update Form -->
    <h2>Project List</h2>
    <table border="1">
        <tr>
            <th>Project Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($projects as $project): ?>
            <tr>
                <td><?= htmlspecialchars($project['project_title']) ?></td>
                <td><?= htmlspecialchars($project['description']) ?></td>
                <td>
                    <!-- Update Form -->
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $project['id'] ?>">
                        <input type="text" name="project_name" value="<?= htmlspecialchars($project['project_title']) ?>" required>
                        <textarea name="description" required><?= htmlspecialchars($project['description']) ?></textarea>
                        <button type="submit" name="update_project">Update</button>
                    </form>

                    <!-- Delete Link -->
                    <a href="?delete_id=<?= $project['id'] ?>" onclick="return confirm('Are you sure you want to delete this project?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>