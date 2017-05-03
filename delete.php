<?php

    include "classes.php";
    $rating = new rating();
    $rating->delete($_POST['theme'], $_POST['id']) // skickar pool och id av bild för att radera den

?>
