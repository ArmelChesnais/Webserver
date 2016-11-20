<?php
    include "/Library/WebServer/includes/preload.php";
    if ( getUserAuthority($loggedUser) >= 5) {
        header('Content-type:image/jpg');
        readfile("/Library/WebServer/includes/media/turtles.jpg");
    } else {
        header($_SERVER["SERVER_PROTOCOL"]." 403 Forbidden");
    }
?>
