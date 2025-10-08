<?php
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../models/Ticket.php';
require_once __DIR__ . '/../../models/Service.php';
$tickets = Ticket::allForRole($_SESSION['user']);
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Tickets</h3>
  <a class="btn btn-primary" href="create.php">Nuevo ticket</a>
</div>
<table class="table table-hover">
  <thead><tr><th>#</th><th>Título</th><th>Servicio</th><th>Estado</th><th>Asignado a</th><th>Fecha</th><th></th></tr></thead>
  <tbody>
    <?php foreach($tickets as $t): ?>
      <tr>
        <td><?= $t['id'] ?></td>
        <td><?= htmlspecialchars($t['titulo']) ?></td>
        <td><?= htmlspecialchars($t['service_name'] ?? '-') ?></td>
        <td><span class="badge bg-secondary"><?= $t['estado'] ?></span></td>
        <td><?= $t['asignado_a'] ?? '-' ?></td>
        <td><?= $t['created_at'] ?></td>
        <td><a class="btn btn-sm btn-outline-primary" href="show.php?id=<?= $t['id'] ?>">Ver</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php include __DIR__ . '/../../includes/footer.php';
