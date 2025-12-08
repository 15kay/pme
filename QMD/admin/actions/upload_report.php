<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

require '../db.php';

$title = $_POST['title'];
$description = $_POST['description'];
$content = $_POST['content'];
$link = $_POST['link'];
$thumbnail = $_FILES['thumbnail'];

// Handle thumbnail upload
if ($thumbnail['error'] === 0) {
    $target_dir = "../uploads/reports/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

    $filename = time() . "_" . basename($thumbnail["name"]);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($thumbnail["tmp_name"], $target_file)) {
        $sql = "INSERT INTO reports (title, description, content, thumbnail, link, created_by) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $title, $description, $content, $filename, $link, $_SESSION['username']);

        if ($stmt->execute()) {
            header("Location: ../views/reports.php?success=1");
            exit();
        } else {
            echo "Database error: " . $conn->error;
        }
    } else {
        echo "Failed to upload thumbnail.";
    }
} else {
    echo "Thumbnail upload error.";
}
?>
