	<?php
	include 'header.php';

		/*
		$q = "CREATE TABLE IF NOT EXISTS student (
			studentid  INT         PRIMARY KEY NOT NULL
			firstname  VARCHAR(45) NOT NULL,
			lastname   VARCHAR(45) NOT NULL,
			birthdate  DATE        NOT NULL,
			major      VARCHAR(45) FOREIGN KEY NOT NULL,
		)";
		$result = mysqli_query($conn, $q) or die(mysqli_error($conn)); // 2d array

		$q = "SELECT * FROM student";

		$result = mysqli_query($conn, $q) or die(mysqli_error($conn)); // 2d array

		while($row  = mysqli_fetch_assoc($result)){
			foreach($row as $key => $value) {
				echo "$key : $value<br>";
			}
			echo '<br/>';
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








