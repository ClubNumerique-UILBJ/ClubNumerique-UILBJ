<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $u = $_POST['username'];
  $p = $_POST['password'];
  $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=PASSWORD(?)");
  $stmt->bind_param("ss", $u, $p);
  $stmt->execute();
  $res = $stmt->get_result();
  if ($res->num_rows === 1) {
    $_SESSION['admin'] = $u;
    header('Location: admin.php');
    exit;
  } else {
    $error = "Identifiants incorrects";
  }
}
?>

<form method="POST">
  <h2>Connexion Admin</h2>
  <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <input name="username" placeholder="Nom d'utilisateur"><br>
  <input name="password" type="password" placeholder="Mot de passe"><br>
  <button type="submit">Connexion</button>
</form>
