<form method="post" action="/?action=create">
  <div>
    <label>Name</label>
    <input type="text" name="name" value="<?= $user['name'] ?>">
  </div>
  <div>
    <label>Email</label>
    <input type="text" name="email" value="<?= $user['email'] ?>">
  </div>
  <div>
    <label>Phone</label>
    <input type="text" name="phone" value="<?= $user['phone'] ?>">
  </div>
  <button type="submit">Save</button>
</form>
