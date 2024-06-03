<?php
require_once 'database.php';
require_once 'user.php';

class Model {
  private $db;

  public function __construct() {
    $this->db = Database::getInstance();
  }

  public function getUsers() {
    $stmt = $this->db->query('SELECT * FROM users');

    $users = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $user = new User();
      $user->setId($row['id']);
      $user->setName($row['name']);
      $user->setEmail($row['email']);
      $user->setPassword($row['password']);
      $users[] = $user;
    }

    return $users;
}

public function addUser(User $user) {
        $stmt = $this->db->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        $stmt->bindValue(':name', $user->getName());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->execute();
        }
        
        public function updateUser(User $user) {
        $stmt = $this->db->prepare('UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id');
        $stmt->bindValue(':id', $user->getId());
        $stmt->bindValue(':name', $user->getName());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->execute();
        }
        
        public function deleteUser($id) {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = :id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        }
        }