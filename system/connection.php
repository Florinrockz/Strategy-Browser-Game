<?php
    $host="localhost";
    $user="root";
    $password="";
    $database="browsergame";
    $dsn="mysql:host=".$host.";dbname=".$database.";";
    try {
        $pdo=new PDO($dsn,$user,$password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        $e->getMessage();
        die();
    }