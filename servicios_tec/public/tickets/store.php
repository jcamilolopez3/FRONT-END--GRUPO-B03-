<?php
require_once __DIR__ . '/../../models/Ticket.php';
require_once __DIR__ . '/../../config/config.php';
session_start();
if (!isset($_SESSION['user'])) { http_response_code(403); exit; }
$id = Ticket::create($_POST['titulo'], $_POST['descripcion'], $_POST['service_id'] ?? null, $_SESSION['user']['id']);
header('Location: ' . BASE_URL . '/tickets/show.php?id=' . $id);
