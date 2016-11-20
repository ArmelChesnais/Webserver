<?php include "/Library/WebServer/Documents/includes/preload.php";
    include "/Library/WebServer/Documents/includes/head.php";
    
    
    /*$loggedUser = "None";
    $err_msg = "";
    $servername = HOST;
    $username = USER;
    $password = PASSWORD;
    $dbname = DATABASE;
    
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        echo "connection error<br>";
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ( isset($_POST["new_account"]) ) {
        // echo isset($_POST["username"]) . " + " . $_POST["username"];
        //foreach (array_keys($_POST) as $i) echo "$i => $_POST[$i]<br>";
        //echo "<br>";
        $passhash = password_hash( $_POST["password"], PASSWORD_DEFAULT);
        
        if ( $_POST["password"] <> $_POST["passconf"] ) { $err_msg .= "Passwords do not match!<br>";}
        
        $stmt = $conn->prepare("SELECT id FROM members WHERE username=? LIMIT 1");
        $stmt->bind_param('s', $_POST["username"]);
        $stmt->execute();
        $stmt->store_result();
        if ( $stmt->num_rows <> 0) {
        //if ($conn->query("SELECT id FROM members WHERE username='" .$_POST["username"] ."' LIMIT 1")->num_rows <> 0){
            $err_msg .= "User name '" . $_POST["username"] . "' already exists.<br>";
        }
        $stmt->close();
        $stmt = $conn->prepare("SELECT id FROM members WHERE email=? LIMIT 1");
        $stmt->bind_param('s', $_POST["email"]);
        $stmt->execute();
        $stmt->store_result();
        if ( $stmt->num_rows <> 0) {
        //if ($conn->query("SELECT id FROM members WHERE  email='" . $_POST["email"] . "' LIMIT 1")->num_rows <> 0){
            $err_msg .= "Email '" . $_POST["email"] . "' already exists.<br>";
        }
        $stmt->close();
        if ( $err_msg == "") {
            // $sql = "INSERT INTO members (username, email, password) VALUES ('". $_POST["username"] ."', '" . $_POST["email"] ."', '". $passhash ."')";
            $stmt = $conn->prepare("INSERT INTO members (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $_POST["username"], $_POST["email"], $passhash);
            if ($stmt->execute()) {
                $_SESSION["username"] = $_POST["username"];
                $loggedUser = $_POST["username"];
            //if ($conn->query($sql) === TRUE) {
                //$last_id = $conn->insert_id;
                 //echo "<meta http-equiv=\"REFRESH\" content=\"0; url=card.php?ID=" . $last_id . "\">";
                 //echo "name was" . $_POST["username"] . "<br>";
                 //echo "password was" . $_POST["password"] . "<br>";
                 //echo "hashed password is" . $passhash . "<br>";
                 //echo "confirm matches:" . password_verify( $_POST["password"], $passhash) . "<br>";
                 //echo "compare hashes:" . password_verify( $_POST["passconf"], $passhash) . "<br><br>";
            }
            $stmt->close();
        }
    } elseif (isset($_POST["login_account"])) {
        
        $stmt = $conn->prepare("SELECT id, password FROM members WHERE username = ? LIMIT 1");
        $stmt->bind_param('s', $_POST["username"]);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $dbpassword);
        $stmt->fetch();
        $stmt->num_rows;
        if (isset($id)) {
            if ( password_verify($_POST["password"],$dbpassword)) {
                $_SESSION["username"] = $_POST["username"];
                $loggedUser = $_POST["username"];
            } else {
                $err_msg .= "Password is incorrect!<br>";
                
                // $err_msg .= $id . " + " . $dbpassword . "<br>";
            }
        } else {
            $err_msg .= "No such user exists.<br>";
        }
        $stmt->close();
    } elseif (isset($_SESSION["username"])){
        $stmt = $conn->prepare("SELECT id FROM members WHERE username = ? LIMIT 1");
        $stmt->bind_param('s', $_SESSION["username"]);
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();
        if ( count($id) != 0 ) {
            $loggedUser = $_SESSION["username"];
        } else {
            session_unset();
            session_destroy();
        }
        $stmt->close();
    }*/
?>
<title>FireryRage</title>
</head>
<body role="document">
<?php
include "/Library/WebServer/Documents/includes/navbar.php";

    if ($err_msg <> "") echo $err_msg;
?><br>
current login:
<?php
    
    echo $loggedUser;
?>
<br><br>
<table>
<tr><td>
<form method="POST" id="new_account" action="index.php">
Create account:<br>
username: <input type="text" name="username" value="<?php echo $_POST["username"] ?>" ><br>
e-mail: <input type="text" name="email" value="<?php echo $_POST["email"] ?>" ><br>
Password: <input type="password" name="password"><br>
Confirm Password: <input type="password" name="passconf"><br>
<input id="new_account" name="new_account" type="submit" value="create account">
</form></td>

<td>

<form method="POST" id="login_account" action="index.php">
Login to account:<br>
username: <input type="text" name="username" value="<?php echo $_POST["username"] ?>" ><br>
Password: <input type="password" name="password"><br>
<input id="login_account" name="login_account" type="submit" value="login">
</form></td>
<br><br>
<?php
    $conn->close();
/*$_SESSION['test'] = 42;
$test = 43;
echo $_SESSION['test'];*/
include "/Library/WebServer/Documents/includes/footer.php";
?>
</body></html>
