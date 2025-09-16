<?php include 'partials/header.php';

$action = $_GET['action'] ?? '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if ($action === 'add') {
    $code = mysqli_real_escape_string($conn, $_POST['code'] ?? '');
    $name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
    $credits = (int)($_POST['credits'] ?? 3);
    $ue_id = (int)($_POST['ue_id'] ?? 0);
    mysqli_query($conn, "INSERT INTO module(code,name,credits,ue_id) VALUES('$code','$name',$credits," . ($ue_id ?: 'NULL') . ")");
    header('Location: modules.php?msg=Module+ajouté'); exit;
  }
  if ($action === 'edit') {
    $id = (int)($_POST['id'] ?? 0);
    $code = mysqli_real_escape_string($conn, $_POST['code'] ?? '');
    $name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
    $credits = (int)($_POST['credits'] ?? 3);
    $ue_id = (int)($_POST['ue_id'] ?? 0);
    mysqli_query($conn, "UPDATE module SET code='$code', name='$name', credits=$credits, ue_id=" . ($ue_id ?: 'NULL') . " WHERE id=$id");
    header('Location: modules.php?msg=Module+modifié'); exit;
  }
}
if ($action === 'delete') {
  $id = (int)($_GET['id'] ?? 0);
  mysqli_query($conn, "DELETE FROM module WHERE id=$id");
  header('Location: modules.php?msg=Module+supprimé'); exit;
}
?>
<h1>Modules</h1>
<?php if(isset($_GET['msg'])): ?><div class="alert success"><?php echo htmlspecialchars($_GET['msg']); ?></div><?php endif; ?>
<div class="grid two">
  <div>
    <h3>Liste</h3>
    <table>
      <thead><tr><th>Code</th><th>Nom</th><th>Crédits</th><th>UE</th><th>Actions</th></tr></thead>
      <tbody>
      <?php
      $res = mysqli_query($conn, "SELECT m.*, u.name AS ue_name FROM module m LEFT JOIN unite_enseignement u ON u.id=m.ue_id ORDER BY m.id DESC");
      while ($row = mysqli_fetch_assoc($res)): ?>
        <tr>
          <td><?php echo htmlspecialchars($row['code']); ?></td>
          <td><?php echo htmlspecialchars($row['name']); ?></td>
          <td><?php echo (int)$row['credits']; ?></td>
          <td><?php echo htmlspecialchars($row['ue_name'] ?? '-'); ?></td>
          <td>
            <a class="btn small" href="modules.php?action=edit_form&id=<?php echo (int)$row['id']; ?>">Modifier</a>
            <a class="btn small danger" onclick="return confirmDelete();" href="modules.php?action=delete&id=<?php echo (int)$row['id']; ?>">Supprimer</a>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <div>
    <?php if ($action === 'edit_form'):
      $id = (int)($_GET['id'] ?? 0);
      $m = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM module WHERE id=$id"));
    ?>
      <h3>Modifier</h3>
      <form method="post" action="modules.php?action=edit">
        <input type="hidden" name="id" value="<?php echo (int)$m['id']; ?>">
        <label>Code <input name="code" required value="<?php echo htmlspecialchars($m['code']); ?>"></label>
        <label>Nom <input name="name" required value="<?php echo htmlspecialchars($m['name']); ?>"></label>
        <label>Crédits <input type="number" name="credits" min="1" max="30" value="<?php echo (int)$m['credits']; ?>"></label>
        <label>UE
          <select name="ue_id">
            <option value="">—</option>
            <?php $ues = mysqli_query($conn, "SELECT * FROM unite_enseignement ORDER BY name");
            while($u = mysqli_fetch_assoc($ues)): ?>
              <option value="<?php echo (int)$u['id']; ?>" <?php if($u['id']==$m['ue_id']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($u['name']); ?>
              </option>
            <?php endwhile; ?>
          </select>
        </label>
        <button class="btn" type="submit">Enregistrer</button>
        <a class="btn ghost" href="modules.php">Annuler</a>
      </form>
    <?php else: ?>
      <h3>Ajouter</h3>
      <form method="post" action="modules.php?action=add">
        <label>Code <input name="code" required></label>
        <label>Nom <input name="name" required></label>
        <label>Crédits <input type="number" name="credits" min="1" max="30" value="3"></label>
        <label>UE
          <select name="ue_id">
            <option value="">—</option>
            <?php $ues = mysqli_query($conn, "SELECT * FROM unite_enseignement ORDER BY name");
            while($u = mysqli_fetch_assoc($ues)): ?>
              <option value="<?php echo (int)$u['id']; ?>">
                <?php echo htmlspecialchars($u['name']); ?>
              </option>
            <?php endwhile; ?>
          </select>
        </label>
        <button class="btn" type="submit">Ajouter</button>
      </form>
    <?php endif; ?>
  </div>
</div>
<?php include 'partials/footer.php'; ?>
