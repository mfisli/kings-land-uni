<?php
require_once 'debugtools.php'; 
$conn = mysqli_connect("localhost", "maks", "123123", "kingslanduniversity") or die(mysqli_connect_error());

function execQuery($conn, $statement){
	echo "execQuery: " . $statement . "<br/>";
	return mysqli_query($conn, $statement) or die(mysqli_error($conn));
}
//'".$loggin_user."' 
function dbCheck($conn, $student_id, $password){
	debug_to_console("processing pw check in db.");
	$q = "SELECT * FROM account
		WHERE student_id='".$student_id."' AND password='".$password ."';
	";
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