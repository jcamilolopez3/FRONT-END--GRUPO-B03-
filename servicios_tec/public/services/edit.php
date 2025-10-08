<?php
require_once __DIR__ . '/../../models/Service.php';
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../includes/auth_check.php';
requireRole('admin');
$s = Service::find($_GET['id']??0);
?>
<h3>Editar servicio</h3>
<form method="post" action="update.php" class="col-md-6">
  <input type="hidden" name="id" value="<?= $s['id'] ?>" />
  <div class="mb-3">
    <label class="form-label">Nombre</label>
    <input name="nombre" class="form-control" value="<?= htmlspecialchars($s['nombre']) ?>" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Descripción</label>
    <textarea name="descripcion" class="form-control" rows="3"><?= htmlspecialchars($s['descripcion']) ?></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Precio</label>
    <input type="number" step="0.01" name="precio" class="form-control" value="<?= $s['precio'] ?>">
  </div>
  <button class="btn btn-primary">Actualizar</button>
</form>
<?php include __DIR__ . '/../../includes/footer.php';
