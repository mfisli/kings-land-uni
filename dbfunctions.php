<?php
require_once 'debugtools.php'; 

function sanitize($dirty){
    $clean = filter_var($dirty, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    return $clean;
}

function execQuery($conn, $statement){
//	echo "execQuery: " . $statement . "<br/>";
    return mysqli_query($conn, $statement) or die(mysqli_error($conn));
}

function getResults($queryResult, $output){
    while ($row = mysqli_fetch_assoc($queryResult)) {
        foreach ($row as $key => $value) {
            //debug_to_console("Key : " . $key . " | Value: " . $value);
            $output += array($key => $value);
        }
    }
    return $output;
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
    $data = array();
    if ($stmt = mysqli_prepare($conn, "SELECT * FROM student WHERE student_id=?")
        or die(mysqli_error($conn))) {
        mysqli_stmt_bind_param($stmt, "s", $student_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $data = getResults($result, $data);
    }
    return $data;
}
function getScheduleInfo($conn, $student_id){
    debug_to_console("Getting Schedule info");
    $data = array();
    if($stmt = mysqli_prepare($conn, "SELECT * FROM lecture WHERE major_id =(SELECT major_id FROM student WHERE student_id=?)")
    or die(mysqli_error($conn))) {
        mysqli_stmt_bind_param($stmt, "s", $student_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        //var_dump($result);
        $data = $result->fetch_all(MYSQLI_ASSOC);
    }
    return $data;
}














