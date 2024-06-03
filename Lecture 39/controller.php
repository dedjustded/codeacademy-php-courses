<?php
require_once 'model.php';
require_once 'view.php';

class Controller {
  private $model;
  private $view;

  public function __construct() {
    $this->model = new Model();
    $this->view = new View();
  }

  public function index() {
    $users = $this->model->getUsers();
    $this->view->showUsers($users);
  }
}
?>

