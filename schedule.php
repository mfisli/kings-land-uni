<?php
include 'header.php';
require_once '../../mysql_conn.php';
require_once 'dbfunctions.php';
if($_SESSION['authenticated'] != 1){
    header("location:login.php");
    die();
}
$student_id = $_SESSION['studentID'];
$data =  getScheduleInfo($conn, $student_id);
?>
<div class="container">
    <div class="panel panel-default">
    <div class="panel-heading"> Lectures this week </div>
        <div class="panel-body">

        <?php
        foreach($data as $lectures){
            foreach($lectures as $key=>$value){
                echo "<p>" . $key . " : " . $value . "</p>";
            }
            echo "<hr />";
        }
        ?>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>

