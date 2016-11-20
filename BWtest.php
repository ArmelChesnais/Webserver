<?php include "/Library/WebServer/Documents/includes/preload.php";
    include "/Library/WebServer/Documents/includes/head.php";

?>
<title>FireryRage</title>
</head>
<body role="document" style="background-color:black;">
<?php
//include "/Library/WebServer/includes/navbar.php.en";

    if ($err_msg <> "") echo $err_msg;
?>
<h1 style="color:#888888">Adjust the screen width!</h1>
<div style="position:relative">

<div style="position:relative;background-color: #000000;width:100vw;color:#ffffff">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>

<div style="position:absolute;top:0px;background-color: #ffffff;width:calc(1200px - 90vw);overflow-x:hidden">
<div style="position:relative;width:100vw;color:#000000;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
</div>


<div style="position:absolute;top:0px;background-color: #ff0000;width:calc(4000px - 800vw);overflow-x:hidden;height:100%">
<div style="position:relative;width:100vw;color:#00cc22;font-size:300%;font-weight:bold">MERRY CHRISTMAS</div>
</div>

</div>
<?php
    $conn->close();
/*$_SESSION['test'] = 42;
$test = 43;
echo $_SESSION['test'];*/
include "/Library/WebServer/Documents/includes/footer.php.en";
?>
</body></html>
