<?php include "/Library/WebServer/Documents/includes/preload.php";
    include "/Library/WebServer/Documents/includes/head.php";?>
<title>Magic Card Dev Database</title>
</head>
<body>
<?php include "/Library/WebServer/Documents/includes/navbar.php"; ?>
<div>
	<form method="GET" id="Display update" action="index.php">
	Show deprecated <input type="checkbox" name="dp" action="index.php" <?php if ($_GET["dp"] == "on") { echo "checked"; } ?> >
	Order by: <select name="Order">
		<option value="ID">ID</option>
		<option value="Color" <?php if ($_GET["Order"] == "Color") { echo " selected"; } ?> >Color & Name</option>
		<option value="Name" <?php if ($_GET["Order"] == "Name") { echo " selected"; } ?> >Name</option>
	</select>
	<input type="submit" value="Update">
	<input type="text" name="Srch" value=<?php if ( isset($_GET["Srch"]) ) { echo "\"".$_GET["Srch"]."\"";} ?> >
	<input type="submit" value="Search">
	</form>
</div>
<div class="page-header col-md-10">
	Card list:<br>
	<?php

		// Create connection
        $conn = openSQLConnection(CARDDATABASE);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT Cards.Card_ID, Cards.Name, Cards.Cost, Cards.Type, Cards.Subtype, Cards.Power, Cards.Toughness, DevStages.Attribute DevAttribute, Colors.Attribute ColorAttribute, Cards.Color FROM Cards LEFT JOIN CardOptions DevStages ON Cards.DevStage = DevStages.CardOption LEFT JOIN CardOptions Colors ON Cards.Color = Colors.CardOption ";
		$sqlWhere = "";
		if ($_GET["dp"] != "on") { $sqlWhere = addSQLOption($sqlWhere, "Cards.DevStage <> 'Deprecated'", " AND "); }
		if ($_GET["Srch"] != "" && isset($_GET["Srch"]) ) { $sqlWhere = addSQLOption($sqlWhere, "(Cards.Name LIKE '%".$_GET["Srch"]."%' OR Cards.Text LIKE '%".$_GET["Srch"]."%')", " AND "); }
		if ( $sqlWhere != "" ) { $sql = $sql . " WHERE " . $sqlWhere; }
		if ($_GET["Order"] == "Color") {
			$sql = $sql . " ORDER BY ColorAttribute, Cards.Name";
		} elseif ($_GET["Order"] == "Name") {
			$sql = $sql . " ORDER BY Cards.Name";
		} else { 
			$sql = $sql . " ORDER BY Cards.Card_ID";
		}
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
	?>
	<table class="table table-striped">
	<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Color</th>		
    <th>Cost</th>		
    <th>Type</th>			
    <th>P/T</th>
    </tr>
    <?php
    	// output data of each row
    	while($row = $result->fetch_assoc()) {
    		if ( $row["DevAttribute"] != NULL ) {
    			echo "<tr><td bgcolor='".$row["DevAttribute"]."'>";
    		} else {
        		echo "<tr><td>";
    		}
        	echo "<a href=\"card.php?ID=" . $row["Card_ID"]."\">" . $row["Card_ID"]. "</a></td>\n<td><a href=\"card.php?ID=" . $row["Card_ID"]."\">" . $row["Name"]. "</a></td>\n<td>" . $row["Color"]. "</td>\n<td>" . $row["Cost"]. "</td>\n<td>" . $row["Type"];
        	if ( $row["Subtype"] != "" ) {
        		echo " - ".$row["Subtype"];
        	}
        	echo "</td>\n<td>";
        	if ( strpos($row["Type"],"Creature") !== false) {
        		echo $row["Power"]."/". $row["Toughness"];
        	} elseif ( $row["Type"] == "Planeswalker") {
        		echo $row["Toughness"];
        	}
        	echo "</td></tr>\n";
    	}
    	?>
    	</table>
    	<?php
	} else {
 	   	echo "0 results";
	}
	include "/Library/WebServer/Documents/includes/footer.php";
?>
</div>

</body>
</html>
