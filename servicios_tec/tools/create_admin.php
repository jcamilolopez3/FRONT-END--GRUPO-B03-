<?php
require_once __DIR__ . '/../config/database.php';
$pdo = getPDO();
$nombre = 'Admin';
$email = 'admin@demo.com';
$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);
$rol = 'admin';
try {
  $pdo->prepare('INSERT INTO users(nombre,email,password_hash,rol) VALUES (?,?,?,?)')->execute([$nombre,$email,$hash,$rol]);
  echo "Admin creado: $email / $password";
} catch (Throwable $e) {
  echo "Error: " . $e->getMessage();
}
