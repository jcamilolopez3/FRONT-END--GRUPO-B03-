<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Service.php';
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../includes/auth_check.php';
requireRole('admin');
$services = Service::all();
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>Servicios</h3>
  <a class="btn btn-primary" href="create.php">Nuevo servicio</a>
</div>
<table class="table table-striped">
  <thead><tr><th>#</th><th>Nombre</th><th>Precio</th><th>Acciones</th></tr></thead>
  <tbody>
    <?php foreach($services as $s): ?>
      <tr>
        <td><?= $s['id'] ?></td>
        <td><?= htmlspecialchars($s['nombre']) ?></td>
        <td>$<?= number_format($s['precio'],0,',','.') ?></td>
        <td>
          <a class="btn btn-sm btn-outline-secondary" href="edit.php?id=<?= $s['id'] ?>">Editar</a>
          <a class="btn btn-sm btn-outline-danger" href="delete.php?id=<?= $s['id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php include __DIR__ . '/../../includes/footer.php';
