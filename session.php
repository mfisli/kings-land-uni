<?php
require_once 'debugtools.php';
function createSession() {
	session_start();
    $_SESSION['authenticated'] = 1;
    $_SESSION['studentID'] = $_POST['studentid'];
    $_SESSION['timestamp'] = time();
    setMsg("Logged in as: " . $_SESSION['studentID'], "info");
    debug_to_console("Session Created");
}

function checkInactivity() {
    if(time() - $_SESSION['timestamp'] > 1000) {
        autoLogout();
    } else {
        $_SESSION['timestamp'] = time();
    }
}

function autoLogout() {
	session_start();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    $_SESSION = array();
    $_SESSION['msg'] = "Good bye";
    session_destroy();
    debug_to_console("autoLogout()");
    //die();
}
function getMsg(){
	$result = (string)$_SESSION['msg'];
	//$_SESSION['msg'] = null;
	debug_to_console("Session msg: " . $result);
	return $result; 
}

function setMsg($msg, $color){
	$_SESSION['msg'] =
		'<div class="alert alert-'.$color .'"> '. $msg . '</div>';
}

function printSessionData(){
	debug_to_console("Printing Session Data:");
	foreach ($_SESSION as $name => $value)
	{
	    debug_to_console($name." : ".$value);
	}
}
