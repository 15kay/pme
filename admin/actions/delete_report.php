<?php
require '../db.php';
$id = $_GET['id'];
$conn->query("DELETE FROM reports WHERE id = $id");
header("Location: ../dashboard.php");
?>
