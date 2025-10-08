<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/header.php';
?>
<div class="p-4 bg-light rounded">
  <h1 class="display-6">Plataforma de Servicios Tecnológicos</h1>
  <p class="lead">Gestiona servicios, tickets y soporte técnico.</p>
  <?php if(!isset($_SESSION['user'])): ?>
    <a class="btn btn-primary" href="<?= BASE_URL ?>/auth/login.php">Ingresar</a>
  <?php else: ?>
    <a class="btn btn-primary" href="<?= BASE_URL ?>/tickets/index.php">Ir a Tickets</a>
    <?php if($_SESSION['user']['rol']==='admin'): ?>
      <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>/services/index.php">Gestionar Servicios</a>
    <?php endif; ?>
  <?php endif; ?>
</div>
<?php include __DIR__ . '/../includes/footer.php';
