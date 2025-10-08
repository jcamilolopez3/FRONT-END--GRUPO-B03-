<?php
require_once __DIR__ . '/../../models/Ticket.php';
require_once __DIR__ . '/../../config/config.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['rol']==='cliente') { http_response_code(403); exit; }
$id = (int)($_POST['id'] ?? 0);
if (isset($_POST['update_status'])){
  Ticket::setStatus($id, $_POST['estado'] ?? 'abierto');
} else {
  $uid = ($_POST['user_id'] !== '') ? (int)$_POST['user_id'] : null;
  Ticket::assign($id, $uid);
}
header('Location: ' . BASE_URL . '/tickets/show.php?id=' . $id);
