<?php
    include "/Library/WebServer/Documents/includes/preload.php";
    verifyAuthority($loggedUser, 5);
    
    header('Content-type:image/jpg');
    readfile("/Library/WebServer/includes/media/turtles.jpg");
?>
