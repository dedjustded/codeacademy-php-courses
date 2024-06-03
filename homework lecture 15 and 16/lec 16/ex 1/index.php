<html>
<body>
<?php
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    if(!empty($email)){
        $regex = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";
        if (preg_match($regex, $email)) {
            echo "Имейл адресът е валиден.";
        } else {
            echo "Имейл адресът е невалиден.";
        }
    } else {
        echo "Моля, въведете имейл адрес.";
    }
}
?>
<form method="post">
    Имейл адрес: <input type="text" name="email">
    <input type="submit" name="submit" value="Провери">
</form>
</body>
</html>