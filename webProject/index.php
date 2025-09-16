<?php include 'partials/header.php'; ?>
<h1>Tableau de bord</h1>
<div class="grid">
  <div class="card">
    <h3>Total Modules</h3>
    <p class="big">
      <?php $r = mysqli_query($conn, "SELECT COUNT(*) c FROM module"); $c = mysqli_fetch_assoc($r); echo (int)$c['c']; ?>
    </p>
  </div>
  <div class="card">
    <h3>Total UE</h3>
    <p class="big">
      <?php $r = mysqli_query($conn, "SELECT COUNT(*) c FROM unite_enseignement"); $c = mysqli_fetch_assoc($r); echo (int)$c['c']; ?>
    </p>
  </div>
  <div class="card">
    <h3>Étudiants</h3>
    <p class="big">
      <?php $r = mysqli_query($conn, "SELECT COUNT(*) c FROM users WHERE role='student'"); $c = mysqli_fetch_assoc($r); echo (int)$c['c']; ?>
    </p>
  </div>
</div>
<p>Bienvenue sur la version *procédurale* du portail. Utilisez le menu pour gérer les entités.</p>
<?php include 'partials/footer.php'; ?>
