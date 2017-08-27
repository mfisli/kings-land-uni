<?php
include 'header.php';
require_once '../../mysql_conn.php';
require_once 'dbfunctions.php';
require_once 'messageUiBuilder.php';

if($_SESSION['authenticated'] != 1){
	header("location:login.php");
	die();
}
$student_id = $_SESSION['studentID'];
$target_dir = "image_uploads/";
define("IMAGES_DIR", "image_uploads".DIRECTORY_SEPARATOR);
define("IMAGE_WIDTH", 150);
define("IMAGE_TYPE",".jpg");
//.............................................................................
// Profile Address
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
            setUserMessage("Update Successful.","success");
		} else {
            setUserMessage("Cannot update database.", "danger");
			//echo "<div class='container'><div class='alert alert-dange'> Cannot update database. </div> </div>";
		}
	} else {
        setUserMessage("Missing address info.", "danger");
		//echo "<div class='container'><div class='alert alert-danger'> Missing address info. </div> </div>";
	}
}
function getThumbnail($file){
    //debug_to_console( "".$file. " ". file_exists($file));
    if( file_exists($file.".jpg") ) {
            return $file;
    }
    return IMAGES_DIR."noProfilePhoto.png";

}
//.............................................................................
// Profile Image
// Modified from: https://davidwalsh.name/create-image-thumbnail-php
function makeThumb($src, $dest, $desiredWidth) {
    /* read the source image */
    debug_to_console("src: ". " dest:" . $dest . " width: $desiredWidth");
    $sourceImage = imagecreatefromjpeg($src);
    $width = imagesx($sourceImage);
    $height = imagesy($sourceImage);

    /* find the "desired height" of this thumbnail, relative to the desired width  */
    $desiredHeight = floor($height * ($desiredWidth / $width));

    /* create a new, "virtual" image */
    $virtualImage = imagecreatetruecolor($desiredWidth, $desiredHeight);

    /* copy source image at a resized size */
    if(imagecopyresampled($virtualImage, $sourceImage, 0, 0, 0, 0, $desiredWidth, $desiredHeight, $width, $height)){
        /* create the physical thumbnail image to its destination */
        imagejpeg($virtualImage, $dest);
        return true;
    }
    return false;

}

function setFileName($student_id){
    debug_to_console("Setting file name with id: " . $student_id);
    $newFileName = IMAGES_DIR.$student_id.IMAGE_TYPE;
    return $newFileName;
}

$uploadOk = false;
if(isset($_POST['imageSubmit'])){
    debug_to_console("I got a file");
    $target_dir = "image_uploads/";
    $target_file = $target_dir . basename($_FILES["imageFile"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    @$check = getimagesize($_FILES["imageFile"]["tmp_name"]);
    if($check !== false) {
        debug_to_console("Upload file is an image");
        if(makeThumb($_FILES["imageFile"]["tmp_name"], setFileName($student_id), IMAGE_WIDTH)){
            $uploadOk = true;
        }
    } else {
        setUserMessage("Uploaded file is not an image or is too large.", "danger");
        //echo buildMsg("Upload is not an image", "danger");
        $uploadOk = false;
    }
}
//
//if ($uploadOk !== false) {
//    $newFileName = renameFile($student_id);
//    debug_to_console("New File Name: " . $target_dir.$newFileName);
//    if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_dir.$newFileName)) {
//        setUserMessage("The file ". basename( $_FILES["imageFile"]["name"]) . " has been uploaded.", "success");
//        //echo buildMsg("The file ". basename( $_FILES["imageFile"]["name"]) . " has been uploaded.", "success");
//    } else {
//        setUserMessage("Server error saving image", "danger");
//        //echo buildMsg("Error saving image", "danger");
//    }
//}
debug_to_console("end edit photo");
$profileData = getProfileInfo($conn, $student_id);


?>
<?php echo getUserMessage(); ?>
<div class="container">
    <form action="edit-profile.php" method="POST" enctype="multipart/form-data">
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









