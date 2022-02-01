<?php

$admin_login = "root";
$admin_password = "123";

$login = $_POST['login'];
$password = $_POST['password'];

if($login == $admin_login && $password == $admin_password) {
    header("Location: ../../vendor/admin.php");
}
else{
    header("Location: ../../errors/admin_login_error.php");
}


