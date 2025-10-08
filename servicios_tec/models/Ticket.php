<?php
require_once __DIR__ . '/../config/database.php';

class Ticket {
  public static function allForRole($user){
    $pdo = getPDO();
    if ($user['rol']==='admin') {
      return $pdo->query("SELECT t.*, s.nombre AS service_name, u.nombre AS cliente, t.asignado_a 
                          FROM tickets t 
                          LEFT JOIN services s ON s.id=t.service_id 
                          JOIN users u ON u.id=t.cliente_id 
                          ORDER BY t.id DESC")->fetchAll();
    }
    if ($user['rol']==='tecnico'){ 
      $stmt=$pdo->prepare("SELECT t.*, s.nombre AS service_name, u.nombre AS cliente, t.asignado_a 
                           FROM tickets t 
                           LEFT JOIN services s ON s.id=t.service_id 
                           JOIN users u ON u.id=t.cliente_id 
                           WHERE t.asignado_a = ? 
                           ORDER BY t.id DESC");
      $stmt->execute([$user['id']]);
      return $stmt->fetchAll();
    }
    // cliente
    $stmt=$pdo->prepare('SELECT t.*, s.nombre AS service_name FROM tickets t LEFT JOIN services s ON s.id=t.service_id WHERE t.cliente_id = ? ORDER BY t.id DESC');
    $stmt->execute([$user['id']]);
    return $stmt->fetchAll();
  }
  public static function create($titulo,$descripcion,$service_id,$cliente_id){
    $stmt=getPDO()->prepare('INSERT INTO tickets(titulo,descripcion,service_id,cliente_id) VALUES(?,?,?,?)');
    $sid = ($service_id !== null && $service_id !== '') ? $service_id : null;
    $stmt->execute([$titulo,$descripcion,$sid,$cliente_id]);
    return getPDO()->lastInsertId();
  }
  public static function find($id){
    $stmt=getPDO()->prepare('SELECT * FROM tickets WHERE id=?');
    $stmt->execute([$id]);
    return $stmt->fetch();
  }
  public static function assign($id,$user_id){
    $stmt=getPDO()->prepare('UPDATE tickets SET asignado_a=? WHERE id=?');
    return $stmt->execute([$user_id?:null,$id]);
  }
  public static function setStatus($id,$estado){
    $stmt=getPDO()->prepare("UPDATE tickets SET estado=? WHERE id=?");
    return $stmt->execute([$estado,$id]);
  }
}
