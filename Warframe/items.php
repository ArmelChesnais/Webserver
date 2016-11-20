<?php include "/Library/WebServer/includes/headpreload.php.en";?>
	<title>FireryRage.no-ip</title>
	<?php
$servername = HOST;
$username = USER;
$password = PASSWORD;
$dbname = WARFRAMEDB;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if ( isset($_POST["newname"]) ) {
	$stmt = $conn->prepare("INSERT INTO Item (Name, Number, Type, Family, Credits, Ducats, Plat) VALUES ( ?, 0, ?, ?, ?, ?, ?)");
	$stmt->bind_param('sssiii', $_POST["newname"], $_POST["newtype"], $_POST["newfamily"], $_POST["newcredits"], $_POST["newducats"], $_POST["newplat"]);
	$stmt->execute();
	$stmt->close();
	if ($stmt->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} elseif (1==0) {
	?><meta http-equiv="REFRESH" content="0; url=items.php"><?php 
	}
} elseif ( isset($_POST["ID"]) ) {
	$stmt = $conn->prepare("UPDATE Item SET Number=?, Plat=? WHERE ID=?;");
	$stmt->bind_param('iii', $_POST["number"], $_POST["Plat"], $_POST["ID"]);
	$stmt->execute();
	$stmt->close();
	if ($stmt->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
}
?>
  </head>

  <body role="document">
  <?php include "/Library/WebServer/includes/navbar.php.en"; ?>
<form method="POST" id="AddItem" action="items.php">
	Add item:<br>
	Name <input type="text" name="newname">
	Type: <select name="newtype">
    	    <?php 
    	    	$sql = "SELECT WFOption FROM WFOptions WHERE Category='Type'";
				$currList = $conn->query($sql);
				while($currRow = $currList->fetch_assoc()) {
					echo "<option value=\"".$currRow["WFOption"]."\"";
    				echo ">".$currRow["WFOption"]."</option>\n";
				} 
    	    ?>
    </select>
	Family: <select name="newfamily">
    	    <?php 
    	    	$sql = "SELECT WFOption FROM WFOptions WHERE Category='Family'";
				$currList = $conn->query($sql);
				while($currRow = $currList->fetch_assoc()) {
					echo "<option value=\"".$currRow["WFOption"]."\"";
    				echo ">".$currRow["WFOption"]."</option>\n";
				} 
    	    ?>
    </select><br>
	Credits <input type="number" name="newcredits">
	Ducats <input type="number" name="newducats">
	Plat <input type="number" name="newplat">
	<input type="submit" value="Post">
	</form><br>
	<form method="GET" id="Settings" action="items.php">
	Order By: <select name="Order">
    	    <?php 
    	    	$sql = "SELECT WFOption, Attribute FROM WFOptions WHERE Category='Order By'";
				$currList = $conn->query($sql);
				while($currRow = $currList->fetch_assoc()) {
					echo "<option value=\"".$currRow["WFOption"]."\"";
    				if ($currRow["WFOption"] == $_GET["Order"]) { echo " selected"; $order = $currRow["Attribute"];}
    				echo ">".$currRow["WFOption"]."</option>\n";
				} 
				if ( !isset($order) ) {$order = " ORDER BY Name";}
    	    ?>
    </select>
    Show: <select name="Show">
    	    <?php 
    	    	$sql = "SELECT WFOption, Attribute FROM WFOptions WHERE Category='Show'";
				$currList = $conn->query($sql);
				while($currRow = $currList->fetch_assoc()) {
					echo "<option value=\"".$currRow["WFOption"]."\"";
    				if ($currRow["WFOption"] == $_GET["Show"]) { echo " selected"; $where = $currRow["Attribute"];}
    				echo ">".$currRow["WFOption"]."</option>\n";
				} 
    	    ?>
    </select>
    <input type="submit" value="Display">
	</form>
	<br>
	<?php
		$sql = "SELECT * FROM Item";
		$sql = $sql . $where . $order;
		$result = $conn->query($sql);
		if ($result->num_rows > 0) { ?>
			<table class="table table-striped">
			<tr>
    		<th>ID</th>
    		<th>Name</th>
    		<th>Number</th>
    		<th>Type</th>
    		<th>Family</th>
    		<th>Credits</th>
    		<th>Ducats</th>
    		<th>Plat</th>
    		</tr>
		<?php
    	// output data of each row
    	while($row = $result->fetch_assoc()) {
	?>
	<tr><form method="POST" id="Settings" action="items.php"?>
	<td><input type="number" name="ID" readonly value=<?php echo "\"".$row["ID"]."\""; ?>></td><td><?php echo $row["Name"]; ?></td><td><input type="number" name="number" value=<?php echo "\"".$row["Number"]."\""; ?>><input type="submit" value="update"></td><td><?php echo $row["Type"]; ?></td><td><?php echo $row["Family"]; ?></td><td><?php echo $row["Credits"]; ?></td><td><?php echo $row["Ducats"]; ?></td><td><input type="number" name="Plat" value=<?php echo "\"".$row["Plat"]."\""; ?>><input type="submit" value="update"></td></form>
	</tr>
	<?php 
		}
		?>
		</table>
		<?php
	} ?>

<?php include "/Library/WebServer/includes/footer.php.en";
?>
</body></html>
