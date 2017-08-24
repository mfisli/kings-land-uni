<?php
include 'debugtools.php'; 
date_default_timezone_set('America/Los_Angeles');
$conn = mysqli_connect("localhost", "maks", "123123", "kingslanduniversity") or die(mysqli_connect_error());
//functions 
function execQuery($conn, $statement){
	mysqli_query($conn, $statement) or die(mysqli_error($conn));
}

function selectAll($conn, $table){
	$q = "SELECT * FROM " . $table;

	$result = mysqli_query($conn, $q) or die(mysqli_error($conn)); // 2d array

	while($row  = mysqli_fetch_assoc($result)){
		foreach($row as $key => $value) {
			debug_to_console($key . " : " . $value);
		}
		echo '<br/>';
	}
}
// Main 
$q = "CREATE TABLE IF NOT EXISTS major (
	majorid     VARCHAR(45) PRIMARY KEY NOT NULL
)";
execQuery($conn, $q);

$q = "INSERT IGNORE INTO major (majorid) VALUES (
	'english literature'
)";
execQuery($conn, $q);

$q = "INSERT IGNORE INTO major (majorid) VALUES (
	'computer science'
)";
execQuery($conn, $q);

selectAll($conn, "major");

