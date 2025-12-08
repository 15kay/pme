<?php
// Database connection
$host = "sql100.infinityfree.com"; 
$user = "if0_39579458";    
$pass = "Kgau456M"; 
$db   = "if0_39579458_irp"; 

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch posts
$sql = "SELECT * FROM stories ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Posts</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .post { border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; }
        .post img { max-width: 300px; height: auto; display: block; margin-top: 10px; }
        .title { font-size: 24px; font-weight: bold; }
        .description { font-size: 18px; margin-top: 10px; }
        .content { margin-top: 15px; }
    </style>
</head>
<body>

    <h1>All Posts</h1>

    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="post">
                <div class="title"><?= htmlspecialchars($row['title']) ?></div>
                <div class="description"><?= nl2br(htmlspecialchars($row['description'])) ?></div>
                <div class="content"><?= nl2br(htmlspecialchars($row['content'])) ?></div>
                <?php if (!empty($row['image']) && file_exists($row['image'])): ?>
                    <img src="<?= $row['image'] ?>" alt="Post Image">
                <?php endif; ?>
                <div style="color: gray; font-size: 12px;">Posted on <?= $row['created_at'] ?></div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No posts found.</p>
    <?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
