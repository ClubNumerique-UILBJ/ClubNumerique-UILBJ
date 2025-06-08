<?php
include '../db.php';
$id = $_POST['id'];
$conn->query("UPDATE tutos SET likes = likes + 1 WHERE id = $id");
header("Location: ../index.php");
?>