<?php
//mysqli_report(MYSQLI_REPORT_ALL);
$link = mysqli_connect('mysql', 'root', '144', 'Project_Login_Register');
//print_r($link);
if(mysqli_connect_errno()){
    exit('Ошибка подключения, код ошибки -'. mysqli_connect_errno().', описание ошибки - '.mysqli_connect_error());
}
