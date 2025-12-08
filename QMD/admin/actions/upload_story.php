<?php
session_start();

// Redirect if user not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

require '../db.php';

// Get form data
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;  // 0 means new insert
$title = trim($_POST['title']);
$description = trim($_POST['description']);
$content = trim($_POST['content']);
$thumbnail = isset($_FILES['image']) ? $_FILES['image'] : null;

// Basic validation
if (empty($title) || empty($content)) {
    echo "Title and content are required.";
    exit();
}

// Upload directory
$target_dir = "../uploads/stories/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Function to upload image if provided and return filename or empty string
function uploadImage($thumbnail, $target_dir) {
    if ($thumbnail && $thumbnail['error'] === 0) {
        $filename = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", basename($thumbnail["name"]));
        $target_file = $target_dir . $filename;
        if (move_uploaded_file($thumbnail["tmp_name"], $target_file)) {
            return $filename;
        } else {
            echo "Failed to upload image.";
            exit();
        }
    }
    return '';
}

if ($id > 0) {
    // Update case

    // First, get current image filename for this story
    $stmt = $conn->prepare("SELECT image FROM stories WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();
    $row = $res->fetch_assoc();
    $currentImage = $row ? $row['image'] : '';

    // Upload new image if provided
    $newImage = uploadImage($thumbnail, $target_dir);

    if ($newImage) {
        // Delete old image file (optional)
        if ($currentImage && file_exists($target_dir . $currentImage)) {
            unlink($target_dir . $currentImage);
        }

        $sql = "UPDATE stories SET title = ?, description = ?, content = ?, image = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $title, $description, $content, $newImage, $id);
    } else {
        // No new image uploaded, keep old image
        $sql = "UPDATE stories SET title = ?, description = ?, content = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $title, $description, $content, $id);
    }

    if ($stmt->execute()) {
        header("Location: ../dashboard.php?status=updated");
        exit();
    } else {
        echo "Error updating story: " . $stmt->error;
    }

} else {
    // Insert case (new story)
    if (!$thumbnail || $thumbnail['error'] !== 0) {
        echo "Thumbnail image is required for new stories.";
        exit();
    }

    $filename = uploadImage($thumbnail, $target_dir);

    $sql = "INSERT INTO stories (title, description, content, image, created_by) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssss", $title, $description, $content, $filename, $_SESSION['username']);
        if ($stmt->execute()) {
            header("Location: ../dashboard.php?status=success");
            exit();
        } else {
            echo "Error inserting story: " . $stmt->error;
        }
    } else {
        echo "Failed to prepare statement: " . $conn->error;
    }
}
?>
