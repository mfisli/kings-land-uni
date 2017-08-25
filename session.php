<?php
function createSession() {
    session_start();
    $_SESSION['authenticated'] = 1;
    $_SESSION['studentID'] = $_POST['studentid'];
    $_SESSION['timestamp'] = time();
    debug_to_console("Session Created");
}

function checkInactivity() {
    if(time() - $_SESSION['timestamp'] > 10) {
        autoLogout();
    } else {
        $_SESSION['timestamp'] = time();
    }
}

function autoLogout() {
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    $_SESSION = array();
    session_destroy();
    header("location:login.php");
    die();
}