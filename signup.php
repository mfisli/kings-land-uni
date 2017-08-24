	<?php
	include 'header.php';

	/*
	Case sensitive
	Data types:
	integer, float, string, boolean, array, object 
	If nothing assigned at decaration then null
	Constants: define(MY_CONST,"hello i am a const");
	Cast: (integer) (5 / 2)
	Reference: $num = 1; $refNum = &num; $refNum++ // 2


		date_default_timezone_set('America/Los_Angeles');
		$conn = mysqli_connect("localhost", "maks", "123123", "bcit") or die(mysqli_connect_error());

		$q = "SELECT * FROM users";

		$result = mysqli_query($conn, $q) or die(mysqli_error($conn)); // 2d array

		while($row  = mysqli_fetch_assoc($result)){
			foreach($row as $key =>$value) {
				//echo "$key : $value<br>";
			}
			//echo '<br/>';
		}

		$_userName = $_POST['name'];
		$_userAddress = $_POST['address'];
		$_userCity = $_POST['city'];
		$data = array(
			'Name' => $_userName,
			'Address' => $_userAddress,
			'City' => $_userCity
			);
		foreach($data as $key => $value){
			echo "<p> <b>" . $key . ": </b> " . $value . "</p>";
		} 
			*/
	?>
	<div class='container'>
	<form action="">
		<div class="form-group panel panel-default">
			<div class="panel-heading"> Sign Up </div>
			<div class="panel-body">
				<label for=""> User Name</label>
				<input 
				name="username"
				type="text" 
				class="form-control">
				<label for=""> Password</label>
				<input 
				name="password"
				type="password" 
				class="form-control">
				<label for=""> Confirm Password</label>
				<input 
				name="confirmPassword"
				type="password" 
				class="form-control"><br/>
				<button name="submit" type="submit" class="btn btn-primary"> Sign Up </button>
			</div>
		</div>
	</form>
		
	</body>
</html>








