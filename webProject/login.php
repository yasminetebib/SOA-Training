<?php
session_start();
require_once 'db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
  $pass = mysqli_real_escape_string($conn, $_POST['password'] ?? '');
  $sql = "SELECT * FROM users WHERE email='$email' AND password='$pass' LIMIT 1";
  $res = mysqli_query($conn, $sql);
  if ($res && mysqli_num_rows($res) === 1) {
    $user = mysqli_fetch_assoc($res);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];
    header('Location: index.php');
    exit;
  } else {
    $error = "Identifiants invalides.";
  }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="auth">
  <h1>Connexion</h1>
  <?php if ($error): ?><div class="alert error"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
  <form method="post">
    <label>Email
      <input type="email" name="email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
    </label>
    <label>Mot de passe
      <input type="password" name="password" required>
    </label>
    <button class="btn" type="submit">Se connecter</button>
  </form>
  <p class="hint">Compte de démo : admin@example.com / admin</p>
</div>
</body>
</html>
