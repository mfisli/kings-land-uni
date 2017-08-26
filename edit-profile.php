<?php
include 'header.php';
require_once '../../mysql_conn.php';
require_once 'dbfunctions.php';

if($_SESSION['authenticated'] != 1){
	header("location:login.php");
	die();
}
// echo "<div class='container'><div class='alert alert-danger'> Missing ID or password. </div> </div>";
$student_id = $_SESSION['studentID'];
$target_dir = "image_uploads/";

if(isset($_POST['profileSubmit']) && $_SESSION['authenticated'] == 1) {
	if ( isset($_POST['streetAddress'])  && 
		 isset($_POST['city'])           && 
		 isset($_POST['postalCode'])     && 
		 !empty($_POST['streetAddress']) && 
		 !empty($_POST['city'])          &&
		 !empty($_POST['postalCode']) ) {
		// new data to process
		$street = $_POST['streetAddress'];
		$city = $_POST['city'];
		$postalCode = $_POST['postalCode'];
		if(updateProfile($conn, $student_id, $street, $city, $postalCode)) {
			echo "<div class='container'><div class='alert alert-success'> Update Successful. </div> </div>";
		} else {
			echo "<div class='container'><div class='alert alert-dange'> Cannot update database. </div> </div>";
		}
	} else {
		echo "<div class='container'><div class='alert alert-danger'> Missing address info. </div> </div>";
	}
}
function getThumbnail($file){
    //debug_to_console( "".$file. " ". file_exists($file));
    if( file_exists($file.".jpg") ) {
            return $file;
    }
    return "http://www.freeiconspng.com/uploads/user-icon-png-person-user-profile-icon-20.png";

}
$profileData = getProfileInfo($conn, $student_id);


?>
<div class="container">
    <form action="edit-profile-photo.php" method="POST" enctype="multipart/form-data">
        <div class="form-group panel panel-default">
            <div class="panel-heading"> Profile Photo </div>
            <div class="panel-body">
                <img
                    class="img-thumbnail"
                    alt="Profile Photo"
                    width="150"
                    src="<?php echo getThumbnail($target_dir.$student_id)?>"><br/>

                <label for="imageFile"> Upload New Image </label>
                <input name="imageFile" type="file" required><br/>
                <button name="imageSubmit" type="submit" class="btn btn-primary"> Update Photo </button>
<!--                <button name="photoDeleteSubmit" type="submit" class="btn btn-danger"> Delete Photo </button>-->
            </div>
        </div>
    </form>
</div>
<div class='container'>
	<form action="edit-profile" method="POST">
		<div class="form-group panel panel-default">
			<div class="panel-heading"> Profile Info </div>
			<div class="panel-body">
				<label for="streetAddress"> Street Address </label>
				<input 
				name="streetAddress"
				type="text" 
				class="form-control"
				value= <?php echo $profileData['street_address'] ?> >
				<label for="city"> City </label>
				<input 
				name="city"
				type="text" 
				class="form-control"
				value= <?php echo $profileData['city'] ?> >
				<label for="postalCode"> Postal Code </label>
				<input 
				name="postalCode"
				type="text" 
				class="form-control"
				value= <?php echo $profileData['postal_code']  ?> ><br/>
				<button name="profileSubmit" type="submit" class="btn btn-primary"> Update Profile </button>
			</div>
		</div>
	</form>
</div>
<div class='container'>
	<form action="">
		<div class="form-group panel panel-default">
			<div class="panel-heading"> Change Password </div>
			<div class="panel-body">
				<label for="currentPassword"> Current Password</label>
				<input 
				name="currentPassword"
				type="password" 
				class="form-control">
				<label for="newPassword"> New Password</label>
				<input 
				name="newPassword"
				type="password" 
				class="form-control">
				<label for="confirmPassword"> Confirm Password</label>
				<input 
				name="confirmPassword"
				type="password" 
				class="form-control"><br/>
				<button name="submit" type="submit" class="btn btn-primary"> Update Password </button>
			</div>
		</div>
	</form>
</div>
<?php include 'footer.php'; ?>









