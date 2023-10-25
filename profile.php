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
							$sql = mysqli_query($conn, "SELECT * FROM user WHERE name='$user'");
							$row = mysqli_fetch_array($sql);
							if ($row) {
								echo "<img class='rounded-circle mt-5' width='150px' src='https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg'><span class='font-weight-bold'>" . $row['name'] . "</span><span class='text-black-50'>" . $row['email'] . "</span><span> </span>";

							} else {
								echo "User not logged in";
								header("refresh:1;url=login.php");
							}
							
							mysqli_close($conn);
							?></div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
				
                    <h4 class="text-right">Profile Settings</h4>
                </div>
				
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Name</label><br /><?php 
								 if($row){
								 echo $row['name'];
								 }else
								 {echo "user is logged out";
								 header("Location:login.php");
								 } ?></div>
                </div><br />
                <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Mobile Number</label><br /><?php 
								 if($row1){
								 echo $row1['phone_number'];
								 }else
								 {echo "user is logged out";
								 header("Location:login.php");
								 } ?></div></div><br />
								  <div class="row mt-2">
                    <div class="col-md-12"><label class="labels">Address</label><br /><?php 
								 if($row1){
								 echo $row1['address'];
								 }else
								 {echo "user is logged out";
								 header("Location:login.php");
								 } ?></div></<br />
                    <div class="col-md-12"><label class="labels">Postcode</label><br /><?php 
								 if($row1){
								 echo $row1['postal_code'];
								 }else
								 {echo "user is logged out";
								 header("Location:login.php");
								 } ?></div><br />
                    <div class="col-md-12"><label class="labels">Email</label><br /><?php 
								 if($row){
								 echo $row['email'];
								 }else
								 {echo "user is logged out";
								 header("Location:login.php");
								 } ?></div><br />
                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Country</label><br /><?php 
								 if($row1){
								 echo $row1['country'];
								 }else
								 {echo "user is logged out";
								 header("Location:login.php");
								 } ?></div><br />
                    <div class="col-md-6"><label class="labels">State/Region</label><br /><?php 
								 if($row1){
								 echo $row1['state'];
								 }else
								 {echo "user is logged out";
								 header("Location:login.php");
								 } ?></div><br />
                </div>
				
                <div class="mt-5 text-center"><a href="edit_profile.php"><button class="btn btn-primary profile-button" type="submit" name="submit" onclick="edit_profile.php">Edit Profile</button></a></div>
            </div>
        </div>
		
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
