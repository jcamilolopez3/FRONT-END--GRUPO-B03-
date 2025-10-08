<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/User.php';
require_once __DIR__ . '/../../includes/header.php';

$error = '';
if ($_SERVER['REQUEST_METHOD']==='POST'){
  $email = trim($_POST['email']??'');
  $password = $_POST['password']??'';
  $user = User::findByEmail($email);
  if ($user && password_verify($password, $user['password_hash'])){
    $_SESSION['user'] = $user;
    header('Location: ' . BASE_URL . '/index.php');
    exit;
  } else {
    $error = 'Credenciales inválidas';
  }
}
?>
<div class="row justify-content-center">
  <div class="col-md-5">
    <div class="card">
      <div class="card-header">Ingreso</div>
      <div class="card-body">
        <?php if($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
        <form method="post">
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" required>
          </div>
          <button class="btn btn-primary" type="submit">Entrar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/../../includes/footer.php';
