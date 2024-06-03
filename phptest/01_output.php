<?php
$username = 'Gergin'
function hasPrivilegiesToLogin($username, $password) {
    echo 'Login user:' + $username;
    echo 'hasPrivilegiesTo:ogin: no';
    return false;
}
echo hasPrivilegiesToLogin ('Dimcho', 'Parola123456');
?>