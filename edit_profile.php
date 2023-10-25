<?php
    $servername = "localhost";
	$username = "root";
	$password = "mysql";
	$dbname = "eddy_graphics";
	
	
    ob_start();
	session_start();
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location:login.php");
		exit;
	}
	$timeout = 300;

// Check for the user's last activity time
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    // User has been inactive for too long, destroy the session and log them out
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location:login.php"); // Redirect to the login page
    exit;
	}
		$conn =mysqli_connect($servername,$username,$password,$dbname) or die(mysql_error());
		
		$user = mysqli_real_escape_string($conn, $_SESSION['user']);
		$sql=mysqli_query($conn,"SELECT * FROM user WHERE name='$user'");
			$row=mysqli_fetch_array($sql);
			$sql1=mysqli_query($conn,"SELECT * FROM user_profile WHERE name='$user'");
			$row1=mysqli_fetch_array($sql1);

?>
<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "eddy_graphics";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    header("refresh:1;url=login.php");
    exit;
}

if (!isset($_SESSION['user'])) {
    echo "User not logged in";
    header("refresh:1;url=login.php");
    exit;
}

$user = mysqli_real_escape_string($conn, $_SESSION['user']);
$sql = mysqli_query($conn, "SELECT * FROM user_profile WHERE name='$user'");
$row = mysqli_fetch_array($sql);

if (isset($_POST['submit'])) {
    $id = strip_tags($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $country = mysqli_real_escape_string($conn, $_POST['country']);
    $postal_code = mysqli_real_escape_string($conn, $_POST['postal_code']);

    // File upload handling
    if (isset($_FILES['picture'])) {
        $picture = $_FILES['picture']['name'];
        $picture_temp = $_FILES['picture']['tmp_name'];
        $picture_folder = "profile_pictures/";

        if (move_uploaded_file($picture_temp, $picture_folder . $picture)) {
            // File uploaded successfully
        } else {
            // Handle the case where the file upload failed
            echo "File upload failed.";
            exit;
        }
    } else {
        // Handle the case where no file was uploaded
        $picture = "";
    }

    // SQL statement to update user_profile
    $sql = "UPDATE `user_profile` SET name = ?, email = ?, phone_number = ?, address = ?, state = ?, country = ?, postal_code = ?, picture = ? WHERE id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssssi", $name, $email, $phone_number, $address, $state, $country, $postal_code, $picture, $id);

        if (mysqli_stmt_execute($stmt)) {
            echo "User profile updated successfully.";
            header("refresh:1;url=home.php");
        } else {
            echo "User profile not updated.";
            header("refresh:5;url=profile.php");
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the statement.";
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Profile</title>
<style type="text/css">
body {
    background: #FFFFFF;
}

.form-control:focus {
    box-shadow: none;
    border-color: #BA68C8
}

.profile-button {
    background: rgb(99, 39, 120);
    box-shadow: none;
    border: none
}

.profile-button:hover {
    background: #682773
}

.profile-button:focus {
    background: #682773;
    box-shadow: none
}

.profile-button:active {
    background: #682773;
    box-shadow: none
}

.back:hover {
    color: #682773;
    cursor: pointer
}

.labels {
    font-size: 11px
}

.add-experience:hover {
    background: #BA68C8;
    color: #fff;
    cursor: pointer;
    border: solid 1px #BA68C8
}
</style>
</head>

<body>
<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "eddy_graphics";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
    header("refresh:1;url=login.php");
    exit;
}

if (!isset($_SESSION['user'])) {
    echo "User not logged in";
    header("refresh:1;url=login.php");
    exit;
}

$user = mysqli_real_escape_string($conn, $_SESSION['user']);
$sql = mysqli_query($conn, "SELECT * FROM user_profile WHERE name='$user'");
$row = mysqli_fetch_array($sql);

if ($row) {
    if ($row['picture']  === "empty") {
         echo "<img class='rounded-circle mt-5' width='150px' src='https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg' alt='Profile Picture'>";
        echo "<span class='font-weight-bold'>" . $row['name'] . "</span>";
        echo "<span class='text-black-50'>" . $row['email'] . "</span>";
    } else {
	$picturePath = $row['picture'];
        echo "<img class='rounded-circle mt-5' width='150px' src='$picturePath' alt='Profile Picture'>";
        echo "<span class='font-weight-bold'>" . $row['name'] . "</span>";
        echo "<span class='text-black-50'>" . $row['email'] . "</span>";
    }
} else {
    echo "User not logged in";
    header("refresh:1;url=login.php");
}

mysqli_close($conn);
?>

</div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
				<form action="#" method="post" enctype="multipart/form-data">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
				 <div class="row mt-2" style="visibility:hidden">
                    <div class="col-md-6"><label class="labels">id</label><input type="text" class="form-control" placeholder="enter name" value="<?php 
								 if($row){
								 echo $row['id'];
								 }else
								 {echo "user is logged out";
								 header("Location:login.php");
								 } ?>" name="id"></div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Name</label><input type="text" class="form-control" placeholder="enter name" value="<?php 
								 if($row){
								 echo $row['name'];
								 }else
								 {echo "user is logged out";
								 header("Location:login.php");
								 } ?>" name="name" readonly="readonly"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number" value="" name="phone_number"></div>
                    <div class="col-md-12"><label class="labels">Address</label><input type="text" class="form-control" placeholder="enter address " value="<?php 
								 if($row){
								 echo $row['address'];
								 }else
								 {echo "user is logged out";
								 header("Location:login.php");
								 } ?>" name="address"></div>
                    <div class="col-md-12"><label class="labels">Postcode</label><input type="text" class="form-control" placeholder="enter postal code" value="" name="postal_code"></div>
                    <div class="col-md-12"><label class="labels">Email</label><input type="text" class="form-control" placeholder="enter email id" value="<?php 
								 if($row){
								 echo $row['email'];
								 }else
								 {echo "user is logged out";
								 header("Location:login.php");
								 } ?>" name="email" readonly="readonly"></div>
                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Country</label><input type="text" class="form-control" placeholder="country" value="" name="country"></div>
                    <div class="col-md-6"><label class="labels">State/Region</label><input type="text" class="form-control" value="" placeholder="state" name="state"></div>
                </div>
				<div class="col-md-12"><label class="labels">photo</label><input type="file" class="form-control" placeholder="experience" value="" name="picture"></div> <br>
                
                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit" name="submit">Save Profile</button></div>
            </div>
        </div>
		</form>
        <div class="col-md-4">
            <div class="p-3 py-5">
                
            </div>
        </div>
    </div>
</div>
</div>
</div>

</body>
</html>
