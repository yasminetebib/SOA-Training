<?php include 'partials/header.php'; ?>
<h1>Notes (exemple simple)</h1>
<p>Table de notes jointe aux étudiants et modules (lecture seule dans cet exemple).</p>
<table>
  <thead><tr><th>Étudiant</th><th>Module</th><th>Note</th></tr></thead>
  <tbody>
  <?php
  $sql = "SELECT n.grade, u.fullname AS student, m.name AS module_name
          FROM note n
          JOIN users u ON u.id=n.student_id
          JOIN module m ON m.id=n.module_id
          ORDER BY u.fullname, m.name";
  $res = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($res)): ?>
    <tr>
      <td><?php echo htmlspecialchars($row['student']); ?></td>
      <td><?php echo htmlspecialchars($row['module_name']); ?></td>
      <td><?php echo htmlspecialchars($row['grade']); ?></td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
<?php include 'partials/footer.php'; ?>
