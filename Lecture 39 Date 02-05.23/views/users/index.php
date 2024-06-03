<?php 
foreach ($users as $user): 
?>
  <div>
    <h3><?= $user['name'] ?></h3>
    <p>Email: <?= $user['email'] ?></p>
    <p>Phone: <?= $user['phone'] ?></p>
    <a href="/?action=edit&id=<?= $user['id'] ?>">Edit</a>
  </div>
<?php endforeach; ?>