<?php include "/Library/WebServer/Documents/includes/preload.php";
    include "/Library/WebServer/Documents/includes/head.php";?>
<title>Magic Card Dev Database</title>
</head>
<body>
<?php include "/Library/WebServer/Documents/includes/navbar.php"; ?>

<br><br>

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
?>
<div class="col-md-10">
<?php
if (is_numeric($_GET["ID"]) ) {
	$sql = "SELECT Card_ID FROM Cards WHERE Card_ID =" . $_GET["ID"];

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		if ( isset($_POST["CardUpdate"]) ){
			$sql = "UPDATE Cards SET Name='"	. $conn->real_escape_string($_POST["Name"]). "', Cost='". $conn->real_escape_string($_POST["Cost"]). "', Type='" . $conn->real_escape_string($_POST["Type"]). "', SubType='". $conn->real_escape_string($_POST["Subtype"]). "', Rarity='". $_POST["Rarity"]. "', Text='". $conn->real_escape_string($_POST["Text"]). "', Flavour='". $conn->real_escape_string($_POST["Flavour"]). "', Power=" . $_POST["Power"]. ", Toughness=". $_POST["Toughness"]. ", Comments='". $conn->real_escape_string($_POST["Comments"]). "', DevStage='". $conn->real_escape_string($_POST["DevStage"]). "', Color='". $_POST["Color"] . "' WHERE Card_ID=". $_GET["ID"];
			if ($conn->query($sql) === TRUE) {
				echo "<font color=\"blue\">Card updated successfully</font><br>";
			} else { 
				echo "<font color=\"red\">Error updating record: ". $conn->error . "</font><br>";
			}
		}
		$sql = "SELECT * FROM Cards WHERE Card_ID =" . $_GET["ID"];

		$result = $conn->query($sql);
    	// output data of each row
    	while($row = $result->fetch_assoc()) {
    		?>
    	    <form method="POST" id="CardUpdate" action=<?php echo "\"card.php?ID=".$row["Card_ID"]."\""; ?> >
    	    <input id="CardUpdate" name="CardUpdate" type="submit" value="Update Card"><br>
    	    ID: <input type="text" name="ID" readonly form="CardUpdate CommentUpdate" value=<?php echo "\"".$row["Card_ID"]."\""; ?> >
    	    Development Stage: <select name="DevStage">
    	    <?php 
    	    	$sql = "SELECT CardOption FROM CardOptions WHERE Category='DevStage'";
				$currList = $conn->query($sql);
				while($currRow = $currList->fetch_assoc()) {
					echo "<option value=\"".$currRow["CardOption"]."\"";
    				if ($currRow["CardOption"] == $row["DevStage"]) { echo " selected"; }
    				echo ">".$currRow["CardOption"]."</option>\n";
				} 
    	    ?>
    	    </select><br><br>
    	    Name: <input type="text" name="Name" value=<?php echo "\"".$row["Name"]."\""; ?> >  
    	    Cost: <input type="text" name="Cost" value=<?php echo "\"".$row["Cost"]."\""; ?> ><br>
    	    Type - Subtype<br>
    	    <select name="Type">
    	    <?php 
    	    	$sql = "SELECT CardOption FROM CardOptions WHERE Category='Type'";
				$currList = $conn->query($sql);
				while($currRow = $currList->fetch_assoc()) {
					echo "<option value=\"".$currRow["CardOption"]."\"";
    				if ($currRow["CardOption"] == $row["Type"]) { echo " selected"; }
    				echo ">".$currRow["CardOption"]."</option>\n";
				}
    	    ?>
    	    </select>
    	     - <input type="text" name="Subtype" value=<?php echo "\"".$row["Subtype"]."\""; ?> ><br>
    	    Rarity: <select name="Rarity">
    	    <?php 
    	    	$sql = "SELECT CardOption FROM CardOptions WHERE Category='Rarity'";
				$currList = $conn->query($sql);
				while($currRow = $currList->fetch_assoc()) {
					echo "<option value=\"".$currRow["CardOption"]."\"";
    				if ($currRow["CardOption"] == $row["Rarity"]) { echo " selected"; }
    				echo ">".$currRow["CardOption"]."</option>\n";
				} 
    	    ?>
    	    </select>
    	    Color: <select name="Color">
    	    <?php 
    	    	$sql = "SELECT CardOption FROM CardOptions WHERE Category='Color'";
				$currList = $conn->query($sql);
				while($currRow = $currList->fetch_assoc()) {
					echo "<option value=\"".$currRow["CardOption"]."\"";
    				if ($currRow["CardOption"] == $row["Color"]) { echo " selected"; }
    				echo ">".$currRow["CardOption"]."</option>\n";
				} 
    	    ?>
    	    </select>
    	    <br>
    	    Text: <br>
    	    <textarea name="Text" rows="6" cols="70"><?php echo $row["Text"]; ?></textarea><br>
    	    Flavour:<br>
    	    <textarea name="Flavour" rows="2" cols="70"><?php echo $row["Flavour"]; ?></textarea><br>
    	    <br>
    	    <?php if ( strpos($row["Type"],"Creature") !== false) { ?>
    	    	Power:<input type="number" name="Power" value=<?php echo "\"".$row["Power"]."\""; ?> > / Tough:<input type="number" name="Toughness" value=<?php echo "\"".$row["Toughness"]."\""; ?> ><br>
    	    <?php } elseif ( $row["Type"] == "Planeswalker") { ?>
    	    	<input type="hidden" name="Power" value=<?php echo "\"".$row["Power"]."\""; ?> >Loyalty:<input type="number" name="Toughness" value=<?php echo "\"".$row["Toughness"]."\""; ?> ><br>
    	    <?php } else { ?>
    	    	<input type="hidden" name="Power" value=<?php echo "\"".$row["Power"]."\""; ?> ><input type="hidden" name="Toughness" value=<?php echo "\"".$row["Toughness"]."\""; ?> ><br>
    	    <?php } ?>
    	    <br>
    	    Comments:<br>
    	    <textarea name="Comments" rows="6" cols="70"><?php echo $row["Comments"]; ?></textarea><br>
    	    
    	    <input id="CardUpdate" name="CardUpdate" type="submit" value="Update Card"></form><br>
    	    <br>
    	    <?php
    	}
	} else {
    	echo "0 results";
	}
}
?>
</div>
<?php
$conn->close();
include "/Library/WebServer/Documents/includes/footer.php";
?>

</body></html>
