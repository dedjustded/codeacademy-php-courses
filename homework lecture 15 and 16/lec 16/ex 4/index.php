<html>
<body>
<?php
if(isset($_POST['submit'])){
    $IP = $_POST['IP'];
    if(!empty($IP)){
        $regex = "/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$|^(?:(?:(?:[0-9a-fA-F]){1,4}):){7}(?:(?:[0-9a-fA-F]){1,4})$/";
        if (preg_match($regex, $IP)) {
            echo "IP адреса ви е валиден.";
        } else {
            echo "IP адреса ви е невалиден.";
        }
    } else {
        echo "Моля, въведете IP адрес.";
    }
}
?>
<form method="post">
    IP  address: <input type="text" name="IP">
    <input type="submit" name="submit" value="Провери">
</form>
</body>
</html>

