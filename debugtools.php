<?php
function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}
function selectAllLog($conn, $table){
	$q = "SELECT * FROM " . $table;

	$result = mysqli_query($conn, $q) or die(mysqli_error($conn)); // 2d array

	debug_to_console("Table: " . $table);

	while($row  = mysqli_fetch_assoc($result)){
		foreach($row as $key => $value) {
			debug_to_console($key . " : " . $value);
		}
	}
}