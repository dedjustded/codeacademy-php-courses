<?php
$user = [
  'name' => '',
  'email' => '',
  'phone' => ''
];

include('views/partials/header.php');
?>
<h2>Create User</h2>

<form method="post" action="/?action=create">
  <div>
    <label>Name</label>
    <input type="text" name="name">
  </div>
  <div>
    <label>Email</label>
    <input type="text" name="email">
  </div>
  <div>
    <label>Phone</label>
    <input type="text" name="phone">
  </div>
  <button type="submit">Save</button>
</form>

<?php include('views/partials/user-form.php'); ?>
<?php include('views/partials/footer.php'); ?> 