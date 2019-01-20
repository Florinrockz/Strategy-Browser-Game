<?php

$town=new Town($pdo);

if (isset($_POST['location'])) {
    $town->CreateBuiding($_POST['location'],$_POST['building']);
    //header("Location: ?page=loggedIn.php");
}



?>