<?php 
ob_start();
require_once  'header.php'; 
require_once  'dbfunctions.php';
require_once  'debugtools.php'; 
function checkPassword(){
	debug_to_console("checking pword.");
	// bad to have connect string in the open
	$conn = mysqli_connect("localhost", "maks", "123123", "kingslanduniversity") or die(mysqli_connect_error());

	$id = $_POST['studentid'];
	$pass = $_POST['password'];
	return dbCheck($conn, $id, $pass);
}

function createSession() {
    // session_start();
    // $_SESSION['authenticated'] = 1;
    // $_SESSION['studentID'] = $_POST['studentid'];
    // $_SESSION['timestamp'] = time();
    debug_to_console("Session Created");
}

if(isset($_POST['submit'])) {
	if (isset($_POST['studentid']) && 
		isset($_POST['password']) && 
		!empty($_POST['studentid']) && 
		!empty($_POST['password'])) {
			if( checkPassword() ){
				createSession();
				debug_to_console("ok - signed in! ");
			} else {
				debug_to_console('incorrect password or id');
			}
		} else {
			debug_to_console('error');
		}
}
ob_end_flush();
?>
<div class="container">
	<form action="login.php" method="POST">
		<div class="form-group panel panel-default">
			<div class="panel-heading"> Login </div>
			<div class="panel-body">
				<label for=""> Student ID </label>
				<input 
				name="studentid"
				type="text" 
				class="form-control">
				<label for=""> Password</label>
				<input 
				name="password"
				type="password" 
				class="form-control"><br/>
				<button name="submit" type="submit" class="btn btn-primary"> Login </button>
			</div>
		</div>
	</form>
</div>