<?php
session_start();
include 'db.php';

$limit = 6; // tuto pour chaque page
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $_GET['search'] : '';
$where = '';
if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $where = "WHERE titre LIKE '%$search%'";
}

// Compteur de tuto , compte le nombre total de tutos
$totalRes = $conn->query("SELECT COUNT(*) as total FROM tutos $where");
$total = $totalRes->fetch_assoc()['total'];
$pages = ceil($total / $limit);

// Récupérer les tutos de la page actuelle
$query = "SELECT * FROM tutos $where ORDER BY id DESC LIMIT $limit OFFSET $offset";
$res = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta author="Michel Ulcède EDOU EDOU">
  <title>MiniTube - Club Numérique UIL-BJ</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>
             <!--image/logo/logo-club.png--!>
              <header class="menu-cadre"> 
                 <!-- Logo du club à gauche --!>
                 <a href="index.html" class="logo-club"><img src="logo-club.jpg" alt="Logo Club"></a><!-- LE LOGO SOUS FOND NOIR -->

                 <!-- Menu de navigation --!>
                 <nav class="menu-nav">
                     <ul>
                         <li><a href="../index.html">Accueil</a></li>
                         <li><a href="../page-act/act.html">Activités</a></li>
                         <li><a href="../page-memebres/membres.html" >Membres du bureau éxécutif</a></li>
                         <li><a href="com.html">communication</a></li><!-- anciennement Contact --!>
                     </ul>
                 </nav>

                 <!-- Logo université à droite --!>
                 <a href="https://uil-universite.com" class="logo-universite" target="_blank"><img src="logo-universite.png" alt="Logo Université"></a>
              </header>

<div class="espace">
  <h1>MiniTube - Club Numérique UIL-BJ</h1>
  <a href="https://clubnumerique-uilbj.com" target="_blank">🌐Club Numérique UIL-BJ</a>
  <form method="get">
    <input type="text" name="search" placeholder="Rechercher un tuto..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit">Rechercher</button>
  </form>
</div>

<main class="grid">
<?php while ($row = $res->fetch_assoc()): ?>
  <div class="card">
    <?php if ($row['type'] === 'image'): ?>
      <img src="uploads/<?= $row['fichier'] ?>" alt="<?= $row['titre'] ?>">
    <?php else: ?>
      <video src="uploads/<?= $row['fichier'] ?>" controls></video>
    <?php endif; ?>
    <h3><?= $row['titre'] ?></h3>
    <p class="date">📅 <?= date('d/m/Y', strtotime($row['date_pub'])) ?></p>

    <!-- Si admin  connecté, afficher Modifier / Supprimer -->
    <?php if (isset($_SESSION['admin'])): ?>
      <a href="admin/edit.php?id=<?= $row['id'] ?>">✏️ Modifier</a>
      <a href="admin/delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Supprimer ce tuto ?')">🗑️ Supprimer</a>
    <?php endif; ?>
  </div>
<?php endwhile; ?>
</main>

<div class="pagination">
  <?php if ($page > 1): ?>
    <a href="?search=<?= urlencode($search) ?>&page=<?= $page - 1 ?>">&laquo; Précédent</a>
  <?php endif; ?>

  <?php for ($i = 1; $i <= $pages; $i++): ?>
    <a href="?search=<?= urlencode($search) ?>&page=<?= $i ?>" class="<?= $i === $page ? 'active' : '' ?>"><?= $i ?></a>
  <?php endfor; ?>

  <?php if ($page < $pages): ?>
    <a href="?search=<?= urlencode($search) ?>&page=<?= $page + 1 ?>">Suivant &raquo;</a>
  <?php endif; ?>
</div>

<footer>
  <p>Club Numérique UIL-BJ © <?= date('Y') ?></p>
  <p>clubnumerique-uilbj.com - By <a>EDOU Michel Ulcède</a></p>
</footer>

</body>
</html>
