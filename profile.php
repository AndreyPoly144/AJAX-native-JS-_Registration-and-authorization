<?php
ini_set('session.save_path', "/var/www/html/session");
session_start();
?>
<p>Welcome, <?=$_SESSION['name']?>, ваш логин - <?=$_SESSION['login']?></p>
<a href="/Project_AJAX_Login_Register/logout.php">Выйти</a>