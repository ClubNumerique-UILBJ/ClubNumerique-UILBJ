<?php
include '../db.php';
$tuto_id = $_POST['id'];
$msg = $conn->real_escape_string($_POST['message']);
$conn->query("INSERT INTO commentaires (tuto_id, message) VALUES ($tuto_id, '$msg')");
header("Location: ../index.php");
?>