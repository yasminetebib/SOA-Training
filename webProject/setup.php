<?php
session_start();
require_once 'db.php';


?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Setup — Portail</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
  <h1>Initialisation de la base</h1>
  <p>Requêtes exécutées avec succès : <strong><?php echo $ok; ?></strong></p>
  <?php if ($err > 0): ?>
    <div class="alert error">
      <p>Erreurs (<?php echo $err; ?>) :</p>
      <ul>
        <?php foreach ($errors as $e): ?>
          <li><?php echo htmlspecialchars($e); ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php else: ?>
    <div class="alert success">Base initialisée avec succès !</div>
  <?php endif; ?>
  <p><a class="btn" href="login.php">Aller à la page de connexion</a></p>
</div>
</body>
</html>
