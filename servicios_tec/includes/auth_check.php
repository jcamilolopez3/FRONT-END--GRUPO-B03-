<?php
if (!isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL . '/auth/login.php');
    exit;
}
function requireRole(string $role) {
    if (!isset($_SESSION['user']) || $_SESSION['user']['rol'] !== $role) {
        http_response_code(403);
        echo '<div class="container py-5"><h3>Acceso denegado</h3><p>No tienes permisos suficientes.</p></div>';
        include __DIR__ . '/footer.php';
        exit;
    }
}
