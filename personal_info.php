<?php
include 'connect.php';

// Create
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_personal_info'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $contact = htmlspecialchars($_POST['contact']);
    
    $stmt = $pdo->prepare("INSERT INTO personal_info (name, email, contact) VALUES (?, ?, ?)");
    $stmt->execute([$name, $email, $contact]);
}

// Read
$stmt = $pdo->query("SELECT * FROM personal_info");
$personalInfos = $stmt->fetchAll();

// Update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_personal_info'])) {
    $id = $_POST['id'];
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $contact = htmlspecialchars($_POST['contact']);
    
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information Management</title>
</head>
<body>
    <h1>Manage Personal Information</h1>

    <!-- Create Form -->
    <h2>Add Personal Information</h2>
    <form method="post">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="contact" placeholder="Contact" required>
        <button type="submit" name="add_personal_info">Add</button>
    </form>

    <!-- Display and Update Form -->
    <h2>Personal Information List</h2>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($personalInfos as $info): ?>
            <tr>
                <td><?= htmlspecialchars($info['name']) ?></td>
                <td><?= htmlspecialchars($info['email']) ?></td>
                <td><?= htmlspecialchars($info['contact']) ?></td>
                <td>
                    <!-- Update Form -->
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $info['id'] ?>">
                        <input type="text" name="name" value="<?= htmlspecialchars($info['name']) ?>">
                        <input type="email" name="email" value="<?= htmlspecialchars($info['email']) ?>">
                        <input type="text" name="contact" value="<?= htmlspecialchars($info['contact']) ?>">
                        <button type="submit" name="update_personal_info">Update</button>
                    </form>

                    <!-- Delete Link -->
                    <a href="?delete_id=<?= $info['id'] ?>" onclick="return confirm('Are you sure you want to delete this entry?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>