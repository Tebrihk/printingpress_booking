<?php
	ob_start();
	session_start();
	
	$servername = "localhost";
	$username = "root";
	$password = "mysql";
	$dbname = "eddy_graphics";
	
	$conn =mysqli_connect($servername,$username,$password,$dbname);
	$error = false;
	$emailError = false;
	$passError = false;
	
	if( isset($_POST['login']) ) {	
		
		// prevent sql injections/ clear user invalid inputs
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$password = trim($_POST['password']);
		$password = strip_tags($password);
		$password = htmlspecialchars($password);
		
		if(empty($email)){
			$error = true;
			$emailError = "Please enter your email address.";
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		}
		
		if(empty($password)){
			$error = true;
			$passError = "Please enter your password.";
		}
		
		
		if (!$error) {
			
			$pass = hash('sha256', $password); // password hashing using SHA256
		
			$sql=mysqli_query($conn, "SELECT name,email,password FROM user WHERE email='$email'");
			$row=mysqli_fetch_array($sql);
			$count = mysqli_num_rows($sql); 
			if ($count == 1 && $row['password']==$pass) {
			$_SESSION['user'] = $row['name'];
			 $sucMSG = "Login successful";
			header("refresh:1;url=home.php");
			} else {
			
			  $errMSG = "Incorrect Credentials, Try again...";
			  header("refresh:1;url=login.php");
			}
				
		}
		
	}
		
		
	?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LOG IN</title>
<link rel="stylesheet" href="css/signup_style.css" />
</head>
<body>
<div class="wrapper">
    <h2>log in</h2>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" method="POST">
	<?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-danger">
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
  background-color: #99CCCC;">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $sucMSG; ?>
            	</div>
                <?php
			}
			?>
	
      <div class="input-box">
        <input type="email" class="form-control p-4" id="email" name="email" placeholder="Your email address" required="required"
         data-validation-required-message="Please enter your email address" />
		<span class="text-danger"><?php echo $emailError; ?></span>
      </div>
      <div class="input-box">
        <input type="password" id="password" name="password" placeholder="Create password" required>
      </div>
	   <span class="text-danger"><?php echo $passError; ?></span>
      <div class="input-box button">
        <input type="Submit" value="LOGIN" name="login">
      </div>
      <div class="text">
        <h3>Don't have an account? <a href="sign_up.php">Sign up</a></h3>
      </div>
    </form>
  </div>
</body>
</html>
<?php ob_end_flush(); ?>