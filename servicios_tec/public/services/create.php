<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../includes/auth_check.php';
requireRole('admin');
?>
<h3>Nuevo servicio</h3>
<form method="post" action="store.php" class="col-md-6">
  <div class="mb-3">
    <label class="form-label">Nombre</label>
    <input name="nombre" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Descripción</label>
    <textarea name="descripcion" class="form-control" rows="3"></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Precio</label>
    <input type="number" step="0.01" name="precio" class="form-control" value="0">
  </div>
  <button class="btn btn-primary">Guardar</button>
</form>
<?php include __DIR__ . '/../../includes/footer.php';
