<?php

$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "eddy_graphics";

	$conn = new mysqli($servername,$username,$password,$dbname);
	$error = false;
	$nameError = false;
	$passError = false;
	$emailError = false;


if ( isset($_POST['submit']) ) {
        $name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$address = trim($_POST['address']);
		$address = strip_tags($address);
		$address = htmlspecialchars($address);
		
		$password = trim($_POST['password']);
		$password = strip_tags($password);
		$password = htmlspecialchars($password);
		
		//additonal validation 
		if (empty($name)) {
			$error = true;
			$nameError = "Please enter your full name.";
		} else if (strlen($name) < 3) {
			$error = true;
			$nameError = "Name must have atleat 3 characters.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Name must contain alphabets and space.";
		}
		
		//basic email validation
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		} else {
			// check email exist or not
			$sql1 = mysqli_query($conn, "SELECT email FROM user WHERE email='$email'");
			$count = mysqli_num_rows($sql1);
			if($count!=0){
				$error = true;
				$emailError = "the email you provided has already been used";
			}
		}
		//this is the hashing of the password for security
		$pass = hash('sha256', $password);
		
		if( !$error ) {
		
		$sql =mysqli_query($conn, "insert into user (name,email,address,password) values ('$name','$email','$address','$pass')");
        if ($conn->query($sql) === true)
           {
				$sucMSG = "Successfully registered";
				
				unset($name);
				unset($email);
				unset($address);
				unset($password);
				header("refresh:1;url=login.php");
				
					}else{
					$errTyp = "Failed";
				$errMSG = "Failed to registered";
						header("Location:sign_up.php");
							}
					}
}
?>
<?php
$servername = "localhost";
$username = "root";
$password = "mysql";
$dbname = "eddy_graphics";

$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);
    $phone_number = 'empty';
    $state = 'empty';
    $country = 'empty';
    $postal_code = 'empty';
    $picture = 'empty';

    $stmt = $conn->prepare("INSERT INTO user_profile (name, email, address, phone_number, state, country, postal_code, picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $email, $address, $phone_number, $state, $country, $postal_code, $picture);

    if ($stmt->execute()) {
        header("refresh:1;url=login.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SIGN UP</title>
<link rel="stylesheet" href="css/signup_style.css" />
</head>
<body>
<div class="wrapper">
    <h2>Registration</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off" >
		<?php
				if ( isset($errMSG) ) {
					
					?>
					<div class="form-group">
					<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
					<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
					</div>
					</div>
					<?php
				}
				?>
				<?php
			if ( isset($sucMSG) ) {
				
				?>
				<div class="form-group" style="position: relative;
  padding: 0.75rem 1.25rem;
  margin-bottom: 1rem;
  border: 1px solid transparent;
  border-radius: 5px;
  font-weight: 700;
  color:#FFFFFF;
  background-color:#00FFFF;">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $sucMSG; ?>
            	</div>
                <?php
			}
			?>
      <div class="input-box">
        <input type="text" name="name" placeholder="Enter your name" required>
      </div>
	   <span class="text-danger"><?php echo $nameError; ?></span>
      <div class="input-box">
        <input type="email" name="email" placeholder="Enter your email" required>
      </div>
	  <span class="text-danger"><?php echo $emailError; ?></span>
	   <div class="input-box">
        <input type="text" name="address" placeholder="Enter your address" required>
      </div>
      <div class="input-box">
        <input type="password" id="pword" name="password" placeholder="Create password" required>
      </div>
	  <span class="text-danger"><?php echo $passError; ?></span>
      <div class="input-box">
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm_password" required>
      </div>
     <label class="form-check-label"><input type="checkbox" required="required"> I accept the <a href="#">Terms of Use</a> & <a href="#">Privacy Policy</a></label>
      <div class="input-box button">
        <input type="Submit" value="SIGN UP" name="submit">
      </div>
      <div class="text">
        <h3>Already have an account? <a href="login.php">Login now</a></h3>
      </div>
    </form>
  </div>
</body>
 <script>
        function hello (){
            var c = document.getElementById("confirm_password").value
            var p = document.getElementById("password").value
            if(p.length < 8 || c.length < 8){
                alert("password or confirm password must not be less than 8")
            }else{
                
                    if(c !== p){
                alert("Password does not match")
                
               
            }
            }
         }
<script src="js/sign_up.js"></script>
</html>
