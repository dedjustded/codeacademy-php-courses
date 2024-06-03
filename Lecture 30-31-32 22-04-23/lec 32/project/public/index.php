<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/app/request/get.php';
require_once __DIR__ . '/../src/app/request/post.php';
require_once __DIR__ . '/../src/app/session.php';
require_once __DIR__ . '/../src/superglobals.php';

use App\request\Get;
use App\request\Post;
use App\Session;
use superglobals\SuperGlobals;

$_POST = [
    'username' => 'admin',
    'password' => '123'
];

$_GET = [
    'id' => 123
];
$_SESSION = [
    'authenticated' => true,
    'user_id' => 456
];
require_once 'SuperGlobals.php';
$post = SuperGlobals::getInstance('post');
if(isset($post['username'])) {
    echo $post['username']; 
}
$get = SuperGlobals::getInstance('get');
if(isset($get['id'])) {
    echo $get['id'];
}
$session = SuperGlobals::getInstance('session');
if(isset($session['authenticated']) && $session['authenticated']) {
    echo $session['user_id']; 
}
?>
