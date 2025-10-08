<?php
require_once __DIR__ . '/../config/database.php';

class Comment {
  public static function byTicket($ticket_id){
    $stmt=getPDO()->prepare('SELECT c.*, u.nombre FROM comments c JOIN users u ON u.id=c.user_id WHERE ticket_id=? ORDER BY c.id ASC');
    $stmt->execute([$ticket_id]);
    return $stmt->fetchAll();
  }
  public static function create($ticket_id,$user_id,$cuerpo){
    $stmt=getPDO()->prepare('INSERT INTO comments(ticket_id,user_id,cuerpo) VALUES (?,?,?)');
    return $stmt->execute([$ticket_id,$user_id,$cuerpo]);
  }
}
