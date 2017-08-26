<?php
include 'header.php';
require_once '../../mysql_conn.php';
require_once 'dbfunctions.php';
require_once 'buildMsg.php';

if($_SESSION['authenticated'] != 1){
    header("location:login.php");
    die();
}
$student_id = $_SESSION['studentID'];
debug_to_console("in edit photo");


// Source: http://php.net/manual/en/function.imagecreatefromjpeg.php
function imageCreateFromAny($filePath) {
    $type = exif_imagetype($filePath); // [] if you don't have exif you could use getImageSize()
    $allowedTypes = array(
        1,  // [] gif
        2,  // [] jpg
        3,  // [] png
        6   // [] bmp
    );
    if (!in_array($type, $allowedTypes)) {
        return false;
    }
    switch ($type) {
        case 1 :
            $im = imageCreateFromGif($filePath);
            break;
        case 2 :
            $im = imageCreateFromJpeg($filePath);
            break;
        case 3 :
            $im = imageCreateFromPng($filePath);
            break;
        case 6 :
            $im = imageCreateFromBmp($filePath);
            break;
    }
    return $im;
}
function renameFile($student_id){
    debug_to_console("changing " . $student_id);

    $temp = explode(".", $_FILES["imageFile"]["name"]);
    $newFileName = $student_id . '.' . end($temp);
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
        //echo buildMsg("Upload successful", "success");
        $uploadOk = true;
    } else {
        echo buildMsg("Upload is not an image", "danger");
        $uploadOk = false;
    }
}
if (!$uploadOk) {
    echo buildMsg("Error uploading image", "danger");
// if everything is ok, try to upload file
} else {
    $newFileName = renameFile($student_id);
    debug_to_console("New File Name: " . $target_dir.$newFileName);
    if (move_uploaded_file($_FILES["imageFile"]["tmp_name"], $target_dir.$newFileName)) {
        echo buildMsg("The file ". basename( $_FILES["imageFile"]["name"]) . " has been uploaded.", "success");
    } else {
        echo buildMsg("Error saving image", "danger");
    }
}
debug_to_console("end edit photo");


?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">New Profile Photo</div>
        <div class="panel-body">
            <img class="img img-thumb" src="<?php echo $target_dir.$newFileName ?>" alt="$target_file"></div>
    </div>
</div>

<?php include 'footer.php'; ?>

