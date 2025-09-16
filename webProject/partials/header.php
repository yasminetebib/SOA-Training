<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once __DIR__.'/../db.php';
if (!isset($_SESSION['user_id']) && basename($_SERVER['PHP_SELF']) !== 'login.php') {
  header('Location: /php_portal_procedural/login.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Portail Universitaire</title>
  <link rel="stylesheet" href="/php_portal_procedural/assets/css/style.css">
</head>
<body>
<header class="topbar">
  <div class="brand">Portail Universitaire — Procédural</div>
  <nav class="menu">
    <a href="/php_portal_procedural/index.php">Accueil</a>
    <a href="/php_portal_procedural/modules.php">Modules</a>
    <a href="/php_portal_procedural/ue.php">UE</a>
    <a href="/php_portal_procedural/notes.php">Notes</a>
    <a href="/php_portal_procedural/messaging.php">Messagerie</a>
    <a href="/php_portal_procedural/timetable.php">Emploi du temps</a>
  </nav>
  <div class="user">
    <?php if(isset($_SESSION['email'])): ?>
      <span><?php echo htmlspecialchars($_SESSION['email']); ?></span>
      <a class="btn small" href="/php_portal_procedural/logout.php">Déconnexion</a>
    <?php endif; ?>
  </div>
</header>
<main class="container">
