<?php include 'partials/header.php'; ?>
<h1>Emploi du temps</h1>
<table>
  <thead><tr><th>Jour</th><th>Séance</th><th>Début</th><th>Fin</th><th>Salle</th></tr></thead>
  <tbody>
  <?php
  $res = mysqli_query($conn, "SELECT * FROM timetable ORDER BY FIELD(day,'Mon','Tue','Wed','Thu','Fri','Sat'), start_time");
  while($row = mysqli_fetch_assoc($res)): ?>
    <tr>
      <td><?php echo htmlspecialchars($row['day']); ?></td>
      <td><?php echo htmlspecialchars($row['title']); ?></td>
      <td><?php echo htmlspecialchars(substr($row['start_time'],0,5)); ?></td>
      <td><?php echo htmlspecialchars(substr($row['end_time'],0,5)); ?></td>
      <td><?php echo htmlspecialchars($row['room']); ?></td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
<?php include 'partials/footer.php'; ?>
