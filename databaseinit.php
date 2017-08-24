<?php
include 'debugtools.php'; 
date_default_timezone_set('America/Los_Angeles');
$conn = mysqli_connect("localhost", "maks", "123123", "kingslanduniversity") or die(mysqli_connect_error());
//functions 
function execQuery($conn, $statement){
	mysqli_query($conn, $statement) or die(mysqli_error($conn));
}

function initTableMajor($conn){
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

	selectAllLog($conn, "major");
}
function initTableStudent($conn){
	$q = "CREATE TABLE IF NOT EXISTS student (
		studentid VARCHAR(45) PRIMARY KEY NOT NULL,
		firstname VARCHAR(45) NOT NULL,
		lastname  VARCHAR(45) NOT NULL,
		birthday  DATE 		  NOT NULL,
		majorid   VARCHAR(45) NOT NULL,
		FOREIGN KEY(majorid)  REFERENCES major(majorid)
	)";
	execQuery($conn, $q);
	// sql accepts YYYY-MM-DD format
	$q = "INSERT IGNORE INTO student (studentid, firstname, lastname, birthday,  majorid) VALUES (
		'A12345678', 'John', 'Doe', '2000-01-01', 'english literature' 
	)";
	execQuery($conn, $q);

	$q = "INSERT IGNORE INTO student (studentid, firstname, lastname, birthday,  majorid) VALUES (
		'A87654321', 'Sally', 'Smith', '1998-02-03', 'computer science' 
	)";
	execQuery($conn, $q);

	selectAllLog($conn, "student");
}
// Main 
initTableMajor($conn);
initTableStudent($conn);



