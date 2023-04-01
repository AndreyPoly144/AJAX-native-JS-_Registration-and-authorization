<?php
ini_set('session.save_path', "/var/www/html/session");
session_start();

//ЕСЛИ ПОЛЯ НЕ ЗАПОЛНЕНЫ
if($_POST['name']==''){
    $response=['status'=>'error', 'message'=>'Укажите ваше имя', 'where'=>'name'];
    header('Content-type: application/json');
    echo json_encode($response);
    exit;
}
if($_POST['login']==''){
    $response=['status'=>'error', 'message'=>'Заполните логин', 'where'=>'login'];
    header('Content-type: application/json');
    echo json_encode($response);
    exit;
}
if($_POST['mail']==''){
    $response=['status'=>'error', 'message'=>'Укажите вашу почту', 'where'=>'mail'];
    header('Content-type: application/json');
    echo json_encode($response);
    exit;
}
if($_POST['password']==''){
    $response=['status'=>'error', 'message'=>'Введите пароль', 'where'=>'password'];
    header('Content-type: application/json');
    echo json_encode($response);
    exit;
}
//ВАЛИДАЦИЯ ПОЧТЫ
if(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
    $response=['status'=>'error', 'message'=>'Некорректный адрес почты', 'where'=>'mail'];
    header('Content-type: application/json');
    echo json_encode($response);
    exit;
}

//ЕСЛИ ПАРОЛИ НЕ СОВПАЛИ
if ( $_POST['password'] != $_POST['passwordAgain']) {
    $response=['status'=>'error', 'message'=>'Пароли не совпадают', 'where'=>'passwordAgain'];
    header('Content-type: application/json');
    echo json_encode($response);
    exit;
}

//ПРОВЕРЯЕМ ЧТОБЫ В БД НЕ БЫЛО 2 ОДИНАКОВЫХ ЛОГИНОВ
require_once 'includes/connect.php';
    $result = mysqli_query($link, "SELECT * FROM `users` WHERE `Логин`='{$_POST['login']}'");   //отфильтрвываю все строки которые содержат логин введеный пол-ль
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (!empty($data)) {
        $response=['status'=>'error', 'message'=>'Такой логин уже занят', 'where'=>'login'];
        header('Content-type: application/json');
        echo json_encode($response);
        exit;
    } else {                      //ЗАНОСИМ ПОЛЬЗОВАТЕЛЯ В БД
        $pw_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($link, "INSERT INTO `users` (`Имя`, `Логин`, `Почта`, `Пароль`) VALUES ('{$_POST['name']}', '{$_POST['login']}', '{$_POST['mail']}', '$pw_hash')");
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['status']='endreg';
        $response=['status'=>'success'];
        header('Content-type: application/json');
        echo json_encode($response);
        exit;
    }

