<?php include 'partials/header.php';

$uid = (int)($_SESSION['user_id'] ?? 0);
$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'send') {
  $to = (int)($_POST['to'] ?? 0);
  $subject = mysqli_real_escape_string($conn, $_POST['subject'] ?? '');
  $body = mysqli_real_escape_string($conn, $_POST['body'] ?? '');
  mysqli_query($conn, "INSERT INTO message(sender_id,receiver_id,subject,body) VALUES($uid,$to,'$subject','$body')");
  header('Location: messaging.php?msg=Message+envoyé'); exit;
}

?>
<h1>Messagerie</h1>
<?php if(isset($_GET['msg'])): ?><div class="alert success"><?php echo htmlspecialchars($_GET['msg']); ?></div><?php endif; ?>

<div class="grid two">
  <div>
    <h3>Boîte de réception</h3>
    <table>
      <thead><tr><th>De</th><th>Objet</th><th>Date</th></tr></thead>
      <tbody>
      <?php
      $sql = "SELECT m.*, s.email AS sender_email
              FROM message m JOIN users s ON s.id=m.sender_id
              WHERE m.receiver_id=$uid ORDER BY m.created_at DESC";
      $res = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($res)): ?>
        <tr>
          <td><?php echo htmlspecialchars($row['sender_email']); ?></td>
          <td><?php echo htmlspecialchars($row['subject']); ?></td>
          <td><?php echo htmlspecialchars($row['created_at']); ?></td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <div>
    <h3>Nouveau message</h3>
    <form method="post" action="messaging.php?action=send">
      <label>À
        <select name="to" required>
          <option value="">Choisir…</option>
          <?php $users = mysqli_query($conn, "SELECT id,email FROM users WHERE id<>$uid ORDER BY email");
          while($u = mysqli_fetch_assoc($users)): ?>
            <option value="<?php echo (int)$u['id']; ?>"><?php echo htmlspecialchars($u['email']); ?></option>
          <?php endwhile; ?>
        </select>
      </label>
      <label>Objet <input name="subject" required></label>
      <label>Message <textarea name="body" rows="5" required></textarea></label>
      <button class="btn" type="submit">Envoyer</button>
    </form>
  </div>
</div>
<?php include 'partials/footer.php'; ?>
