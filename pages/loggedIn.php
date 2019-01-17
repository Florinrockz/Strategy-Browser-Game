<?php
    echo "Welcome <b>".$_SESSION['loggedIn']."</b>!";
    $town=new Town($pdo);
    $town->GetResources();
?>

<br><br>

<?php

    $town->DrawTownBuidings();

?>