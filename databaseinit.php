<?php
require_once  'debugtools.php'; 
require_once  'dbfunctions.php';
date_default_timezone_set('America/Los_Angeles');

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

	//selectAllLog($conn, "major");
}
function initTableLecture($conn){
    $q = "CREATE TABLE IF NOT EXISTS lecture (
		lecture_id     VARCHAR(45) PRIMARY KEY NOT NULL,
		lecture_title  VARCHAR(45) NOT NULL,
		building       VARCHAR(45) NOT NULL,
		room           VARCHAR(45) NOT NULL,
		start_time     TIME        NOT NULL,
		end_time 	   TIME        NOT NULL,
		frequency_code VARCHAR(45) NOT NULL,
		major_id       VARCHAR(45) NOT NULL,
		teacher_id     VARCHAR(45) NOT NULL,
		FOREIGN KEY(major_id)  REFERENCES major(major_id)
	)";
    execQuery($conn, $q);
    $q = "INSERT IGNORE INTO lecture (lecture_id, lecture_title, building, room,  start_time, end_time,frequency_code, major_id, teacher_id) VALUES (
		'COMP101', 'Intro to Java', 'Cedar', '204', '10:00:00', '10:50:00', 'mwf', 'computer science', 'E11223344'
	)";
    execQuery($conn, $q);
    $q = "INSERT IGNORE INTO lecture (lecture_id, lecture_title, building, room,  start_time, end_time,frequency_code, major_id, teacher_id) VALUES (
		'COMP110', 'Database I', 'Redwood', '102', '9:00:00', '10:50:00', 'th', 'computer science', 'E37481954'
	)";
    execQuery($conn, $q);
    $q = "INSERT IGNORE INTO lecture (lecture_id, lecture_title, building, room,  start_time, end_time,frequency_code, major_id, teacher_id) VALUES (
		'COMP155', 'Linear Algebra', 'Oak', '310', '13:00:00', '13:50:00', 'mwf', 'computer science', 'E19283745'
	)";
    execQuery($conn, $q);
    $q = "INSERT IGNORE INTO lecture (lecture_id, lecture_title, building, room,  start_time, end_time,frequency_code, major_id, teacher_id) VALUES (
		'COMP195', 'Web Development I', 'Cedar', '204', '14:00:00', '14:50:00', 'mwf', 'computer science', 'E11342236'
	)";
    execQuery($conn, $q);
    $q = "INSERT IGNORE INTO lecture (lecture_id, lecture_title, building, room,  start_time, end_time,frequency_code, major_id, teacher_id) VALUES (
		'ENGL101', 'History of English', 'Oak', '104', '14:00:00', '14:50:00', 'mwf', 'english literature', 'E12345432'
	)";
    execQuery($conn, $q);
    $q = "INSERT IGNORE INTO lecture (lecture_id, lecture_title, building, room,  start_time, end_time,frequency_code, major_id, teacher_id) VALUES (
		'ENGL104', '16th Century', 'Cedar', '334', '9:00:00', '9:50:00', 'th', 'english literature', 'E11957365'
	)";
    execQuery($conn, $q);
    $q = "INSERT IGNORE INTO lecture (lecture_id, lecture_title, building, room,  start_time, end_time,frequency_code, major_id, teacher_id) VALUES (
		'ENGL153', 'Rhetoric', 'Redwood', '102', '10:00:00', '11:50:00', 'th', 'english literature', 'E12345432'
	)";
    execQuery($conn, $q);
    $q = "INSERT IGNORE INTO lecture (lecture_id, lecture_title, building, room,  start_time, end_time,frequency_code, major_id, teacher_id) VALUES (
		'ENGL130', 'Modern American', 'Oak', '106', '13:00:00', '13:50:00', 'mwf', 'english literature', 'E99275439'
	)";
    execQuery($conn, $q);
}
function initTableStudent($conn){
	$q = "CREATE TABLE IF NOT EXISTS student (
		student_id     VARCHAR(45) PRIMARY KEY NOT NULL,
		first_name     VARCHAR(45) NOT NULL,
		last_name      VARCHAR(45) NOT NULL,
		birthday       DATE        NOT NULL,
		major_id       VARCHAR(45) NOT NULL,
		street_address VARCHAR(45) NULL,
		city 		   VARCHAR(45) NULL,
		postal_code    VARCHAR(45) NULL,
		FOREIGN KEY(major_id)  REFERENCES major(major_id)
	)";
	execQuery($conn, $q);
	// sql accepts YYYY-MM-DD format
	$q = "INSERT IGNORE INTO student (student_id, first_name, last_name, birthday,  major_id, street_address, city, postal_code) VALUES (
		'A12345678', 'John', 'Doe', '2000-01-01', 'english literature', '1478 Walnut Road', 'Anyville', '1i2k5c'
	)";
	execQuery($conn, $q);

	$q = "INSERT IGNORE INTO student (student_id, first_name, last_name, birthday,  major_id) VALUES (
		'A87654321', 'Sally', 'Smith', '1998-02-03', 'computer science' 
	)";
	execQuery($conn, $q);

	//selectAllLog($conn, "student");
}
function initAccount($conn){
	$q = "CREATE TABLE IF NOT EXISTS account (
		student_id      VARCHAR(45) PRIMARY KEY NOT NULL,
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
	//selectAllLog($conn, "account");
}
// Main 
require_once '../../mysql_conn.php';
initTableMajor($conn);
initTableStudent($conn);
initAccount($conn);
initTableLecture($conn);


/*object(mysqli_result)#3 (5) { 
["current_field"]=> int(0) 
["field_count"]=> int(4) 
["lengths"]=> NULL 
["num_rows"]=> int(1) 
["type"]=> int(0) } 
*/
















