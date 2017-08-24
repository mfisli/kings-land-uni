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
	major_id     VARCHAR(45) PRIMARY KEY NOT NULL
	)";
	execQuery($conn, $q);

	$q = "INSERT IGNORE INTO major (major_id) VALUES (
		'english literature'
	)";
	execQuery($conn, $q);

	$q = "INSERT IGNORE INTO major (major_id) VALUES (
		'computer science'
	)";
	execQuery($conn, $q);

	selectAllLog($conn, "major");
}
function initTableStudent($conn){
	$q = "CREATE TABLE IF NOT EXISTS student (
		student_id VARCHAR(45) PRIMARY KEY NOT NULL,
		first_name VARCHAR(45) NOT NULL,
		last_name  VARCHAR(45) NOT NULL,
		birthday  DATE 		  NOT NULL,
		major_id   VARCHAR(45) NOT NULL,
		FOREIGN KEY(major_id)  REFERENCES major(major_id)
	)";
	execQuery($conn, $q);
	// sql accepts YYYY-MM-DD format
	$q = "INSERT IGNORE INTO student (student_id, first_name, last_name, birthday,  major_id) VALUES (
		'A12345678', 'John', 'Doe', '2000-01-01', 'english literature' 
	)";
	execQuery($conn, $q);

	$q = "INSERT IGNORE INTO student (student_id, first_name, last_name, birthday,  major_id) VALUES (
		'A87654321', 'Sally', 'Smith', '1998-02-03', 'computer science' 
	)";
	execQuery($conn, $q);

	selectAllLog($conn, "student");
}
function initAccount($conn){
	$q = "CREATE TABLE IF NOT EXISTS account (
		student_id       VARCHAR(45) PRIMARY KEY NOT NULL,
		password        VARCHAR(45) NOT NULL,
		last_modified   DATETIME    DEFAULT CURRENT_TIMESTAMP,
		update_required BOOL        NOT NULL DEFAULT '1',
		FOREIGN KEY(student_id) REFERENCES student(student_id)
	)";
	execQuery($conn, $q);
	//$bday = 
	$q = "INSERT IGNORE INTO account (student_id, password) VALUES (
		'A12345678', '123123' 
	)";
	execQuery($conn, $q);
	$q = "INSERT IGNORE INTO account (student_id, password) VALUES (
		'A87654321', '321321' 
	)";
	execQuery($conn, $q);
	selectAllLog($conn, "account");

}
// Main 
initTableMajor($conn);
initTableStudent($conn);
initAccount($conn);

















