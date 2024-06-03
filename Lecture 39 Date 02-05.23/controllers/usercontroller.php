<?php
class UserController {
  private $userModel;

  public function __construct() {
    $this->userModel = new User();
  }

  public function handleAction() {
    $action = $_GET['action'] ?? 'index';

    switch ($action) {
      case 'create':
        $this->create();
        break;
      case 'edit':
        $this->edit();
        break;
      default:
        $this->index();
        break;
    }
  }

  private function index() {
    $users = $this->userModel->getAll();
    include('views/users/index.php');
  }

  private function create() {
    $this->userModel->create($_POST);
    header('Location: /?action=index');
  }

  private function edit() {
    $id = $_GET['id'];
    $user = $this->userModel->getById($id);
    include('views/users/edit.php');
  }
}
?>