<?php
    $servername = "localhost";
	$username = "root";
	$password = "mysql";
	$dbname = "eddy_graphics";
	
	
    ob_start();
	session_start();
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("refresh:1;url=login.php");
		exit;
	}
		$conn =mysqli_connect($servername,$username,$password,$dbname) or die(mysql_error());
		
		$user = mysqli_real_escape_string($conn, $_SESSION['user']);
		$sql=mysqli_query($conn,"SELECT * FROM user WHERE name='$user'");
			$row=mysqli_fetch_array($sql);

?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<title>template</title>
		<link rel="stylesheet" type="text/css" href="css/template_css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/template_css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/template_css/component.css" />
		<link rel="stylesheet" href="css/home_css/components.css">
      <link rel="stylesheet" href="css/home_css/icons.css">
      <link rel="stylesheet" href="css/home_css/responsee.css">
      <link rel="stylesheet" href="css/home_css/template-style.css">       
      <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'> 
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="notification/css/style.css">     
		<script src="js/template_js/modernizr.min.js"></script>
		 <style type="text/css">
#notification {
  background-color: #555;
  color: white;
  text-decoration: none;
  padding: 15px 26px;
  position: relative;
  display: inline-block;
  border-radius: 2px;
}

#notification:hover {
  background: red;
}

#notification .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background: red;
  color: white;
  }
   .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 100px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Style for the menu items */
        .dropdown-content li {
            padding: 2px 6px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content li:hover {
            background-color: #f1f1f1;
        }
}

</style>              
	</head>
	<body>
		 <header class="margin-bottom">
         <div class="line">
            <nav>
               <div class="top-nav">
                  <p class="nav-text"></p>
                  <a class="logo" href="home.php">Eddy<span>Graphics</span>                  </a>                                    
                  <ul class="top-ul right">
                     <li>            
                        <a href="home.php">HOME</a>            
                     </li>
                     <li>            
                        <a href="about.html">ABOUT US</a>            
                     </li>
                     <li>            
                        <a href="template.php">TEMPLATE</a>            
                     </li>
                     <li>            
                        <a href="contact.html">CONTACT</a>  
						<div class="dropdown">
							<span><?php echo $row['name']; ?></span>
							<ul class="dropdown-content">
								<li><a href="notification.php" id="notification">Notification
								 <span class="badge">3</span></a></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</div>                    
                     </li>
                    
                  </ul>
               </div>
            </nav>
         </div>
      </header>
			</header>
<section class="section-50">
  <div class="container">
    <h3 class="m-b-50 heading-line">Notifications <i class="fa fa-bell text-muted"></i></h3>
    <div class="notification-ui_dd-content">
      <div class="notification-list notification-list--unread">
        <div class="notification-list_content">
          <div class="notification-list_img"> <img src="notification/images/users/user1.jpg" alt="user"> </div>
          <div class="notification-list_detail">
            <p><b>Aryan</b> reacted to your post</p>
            <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde, dolorem.</p>
            <p class="text-muted"><small>10 mins ago</small></p>
          </div>
        </div>
        <div class="notification-list_feature-img"> <img src="images/features/random1.jpg" alt="Feature image"> </div>
      </div>
      <div class="notification-list notification-list--unread">
        <div class="notification-list_content">
          <div class="notification-list_img"> <img src="notification/images/users/user1.jpg" alt="user"> </div>
          <div class="notification-list_detail">
            <p><b>Raj Kumar</b> liked your post</p>
            <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde, dolorem.</p>
            <p class="text-muted"><small>10 mins ago</small></p>
          </div>
        </div>
        <div class="notification-list_feature-img"> <img src="notification/images/users/user1.jpg" alt="Feature image"> </div>
      </div>
      <div class="notification-list notification-list--read">
        <div class="notification-list_content">
          <div class="notification-list_img"> <img src="notification/images/users/user1.jpg" alt="user"> </div>
          <div class="notification-list_detail">
            <p><b>Rakesh</b> reacted to your post</p>
            <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde, dolorem.</p>
            <p class="text-muted"><small>10 mins ago</small></p>
          </div>
        </div>
        <div class="notification-list_feature-img"> <img src="notification/images/users/user1.jpg" alt="Feature image"> </div>
      </div>
      <div class="notification-list notification-list--read">
        <div class="notification-list_content">
          <div class="notification-list_img"> <img src="notification/images/users/user1.jpg" alt="user"> </div>
          <div class="notification-list_detail">
            <p><b>Bittu</b> reacted to your post</p>
            <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde, dolorem.</p>
            <p class="text-muted"><small>10 mins ago</small></p>
          </div>
        </div>
        <div class="notification-list_feature-img"> <img src="images/features/random4.jpg" alt="Feature image"> </div>
      </div>
      <div class="notification-list notification-list--unread">
        <div class="notification-list_content">
          <div class="notification-list_img"> <img src="notification/images/users/user1.jpg" alt="user"> </div>
          <div class="notification-list_detail">
            <p><b>Prince</b> reacted to your post</p>
            <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde, dolorem.</p>
            <p class="text-muted"><small>10 mins ago</small></p>
          </div>
        </div>
        <div class="notification-list_feature-img"> <img src="images/features/random3.jpg" alt="Feature image"> </div>
      </div>
      <div class="notification-list notification-list--read">
        <div class="notification-list_content">
          <div class="notification-list_img"> <img src="notification/images/users/user1.jpg" alt="user"> </div>
          <div class="notification-list_detail">
            <p><b>Adi Shots</b> reacted to your post</p>
            <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde, dolorem.</p>
            <p class="text-muted"><small>10 mins ago</small></p>
          </div>
        </div>
        <div class="notification-list_feature-img"> <img src="images/features/random2.jpg" alt="Feature image"> </div>
      </div>
    </div>
   
  </div>
</section>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
			
			<footer>
            <div class="s-12 l-8">
               <p>
                  Copyright 2023, e11even enterprises<br>
               </p>
            </div>
            <div class="s-12 l-4">		                            
                                   
            </div>
         </footer>
		</div><!-- /container -->
		<script src="js/template_js/classie.js"></script>
		<script src="js/template_js/photostack.js"></script>
		<script>
			// [].slice.call( document.querySelectorAll( '.photostack' ) ).forEach( function( el ) { new Photostack( el ); } );
			
			new Photostack( document.getElementById( 'photostack-1' ), {
				callback : function( item ) {
					//console.log(item)
				}
			} );
			new Photostack( document.getElementById( 'photostack-2' ), {
				callback : function( item ) {
					//console.log(item)
				}
			} );
			new Photostack( document.getElementById( 'photostack-3' ), {
				callback : function( item ) {
					//console.log(item)
				}
			} );
		</script>
	</body>
</html>