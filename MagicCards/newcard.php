<?php include "/Library/WebServer/Documents/includes/preload.php";
    include "/Library/WebServer/Documents/includes/head.php";?>
<title>Magic Card Dev Database</title>
<?php
$servername = HOST;
$username = USER;
$password = PASSWORD;
$dbname = CARDDATABASE;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql = "INSERT INTO Cards (Name, Cost, Type, Subtype, Rarity, Text, Flavour, Power, Toughness, Comments, DevStage, Color) VALUES ('New Card', '0', 'Creature', '', 'Common', '', '', '0', '0', '', 'Concept', 'W')";


if ($conn->query($sql) === TRUE) {
	$last_id = $conn->insert_id;
echo "<meta http-equiv=\"REFRESH\" content=\"0; url=card.php?ID=" . $last_id . "\">" 
?>

<?php
} else { 
?>

</head>
<body>
<?php include "/Library/WebServer/Documents/includes/navbar.php"; ?>
<br><br>
 <font color="red">Error updating record: "<?php echo $conn->error; ?></font><br>
<?php
}

$conn->close();
include "/Library/WebServer/Documents/includes/footer.php";
?>

</body></html>
