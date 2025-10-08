<?php
require_once __DIR__ . '/../../includes/header.php';
require_once __DIR__ . '/../../includes/auth_check.php';
require_once __DIR__ . '/../../models/Ticket.php';
require_once __DIR__ . '/../../models/Comment.php';
require_once __DIR__ . '/../../config/database.php';
$pdo = getPDO();
$id = (int)($_GET['id'] ?? 0);
$ticket = Ticket::find($id);
if (!$ticket) { echo '<div class="alert alert-danger">Ticket no encontrado</div>'; include __DIR__ . '/../../includes/footer.php'; exit; }

// Obtener nombres
$serviceName = null; if ($ticket['service_id']) { $stmt=$pdo->prepare('SELECT nombre FROM services WHERE id=?'); $stmt->execute([$ticket['service_id']]); $serviceName=$stmt->fetchColumn(); }
$clienteName = $pdo->query('SELECT nombre FROM users WHERE id='.(int)$ticket['cliente_id'])->fetchColumn();
$asignadoName = $ticket['asignado_a'] ? $pdo->query('SELECT nombre FROM users WHERE id='.(int)$ticket['asignado_a'])->fetchColumn() : null;
$comments = Comment::byTicket($id);
?>
<div class="d-flex justify-content-between align-items-center mb-3">
  <h3>#<?= $ticket['id'] ?> - <?= htmlspecialchars($ticket['titulo']) ?></h3>
  <span class="badge bg-secondary">Estado: <?= $ticket['estado'] ?></span>
</div>
<ul class="list-group mb-3">
  <li class="list-group-item"><strong>Servicio:</strong> <?= htmlspecialchars($serviceName ?? '-') ?></li>
  <li class="list-group-item"><strong>Cliente:</strong> <?= htmlspecialchars($clienteName) ?></li>
  <li class="list-group-item"><strong>Asignado a:</strong> <?= htmlspecialchars($asignadoName ?? '-') ?></li>
  <li class="list-group-item"><strong>Creado:</strong> <?= $ticket['created_at'] ?></li>
  <li class="list-group-item"><strong>Descripción:</strong><br><?= nl2br(htmlspecialchars($ticket['descripcion'])) ?></li>
</ul>

<?php if($_SESSION['user']['rol']!=='cliente'): ?>
<div class="card mb-3">
  <div class="card-header">Asignar técnico</div>
  <div class="card-body">
    <form class="row g-2" action="assign.php" method="post">
      <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
      <div class="col-md-8">
        <select class="form-select" name="user_id">
          <option value="">-- Sin asignar --</option>
          <?php
          $stmt=$pdo->query("SELECT id, nombre FROM users WHERE rol='tecnico' ORDER BY nombre");
          foreach($stmt->fetchAll() as $u){
            $sel = ($ticket['asignado_a']==$u['id'])?'selected':'';
            echo "<option value='{$u['id']}' $sel>" . htmlspecialchars($u['nombre']) . "</option>";
          }
          ?>
        </select>
      </div>
      <div class="col-md-4"><button class="btn btn-outline-primary w-100">Actualizar</button></div>
    </form>
  </div>
</div>
<div class="card mb-3">
  <div class="card-header">Estado</div>
  <div class="card-body">
    <form class="row g-2" method="post" action="assign.php">
      <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
      <input type="hidden" name="update_status" value="1">
      <div class="col-md-8">
        <select class="form-select" name="estado">
          <?php foreach(['abierto','en_progreso','resuelto','cerrado'] as $e): ?>
            <option <?= $ticket['estado']===$e?'selected':'' ?> value="<?= $e ?>"><?= $e ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-4"><button class="btn btn-outline-secondary w-100">Cambiar</button></div>
    </form>
  </div>
</div>
<?php endif; ?>

<div class="card mb-3">
  <div class="card-header">Comentarios</div>
  <div class="card-body">
    <?php foreach($comments as $c): ?>
      <div class="mb-2"><strong><?= htmlspecialchars($c['nombre']) ?></strong> <small class="text-muted"><?= $c['created_at'] ?></small><br><?= nl2br(htmlspecialchars($c['cuerpo'])) ?></div>
      <hr>
    <?php endforeach; ?>
    <form method="post" action="comment.php">
      <input type="hidden" name="ticket_id" value="<?= $ticket['id'] ?>">
      <div class="mb-2"><textarea name="cuerpo" class="form-control" rows="3" placeholder="Escribe un comentario..." required></textarea></div>
      <button class="btn btn-primary">Enviar</button>
    </form>
  </div>
</div>
<?php include __DIR__ . '/../../includes/footer.php';
