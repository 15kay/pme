<?php
// Database connection
$host = "sql100.infinityfree.com"; // Replace with your DB host
$user = "if0_39579458";     // Replace with your DB username
$pass = "Kgau456M"; // Replace with your DB password
$db   = "if0_39579458_irp"; // Replace with your DB name

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$title = $_POST['title'];
$description = $_POST['description'];
$content = $_POST['content'];

// Handle image upload
$image = $_FILES['image'];
$imageName = basename($image['name']);
$imageTmp = $image['tmp_name'];
$imagePath = 'uploads/' . time() . '_' . $imageName; // unique filename

// Check if the file is really uploaded and move it
if (move_uploaded_file($imageTmp, $imagePath)) {
    // Save post to DB
    $stmt = $conn->prepare("INSERT INTO stories  (title, description, content, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $content, $imagePath);
    
    if ($stmt->execute()) {
        echo "✅ Post uploaded successfully.<br>";
        echo "<a href='posts.php'>View Posts</a>";
    } else {
        echo "❌ Database error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "❌ Failed to upload image. Check if /uploads/ folder exists and has write permissions.";
}

$conn->close();
?>
