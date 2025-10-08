<?php
require_once __DIR__ . '/../../models/Service.php';
require_once __DIR__ . '/../../config/config.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['rol']!=='admin') { http_response_code(403); exit; }
Service::update($_POST['id'], $_POST['nombre'], $_POST['descripcion']??'', $_POST['precio']??0);
header('Location: ' . BASE_URL . '/services/index.php');
