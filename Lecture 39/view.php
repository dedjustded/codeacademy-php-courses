<?php
class View {
  public function showUsers($users) {
    foreach ($users as $user) {
      echo $user->getName() . ' ' . $user->getEmail() . '<br>';
    }
  }
}
?>