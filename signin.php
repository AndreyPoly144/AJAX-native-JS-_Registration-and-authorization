<?php
ini_set('session.save_path', "/var/www/html/session");
session_start();
if(empty($_POST)){header("Location: /Project_AJAX_Login_Register/");}
require_once 'includes/connect.php';

//ЕСЛИ ПОЛЯ НЕ ЗАПОЛНЕНЫ
if($_POST['login']==''){
    $response=['status'=>'error', 'message'=>'Вы не заполнили логин', 'where'=>'login'];
    header('Content-type: application/json');
    echo json_encode($response);
    exit;
}
if($_POST['password']==''){
    $response=['status'=>'error', 'message'=>'Вы не ввели пароль', 'where'=>'password'];
    header('Content-type: application/json');
    echo json_encode($response);
    exit;
}

//ЕСЛИ ЛОГИН УЖЕ ЗАРЕГИСТРИРОВАН
if(!empty($_POST['login']) && !empty($_POST['password'])){
    $result = mysqli_query($link, "SELECT * FROM `users` WHERE `Логин`='{$_POST['login']}'");//выбираем запись из бд с логином который ввел клиент
    $data=mysqli_fetch_all($result, MYSQLI_ASSOC);
    if(empty($data)){
        $_SESSION['message']='errorIN';
        $_SESSION['login']=$_POST['login']; $_SESSION['password']=$_POST['password'];
        $response=['status'=>'error', 'message'=>'Неверный логин', 'where'=>'login'];
        header('Content-type: application/json');
        echo json_encode($response);
        exit;
    }
    //ЕСЛИ НЕКОРРЕКТНЫЙ ПАРОЛЬ
    $hash=$data[0]['Пароль'];
    if(!password_verify($_POST['password'], $hash)){
        $_SESSION['message']='errorINPW';
        $_SESSION['login']=$_POST['login']; $_SESSION['password']=$_POST['password'];
        $response=['status'=>'error', 'message'=>'Неверный пароль', 'where'=>'password'];
        header('Content-type: application/json');
        echo json_encode($response);
        exit;
    }

//УСПЕШНЫЙ ВХОД
    $_SESSION['login']=$_POST['login']; $_SESSION['name']=$data[0]['Имя'];
}
$response=['status'=>'success'];
header('Content-type: application/json');
echo json_encode($response);
exit;
?>

