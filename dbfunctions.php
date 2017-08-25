<?php
require_once 'debugtools.php'; 

function execQuery($conn, $statement){
//	echo "execQuery: " . $statement . "<br/>";
	return mysqli_query($conn, $statement) or die(mysqli_error($conn));
}
//'".$loggin_user."' 
function dbCheck($conn, $student_id, $password){
	debug_to_console("processing pw check in db.");
	$q = "SELECT * FROM account
		WHERE student_id='".$student_id."' AND password='".$password ."';";
	if ($result = mysqli_query($conn, $q) or die(mysqli_error($conn))){
		/* determine number of rows result set */
	    $row_cnt = mysqli_num_rows($result);

	    debug_to_console("Pw check rows: " . $row_cnt);

	    /* close result set */
	    mysqli_free_result($result);
		return $row_cnt > 0; 
	} 
	return false; 
}
function updateProfile($conn, $student_id, $street, $city, $postalCode){
	debug_to_console("Updating profile with: " . '$conn' . $student_id . $street . $city . $postalCode);
	$q = "UPDATE student SET street_address='". $street ."', city='". $city . "', postal_code='" . $postalCode . "'WHERE student_id ='". $student_id. "';";
	if ($result = mysqli_query($conn, $q) or die(mysqli_error($conn))){
		return true;
	}
	return false;
}
function getProfileInfo($conn, $student_id){
	debug_to_console("Getting profile info");
	$q = "SELECT * FROM student WHERE student_id='".$student_id."';";
	if ($result = mysqli_query($conn, $q) or die(mysqli_error($conn))){
		$data = array();
		while($row  = mysqli_fetch_assoc($result)){
			foreach($row as $key => $value) {
				$data += array($key => $value);
			}
		}
	}
	return $data; 
}












