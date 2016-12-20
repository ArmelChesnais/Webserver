<?php include_once "/Library/WebServer/Documents/includes/preload.php";
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
if (is_numeric($_GET["ID"]) ) {
	$sql = "SELECT Card_ID FROM Cards WHERE Card_ID =" . $_GET["ID"] . " LIMIT 1";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$sql = "SELECT * FROM Cards WHERE Card_ID =" . $_GET["ID"];

		$result = $conn->query($sql);
    	// output data of each row
    	while($row = $result->fetch_assoc()) { ?>
            <div style="max-width: 400px">
    		ID: <?php echo $row["Card_ID"]; ?>, DevStage: <?php echo $row["DevStage"]; ?> <br>
    	    Name: <?php echo $row["Name"]; ?>, Cost: <?php echo $row["Cost"]; ?> <br>
            <?php echo $row["Type"] . " - " . $row["Subtype"]; ?> <br>
    	    <?php echo $row["Rarity"]; ?>, Color: <?php echo $row["Color"]; ?>
            <div style="border-style: solid; border-width:1px; border-color:#000; padding:1px"> <?php
                if ( $row["Text"] != "") {?>
    	    Text: <br>
            <?php echo $row["Text"];
                }
                if ( $row["Flavour"] != "") {?><br>
    	    Flavour:<br>
    	    <?php echo $row["Flavour"];
                } ?></div>
    	    <?php if ( strpos($row["Type"],"Creature") !== false) { ?>
    	    	Power: <?php echo $row["Power"]; ?> / Tough: <?php echo $row["Toughness"]; ?> <br>
    	    <?php } elseif ( $row["Type"] == "Planeswalker") { ?>
    	    	Loyalty: <?php echo $row["Toughness"]; ?> <br>
    	    <?php }
                if ( $row["Comments"] != "Comments") {?>
    	    <br>
    	    Comments:<br>
    	    <?php echo $row["Comments"];
                }?>
            </div>
    	    <?php
    	}
	} else {
    	echo "0 results";
	}
}
$conn->close();
?>
