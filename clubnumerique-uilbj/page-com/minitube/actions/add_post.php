<?php
include '../db.php';
session_start();

if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit;
}

$titre = $_POST['titre'];
$type = $_POST['type'];
$fichier = $_FILES['fichier']['name'];
$tmp = $_FILES['fichier']['tmp_name'];
$date_pub = date('Y-m-d');

move_uploaded_file($tmp, "../uploads/$fichier");

$stmt = $conn->prepare("INSERT INTO tutos (titre, type, fichier, date_pub) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $titre, $type, $fichier, $date_pub);
$stmt->execute();

header("Location: ../index.php");
?>
