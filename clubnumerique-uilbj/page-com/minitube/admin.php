<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
?>

<form action="actions/add_tuto.php" method="POST" enctype="multipart/form-data">
  <h2>Ajouter un tuto</h2>
  <input name="titre" placeholder="Titre du tuto"><br>
  <select name="type">
    <option value="video">Vidéo</option>
    <option value="image">Image</option>
  </select><br>
  <input type="file" name="fichier"><br>
  <button type="submit">Publier</button>
</form>

<a href="logout.php">Se déconnecter</a>
