<?php
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../models/Service.php';
$services = Service::all();
?>
<h3>Nuevo ticket</h3>
<form method="post" action="store.php" class="col-md-8">
  <div class="mb-3">
    <label class="form-label">Título</label>
    <input name="titulo" class="form-control" required>
  </div>
  <div class="mb-3">
    <label class="form-label">Descripción</label>
    <textarea name="descripcion" class="form-control" rows="4" required></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Servicio asociado (opcional)</label>
    <select name="service_id" class="form-select">
      <option value="">-- Selecciona --</option>
      <?php foreach($services as $s): ?>
        <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['nombre']) ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <button class="btn btn-primary">Crear</button>
</form>
<?php include __DIR__ . '/../../includes/footer.php';
