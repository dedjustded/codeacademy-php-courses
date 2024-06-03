<html>
<body>
<?php
$phone = $_POST['phone'];
$regex = "/^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/";
if (preg_match($regex, $phone)) {
    echo "телефонният номер е валиден, благодарим!";
} else {
    echo "Телефонният номер е невалиден, моля пробвайте пак";
}
?>
<form method="POST">
    <label for="phone">Телефонен номер:</label>
    <input type="text" name="phone" id="phone">
    <button type="submit">Провери</button>
</form>
</body>
</html>

