<?php
require_once 'debugtools.php'; 

function sanitize($dirty){
    $clean = filter_var($dirty, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    return $clean;
}

function dbCheck($conn, $student_id, $password){
	debug_to_console("processing pw check in db.");
    if ($stmt = mysqli_prepare($conn, "SELECT * FROM account WHERE student_id=? AND password=?")
        or die(mysqli_error($conn))) {
        mysqli_stmt_bind_param($stmt, "ss", $student_id, $password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $rows = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $rows > 0;
    }
    debug_to_console("false");
    return false;
}

function updateProfile($conn, $student_id, $street, $city, $postalCode){
    $street = sanitize($street);
    $city = sanitize($city);
    $postalCode = sanitize($postalCode);

    if ($stmt = mysqli_prepare($conn, "UPDATE student SET street_address=?, city=?, postal_code=? WHERE student_id=?")
        or die(mysqli_error($conn))) {
        mysqli_stmt_bind_param($stmt, "ssss", $street, $city, $postalCode, $student_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    }
    debug_to_console("updateProfile error");

    return false;
}
function getProfileInfo($conn, $student_id){
	debug_to_console("Getting profile info");
	$q = "SELECT * FROM student WHERE student_id='".$student_id."';";
	if ($result = mysqli_query($conn, $q) or die(mysqli_error($conn))){
		$data = array();
		while($row  = mysqli_fetch_assoc($result)){
			foreach($row as $key => $value) {
//                debug_to_console("Key : " . $key . " | Value: " . $value);
				$data += array($key => $value);
			}
		}
	}
	return $data; 
}
function getScheduleInfo($conn, $student_id){
    debug_to_console("Getting Schedule info");
    $q = "SELECT * FROM lecture WHERE major_id =(SELECT major_id FROM student WHERE student_id=\"$student_id\")";
    if ($result = mysqli_query($conn, $q) or die(mysqli_error($conn))){
        $data = $result->fetch_all(MYSQLI_ASSOC);

    }
    return $data;
}












