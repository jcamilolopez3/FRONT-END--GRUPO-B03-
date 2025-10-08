<?php
require_once __DIR__ . '/../../models/Comment.php';
require_once __DIR__ . '/../../config/config.php';
session_start();
if (!isset($_SESSION['user'])) { http_response_code(403); exit; }
Comment::create((int)$_POST['ticket_id'], $_SESSION['user']['id'], trim($_POST['cuerpo']));
header('Location: ' . BASE_URL . '/tickets/show.php?id='.(int)$_POST['ticket_id']);
