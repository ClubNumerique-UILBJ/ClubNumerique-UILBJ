<?php
include '../db.php';
$titre = $_POST['titre'];
$type = $_POST['type'];
$fichier = $_FILES['fichier']['name'];
move_uploaded_file($_FILES['fichier']['tmp_name'], "../uploads/$fichier");

$conn->query("INSERT INTO tutos (titre, type, fichier) VALUES ('$titre', '$type', '$fichier')");
header("Location: ../admin.php");
?>