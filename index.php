<?php

    session_start();

    include "classes/template.php";
    include "system/connection.php";
    include "classes/town.php";
    $template=new Template();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My Browser Game</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
</head>
<body>
    <div id="wrapper">
        <?php $template->showTop(); ?>
        <div id="main">
           <?php
             if(isset($_GET['page'])){
                 include "pages/".$_GET['page'].".php";
             }else{
                 echo "Welcome to the game. You need to register or login to play the game.";
             }
           ?>
        </div>
        <?php $template->showFooter(); ?>
    </div>
</body>
</html>