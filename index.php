<?php
ini_set('session.save_path', "/var/www/html/session");
session_start();
$login='';
$password='';
if (!empty($_SESSION['login']) && !empty($_SESSION['password'])){
    $login=$_SESSION['login'];  $password=$_SESSION['password'];
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/Project_AJAX_Login_Register/css/style.css" rel="stylesheet">
    <title>Вход</title>
</head>
<body>
<form>
    <input type='text' placeholder='Логин' name='login' value="<?=$login?>">
    <input type='password' placeholder='Пароль' name='password' value="<?=$password?>">
<?php
if(!empty($_SESSION) && $_SESSION['status']=='endreg'){
    echo "<p class='reg'>Регистрация прошла успешно</p>";
    $_SESSION['status']='';
}else{
    echo   '<p id="message" class="hidden">Message</p>';
}
?>
    <input type="submit" class="button" id="btn-log" value="Войти">
</form>
<p>Нет аккаунта? - <a href="register.php">Регистрация</a><p>

<script src="js/log.js"></script>

</body>
</html>
