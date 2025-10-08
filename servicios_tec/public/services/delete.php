<?php
require_once __DIR__ . '/../../models/Service.php';
require_once __DIR__ . '/../../config/config.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['rol']!=='admin') { http_response_code(403); exit; }
Service::delete($_GET['id']??0);
header('Location: ' . BASE_URL . '/services/index.php');
