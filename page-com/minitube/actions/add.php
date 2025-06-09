<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un tuto</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
<main style="max-width:600px;margin:auto;padding:20px">
  <h2>Ajouter un nouveau tuto</h2>
  <form action="add_post.php" method="POST" enctype="multipart/form-data">
    <label for="titre">Titre :</label>
    <input type="text" name="titre" required><br><br>

    <label for="type">Type :</label>
    <select name="type" required>
      <option value="image">Image</option>
      <option value="video">Vidéo</option>
    </select><br><br>

    <label for="fichier">Fichier :</label>
    <input type="file" name="fichier" required><br><br>

    <button type="submit">✅ Ajouter</button>
  </form>
  <br>
  <a href="../index.php">⬅️ Retour à l'accueil</a>
</main>
</body>
</html>
