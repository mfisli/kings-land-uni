<?php 
require_once  'header.php'; 
require_once  'dbfunctions.php';
require_once  'debugtools.php'; 
require_once  'session.php';

function checkPassword(){
	require_once '../../mysql_conn.php';
	debug_to_console("checking pword.");
	$id = $_POST['studentid'];
	$pass = $_POST['password'];
	return dbCheck($conn, $id, $pass);
}

if(isset($_POST['submit'])) {
	if (isset($_POST['studentid']) && 
		isset($_POST['password']) && 
		!empty($_POST['studentid']) && 
		!empty($_POST['password'])) {
			if( checkPassword() ){
				createSession();
				debug_to_console("ok - signed in! ");
				header("location:index.php");
			} else {
				debug_to_console('incorrect password or id');
				echo "<div class='container'><div class='alert alert-danger'> Incorrect ID or password. </div> </div>";
				//header("location:login.php");
			}
		} else {
			debug_to_console('login error');
			echo "<div class='container'><div class='alert alert-danger'> Missing ID or password. </div> </div>";
		}
}
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
<?php include 'footer.php'; ?>