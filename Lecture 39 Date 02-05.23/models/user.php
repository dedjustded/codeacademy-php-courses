<?php
class User {
  private $db;

  public function __construct() {
    $this->db = new PDO('mysql:host=localhost;dbname=mydb', 'username', 'password');
  }

  public function getAll() {
    $stmt = $this->db->query('SELECT * FROM users');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getById($id) {
    $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function create($data) {
    $stmt = $this->db->prepare('INSERT INTO users (name, email, phone) VALUES (:name, :email, :phone)');
    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':phone', $data['phone']);
    $stmt->execute();
  }
}
?>