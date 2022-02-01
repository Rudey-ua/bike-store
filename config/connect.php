<?php

$connect = mysqli_connect('127.0.0.1','root', '', 'crud');

if ($connect == false) {
    exit('Ошибка подключения к базе данных');
}
