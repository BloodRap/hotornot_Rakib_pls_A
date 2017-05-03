<?php

    session_start();
    include "classes.php";
    $rating = new rating();
    $rating->upvote($_POST['id'], $_POST['theme']); // skickar pool och id av bild som du har röstat för

?>
