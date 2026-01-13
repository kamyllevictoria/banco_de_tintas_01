<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $db = "banco_tintas";

    $mysqli = new mysqli($host, $username, $password, $db);

    if($mysqli -> connect_errno) {
        echo "Falha ao conectar ao Mysql: " . $mysqli -> connect_error;
        exit();
    }

    return $mysqli;
?>