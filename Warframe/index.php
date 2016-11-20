<?php include "/Library/WebServer/Documents/includes/preload.php";
    include "/Library/WebServer/Documents/includes/head.php";
    ?>
	<title>FireryRage.no-ip</title>
  </head>

  <body role="document">
  <?php include "/Library/WebServer/Documents/includes/navbar.php"; ?>
user is: <?php echo $_SESSION["username"]; ?><br>
<a href="<?php echo HOSTURL; ?>items.php">items</a><br>
<a href="<?php echo HOSTURL; ?>options.php">options</a>
<?php include "/Library/WebServer/Documents/includes/footer.php"; ?>
</body></html>
 
