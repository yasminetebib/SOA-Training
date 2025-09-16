<?php include 'partials/header.php';

$action = $_GET['action'] ?? '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($action === 'add') {
    $code = mysqli_real_escape_string($conn, $_POST['code'] ?? '');
    $name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
    $type = mysqli_real_escape_string($conn, $_POST['type'] ?? 'TRANSVERSAL');
    mysqli_query($conn, "INSERT INTO unite_enseignement(code,name,type) VALUES('$code','$name','$type')");
    header('Location: ue.php?msg=UE+ajoutée'); exit;
  }
  if ($action === 'edit') {
    $id = (int)($_POST['id'] ?? 0);
    $code = mysqli_real_escape_string($conn, $_POST['code'] ?? '');
    $name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
    $type = mysqli_real_escape_string($conn, $_POST['type'] ?? 'TRANSVERSAL');
    mysqli_query($conn, "UPDATE unite_enseignement SET code='$code', name='$name', type='$type' WHERE id=$id");
    header('Location: ue.php?msg=UE+modifiée'); exit;
  }
}
if ($action === 'delete') {
  $id = (int)($_GET['id'] ?? 0);
  mysqli_query($conn, "DELETE FROM unite_enseignement WHERE id=$id");
  header('Location: ue.php?msg=UE+supprimée'); exit;
}
?>
<h1>Unités d'enseignement (UE)</h1>
<?php if(isset($_GET['msg'])): ?><div class="alert success"><?php echo htmlspecialchars($_GET['msg']); ?></div><?php endif; ?>
<div class="grid two">
  <div>
    <h3>Liste</h3>
    <table>
      <thead><tr><th>Code</th><th>Nom</th><th>Type</th><th>Actions</th></tr></thead>
      <tbody>
      <?php
      $res = mysqli_query($conn, "SELECT * FROM unite_enseignement ORDER BY id DESC");
      while ($row = mysqli_fetch_assoc($res)): ?>
        <tr>
          <td><?php echo htmlspecialchars($row['code']); ?></td>
          <td><?php echo htmlspecialchars($row['name']); ?></td>
          <td><?php echo htmlspecialchars($row['type']); ?></td>
          <td>
            <a class="btn small" href="ue.php?action=edit_form&id=<?php echo (int)$row['id']; ?>">Modifier</a>
            <a class="btn small danger" onclick="return confirmDelete();" href="ue.php?action=delete&id=<?php echo (int)$row['id']; ?>">Supprimer</a>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <div>
    <?php if ($action === 'edit_form'):
      $id = (int)($_GET['id'] ?? 0);
      $u = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM unite_enseignement WHERE id=$id"));
    ?>
      <h3>Modifier</h3>
      <form method="post" action="ue.php?action=edit">
        <input type="hidden" name="id" value="<?php echo (int)$u['id']; ?>">
        <label>Code <input name="code" required value="<?php echo htmlspecialchars($u['code']); ?>"></label>
        <label>Nom <input name="name" required value="<?php echo htmlspecialchars($u['name']); ?>"></label>
        <label>Type
          <select name="type">
            <?php foreach (['TRANSVERSAL','PROFESSIONNEL','RECHERCHE'] as $t): ?>
              <option value="<?php echo $t; ?>" <?php if($t==$u['type']) echo 'selected'; ?>><?php echo $t; ?></option>
            <?php endforeach; ?>
          </select>
        </label>
        <button class="btn" type="submit">Enregistrer</button>
        <a class="btn ghost" href="ue.php">Annuler</a>
      </form>
    <?php else: ?>
      <h3>Ajouter</h3>
      <form method="post" action="ue.php?action=add">
        <label>Code <input name="code" required></label>
        <label>Nom <input name="name" required></label>
        <label>Type
          <select name="type">
            <option>TRANSVERSAL</option>
            <option>PROFESSIONNEL</option>
            <option>RECHERCHE</option>
          </select>
        </label>
        <button class="btn" type="submit">Ajouter</button>
      </form>
    <?php endif; ?>
  </div>
</div>
<?php include 'partials/footer.php'; ?>
