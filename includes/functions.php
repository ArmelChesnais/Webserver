<?php
include_once '/Library/WebServer/includes/psl-config.php';
include_once '/Library/WebServer/includes/constants.php';
 
function sec_session_start() {
    $session_name = 'sec_session_id';   // Set a custom session name
    $secure = SECURE;
    // This stops JavaScript being able to access the session id.
    $httponly = true;
    // Forces sessions to only use cookies.
    if (ini_set('session.use_only_cookies', 1) === FALSE) {
        header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
        exit();
    }
    // Gets current cookies params.
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params($cookieParams["lifetime"],
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure,
        $httponly);
    // Sets the session name to the one set above.
    session_name($session_name);
    session_start();            // Start the PHP session 
    session_regenerate_id(true);    // regenerated the session, delete the old one. 
}

function addSQLOption($sqlString, $newOption, $operator = ",") {
    if ( $sqlString == "") {
    	$sqlString = $newOption;
    } else {
    	$sqlString .= $operator . " " . $newOption;
    }
    return $sqlString;
}
    
    function openSQLConnection ($db) {
        $servername = HOST;
        $username = USER;
        $password = PASSWORD;
        
        return new mysqli($servername, $username, $password, $db);
    }
    
    function getUserAuthority ($username) {
        $conn = openSQLConnection(USERDATABASE);
        $stmt = $conn->prepare("SELECT authority FROM members WHERE username = ? LIMIT 1");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($authority);
        $stmt->fetch();
        $stmt->close;
        $conn->close;
        if (isset($authority)) {
            return $authority;
        } else {
            return 0;
        }
    }
?>
