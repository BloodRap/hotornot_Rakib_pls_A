<?php

    session_start();
    include "classes.php";
    $rating = new rating();
    $rating->showThem($_GET['theme']); // skickar pool för att visa 2 random bilder från den

?>
