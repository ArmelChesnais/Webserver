<?php include "/Library/WebServer/Documents/includes/preload.php";
    include "/Library/WebServer/Documents/includes/head.php";?>
<title>Magic Card Dev Database</title>
</head>

<body>
<?php include "/Library/WebServer/Documents/includes/navbar.php"; ?>

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

$sql = "SELECT * FROM Cards WHERE DevStage <> 'Deprecated' ORDER BY Name";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $myfile = fopen("cards.xml", "w") or die("Unable to open file");
    fwrite($myfile, "<?xml version=\"1.0\" encoding=\"UTF-8\"?> \n<cockatrice_carddatabase version=\"3\"> \n<sets> \n<set> \n<name>SIC</name> \n<longname></longname> \n</set> \n</sets> \n<cards>\n\n");
    while($row = $result->fetch_assoc()) {
        fwrite($myfile, "<card> \n <name>" . $row["Name"]. "<name></name>\n <set picURL=\"/". $row["Name"]. ".full.jpg\" picURLHq=\"\" picURLSt=\"\">SIC</set>\n <color>" . $row["Color"]. "</color>\n <manacost>" . $row["Cost"]. "</manacost>\n <type>" . $row["Type"]);
        fwrite($myfile, " - ". $row["Subtype"]);
        fwrite($myfile, " </type>\n ");
        fwrite($myfile, "<pt>". $row["Power"]."/". $row["Toughness"]. "</pt>");
        fwrite($myfile, "\n <tablerow>2</tablerow>\n <text>". str_replace("~", $row["Name"], $row["Text"])."</text>\n</card>\n");
    }
    fwrite($myfile, "</cards>\n</cockatrice_carddatabase>");
    fclose($myfile);
} else {
    echo "0 results";
}
$conn->close();
?>
<br><br>
Card file generated:<br>
<a href="cards.xml" download>Click here to download</a><br><br>

<?php include "/Library/WebServer/Documents/includes/footer.php"; ?>

</body></html>
