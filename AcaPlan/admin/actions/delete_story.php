<?php
require '../db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM stories WHERE id = $id");
header("Location: ../dashboard.php");
?>
<?php
require '../db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM stories WHERE id = $id");
header("Location: ../dashboard.php");
?>
