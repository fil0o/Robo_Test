<?php
    $connect = mysqli_connect('localhost', 'root', '', 'robo');

    if (!$connect) {
        die('Ошибка подключения к базе данных!');
    }
    