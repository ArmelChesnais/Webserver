<html>
<head>
<?php include "style.php"; ?>
</head>
<body>

<?php
    include "/Library/WebServer/Documents/includes/preload.php";
    include "/Library/WebServer/Documents/includes/head.php"; ?>
<br><br>

<?php
$servername = "localhost";
$username = "root";
$password = "Pass12word";
$dbname = "MagicCards";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if ( isset($_GET["AddOption"]) && isset($_GET["Category"]) && isset($_GET["Option"]) && ($_GET["Option"] != "default") ) {
	$sql = "SELECT CardOption FROM CardOptions WHERE CardOption='".$_GET["Option"]."'";
	$result = $conn->query($sql);
	if ( $result->num_rows == 0 ) {
		if ( $_GET["Attribute"] != "" ) {
			$sql = "INSERT INTO CardOptions (Category, CardOption, Attribute) VALUES ('".$_GET["Category"]."', '".$_GET["Option"]."', '".$_GET["Attribute"]."')";
		} else {
			$sql = "INSERT INTO CardOptions (Category, CardOption) VALUES ('".$_GET["Category"]."', '".$_GET["Option"]."')";
		}
		$conn->query($sql);
	} else {
		if ( $_GET["Attribute"] != "" ) {
			$sql = "UPDATE CardOptions SET Attribute='".$_GET["Attribute"]."' WHERE Category='".$_GET["Category"]."' AND CardOption='".$_GET["Option"]."'";
		} else {
			$sql = "UPDATE CardOptions SET Attribute=NULL WHERE Category='".$_GET["Category"]."' AND CardOption='".$_GET["Option"]."'";
		}
		$conn->query($sql);

	}
}

$sql = "SELECT DISTINCT Category FROM CardOptions";
$result = $conn->query($sql);
?>
<br>
<table>
<tr><td><form method="GET" id="TypeSelect" action="options.php">
Category: <select name="Category">
	
<?php
$exists = FALSE;
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo "<option value=\"".$row["Category"]."\"";
    	if ($_GET["Category"] == $row["Category"]) { echo " selected"; $exists = TRUE; }
   		echo ">".$row["Category"]."</option>\n";
	}
} else {
	?> <option></option> <?php;
} 
?>	
</select> <input id="SelectCategory" type="submit" value="Select Category">
</form></td></tr>
<tr><td>
<?php
if ( isset($_GET["Category"]) && $exists){
	$sql = "SELECT CardOption, Attribute FROM CardOptions WHERE Category='".$_GET["Category"]."'";
	
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo $row["CardOption"];
			if ( $row["Attribute"] != NULL ) {
				echo " (".$row["Attribute"].")";
			}
			echo "<br>";
		}
	} else {
		?> Nothing here <?php;
	} 
	?>
	
	<?php
}
?>
</td>
<?php
if ($exists) {
	?>
<td>
<form method="GET" id="AddOption" action="options.php">New Option:<br>
Category: <input type="text" name="Category" value=<?php echo "\"".$_GET["Category"]."\""; ?> ><br> 
Option Name: <input type="text" name="Option" value="default"><br>
Attribute (optional): <input type="text" name="Attribute"><br>
<input name="AddOption" id="AddOption" type="submit" value="Add Option">
</form>
</td>
<?php
}
?>
</table>
<?php
	if ($result->num_rows > 0) {
	} else {
    	#echo "0 results";
	}
$conn->close();

    include "/Library/WebServer/Documents/includes/footer.php";
?>
</body></html>

