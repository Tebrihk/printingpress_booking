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

?>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>eddy graphis</title>
      <link rel="stylesheet" href="css/home_css/components.css">
      <link rel="stylesheet" href="css/home_css/icons.css">
      <link rel="stylesheet" href="css/home_css/responsee.css">
      <link rel="stylesheet" href="css/home_css/template-style.css">       
      <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>      
      <script type="text/javascript" src="js/home_js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="js/home_js/jquery-ui.min.js"></script> 
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
   <body class="size-1140">        
      <header class="margin-bottom">
         <div class="line">
            <nav>
               <div class="top-nav">
                  <p class="nav-text"></p>
				  
                  <a class="logo" href="home.php"> <img src="img/IMG-20231025-WA0013.jpg" style="height:70px; width:70px;"></a>                                    
                  <ul class="top-ul right">
                     <li>            
                        <a href="home.php">HOME</a>            
                     </li>
                     <li>            
                        <a href="#">ABOUT US</a>            
                     </li>
                     <li>            
                        <a href="template.php">TEMPLATE</a>            
                     </li>
                     <li>            
                        <a href="contact-form/index.html">CONTACT</a>  
						<div class="dropdown">
							<span>
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
								echo $row['name'];
							} else {
								echo "User not logged in";
								header("refresh:1;url=login.php");
							}
							
							mysqli_close($conn);
							?>
							</span>
							<ul class="dropdown-content">
							<li><a href="profile.php">Profile</a></li>
								<li><a href="notification.php">Notification
								 </a></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</div>          
                     </li>
					    
                    
                  </ul>
               </div>
            </nav>
         </div>
      </header>
                
      <section id="home-section" class="line">
         <div class="margin">
            <!-- ARTICLES -->             
            <div class="s-12 m-7 l-9">
               <!-- ARTICLE 1 -->               
               <article class="post-1 line">
                  <!-- image -->                 
                  <div class="s-12 l-6 post-image">                   
                     <a href="post-1.html">
                     <img class="full-img" src="img/BUSINESS-CARD-two-sides.jpg">
                     </a>                
                  </div>
                  <!-- text -->                 
                  <div class="s-12 l-5 post-text">
                     <a href="post-1.html">
                        <h2>BUSINESS CARDS</h2>
                     </a>
                     <p>we make luxurious business cards of different types and varaities. pending on the taste of the customer            
                     </p>
                  </div>
                  <!-- date -->                 
                  <div class="s-12 l-1 post-date">
                    
                  </div>
               </article>
               
               <!-- ARTICLE 2 -->            
               <article class="post-2 right-align line">
                  <!-- image -->                 
                  <div class="s-12 l-6 post-image">                   
                     <a href="post-2.html">
                     <img class="full-img" src="img/img.JPG">
                     </a>                
                  </div>
                  <!-- text -->                 
                  <div class="s-12 l-5 post-text">
                     <a href="post-2.html">
                        <h2>Amazing fashion printing</h2>
                     </a>
                     <p>printing on any material is an art that eddy graphics has perfected to meet the satisfaction of the customer.           
                     </p>
                  </div>
                  <!-- date -->                 
                  <div class="s-12 l-1 post-date">
                     
                  </div>
               </article>
               
               <!-- ARTICLE 3 -->              
               <article class="post-3 line">
                  <!-- image -->                 
                  <div class="s-12 l-6 post-image">                   
                     <a href="post-3.html">
                     <img class="full-img" src="img/spiral-and-book-500x500.jpeg">
                     </a>                
                  </div>
                  <!-- text -->                 
                  <div class="s-12 l-5 post-text">
                     <a href="post-3.html">
                        <h2>book and jornal binding</h2>
                     </a>
                     <p>options is what everyone wants,and we at eddy graphics offer options on the tupes of binding needs of the customer with guarantee.                
                  </div>
                  <!-- date -->                 
                  <div class="s-12 l-1 post-date">
                    
                  </div>
               </article>
               
               <!-- ARTICLE 4 -->           
               <article class="post-4 right-align line">
                  <!-- image -->                 
                  <div class="s-12 l-6 post-image">                   
                     <a href="post-4.html">
                     <img src="img/11.jpg">
                     </a>                
                  </div>
                  <!-- text -->                 
                  <div class="s-12 l-5 post-text">
                     <a href="post-4.html">
                        <h2>With advertising regions</h2>
                     </a>
                     <p>we oofer grahics designs and printing of billbords,flyers and magazine art work and printing.               
                  </div>
                  <!-- date -->                 
                  <div class="s-12 l-1 post-date">
                     
                  </div>
               </article>
               
               <article class="post-5 line">
                  <div class="s-12 l-11 post-text">
                     <a href="post-5.html">
                        <h2>And again - </h2>
                     </a>
                     <p></p>
                  </div>
                
               </article>
            </div>       
            <div class="s-12 m-5 l-3">
               <aside>   
                  <img src="img/shoplocal-bg2.jpg">          
                  <div class="aside-block margin-bottom">
                     <h3>VISIT US:</h3>
                     <p>ADDRESS: </p>
					 <p>CONTACT: </p>
					 <p>EMAIL: </p>
                  </div>
                       
                  <div class="aside-block margin-bottom">
                     <h3>ADS</h3>
                  </div>       
                  <div class="advertising margin-bottom hide-s">
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <ins class="adsbygoogle"
                         style="display:inline-block;width:160px;height:600px"
                         data-ad-client="ca-pub-8115128083480193"
                         data-ad-slot="7468355662"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
					<img src="img/Screenshot_20221107-h.png"/>          
                  </div>
               </aside>
            </div>
         </div>
      </section>
      <!-- FOOTER -->       
      <div class="line">
         <footer>
            <div class="s-12 l-8">
               <p>
                  Copyright 2023, e11even enterprises<br>
               </p>
            </div>
            <div class="s-12 l-4">		                            
                                   
            </div>
         </footer>
      </div>
      <script type="text/javascript" src="js/home_js/responsee.js"></script>
   </body>
</html>