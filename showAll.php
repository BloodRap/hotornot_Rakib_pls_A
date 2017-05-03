<?php

    include "classes.php";
    $rating = new rating();
    $rating->showAll($_GET['theme']); // skickar pool för att visa alla bilder från den

?>
