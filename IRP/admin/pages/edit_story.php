<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

require '../db.php';

if (!isset($_GET['id'])) {
    echo "No story ID specified.";
    exit();
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM stories WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Story not found.";
    exit();
}

$story = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Story</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>IRP Edit Story</h2>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li><a href="../dashboard.php">Dashboard</a></li>
                <li><a href="add_story.php">Add Story</a></li>
                <li><a href="add_report.php">Add Report</a></li>
                <li><a href="stories.php">View Stories</a></li>
                <li><a href="reports.php">View Reports</a></li>
                <li><a href="../actions/logout.php" class="logout-link">Logout</a></li>
            </ul>
        </nav>
    </aside>

    <div class="container">
        <h2>Edit Story</h2>
        <form action="../actions/upload_story.php" method="POST" enctype="multipart/form-data" class="form-card">
            <input type="hidden" name="id" value="<?= htmlspecialchars($story['id']) ?>">

            <label>Title</label>
            <input type="text" name="title" value="<?= htmlspecialchars($story['title']) ?>" required>

            <label>Description</label>
            <textarea name="description" required><?= htmlspecialchars($story['description']) ?></textarea>

            <label>Content</label>
            <textarea name="content" required><?= htmlspecialchars($story['content']) ?></textarea>

            <label>Current Image</label><br>
            <img src="../uploads/stories/<?= htmlspecialchars($story['image']) ?>" alt="Story Image" width="150"><br>

            <label>Change Image (optional)</label>
            <input type="file" name="image" accept="image/*">

            <button type="submit">Update Story</button>
        </form>
    </div>
</body>
</html>
