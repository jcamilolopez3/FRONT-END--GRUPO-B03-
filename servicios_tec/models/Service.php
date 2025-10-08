<?php
require_once __DIR__ . '/../config/database.php';

class Service {
  public static function all() {
    return getPDO()->query('SELECT * FROM services ORDER BY id DESC')->fetchAll();
  }
  public static function create($nombre,$descripcion,$precio){
    $stmt=getPDO()->prepare('INSERT INTO services(nombre,descripcion,precio) VALUES(?,?,?)');
    return $stmt->execute([$nombre,$descripcion,$precio]);
  }
  public static function find($id){
    $stmt=getPDO()->prepare('SELECT * FROM services WHERE id=?');
    $stmt->execute([$id]);
    return $stmt->fetch();
  }
  public static function update($id,$nombre,$descripcion,$precio){
    $stmt=getPDO()->prepare('UPDATE services SET nombre=?, descripcion=?, precio=? WHERE id=?');
    return $stmt->execute([$nombre,$descripcion,$precio,$id]);
  }
  public static function delete($id){
    $stmt=getPDO()->prepare('DELETE FROM services WHERE id=?');
    return $stmt->execute([$id]);
  }
}
