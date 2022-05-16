<?php
session_start();

include("config.php");
include("functions.php");

$user_name = "root";
$password = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {
	$user_name = $_POST['username'];
    $password = $_POST['password'];

	if(!empty($user_name) && !empty($password)){
		$result = mysqli_query($connection, "select * from user where username = '" .$user_name. "'");
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			if($user_data['password'] === $password){ // password is correct
				// getting student information to use on other pages
				$_SESSION['username'] = $user_data['username'];
				$_SESSION['TC_id'] = $user_data['TC_id'];
				$_SESSION['email'] = $user_data['email'];
				$_SESSION['phone']= $user_data['phone'];
				$_SESSION['date_of_birth']= $user_data['date_of_birth'];
				$_SESSION['logged'] = true;
				header("Location: Wallet.php");
				die;
			}
			else{
				echo "<script type='text/javascript'>alert('Invalid Username or Password.');</script>";
				$_SESSION['logged'] = false;
			}
		}
		else{
			echo "<script type='text/javascript'>alert('Invalid Username or Password.');</script>";
			$_SESSION['logged'] = false;
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <title>Betman - Sign In</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-host-cloud.css">
    <link rel="stylesheet" href="assets/css/owl.css">
<!--

Host Cloud Template

https://templatemo.com/tm-541-host-cloud

-->
  </head>

  <body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.html"><h2>Betman</h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="Welcome.php">Welcome</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="AboutUs.php">About Us</a>
              </li>
            </ul>
          </div>
          <div class="functional-buttons">
            <ul>
              <li><a href="SignUpBettor.php">Sign Up</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <!-- Heading Starts Here -->
    <div class="page-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1>Sign In</h1>
            <p><span>Already have an account? You can sign in here.</span></p>
          </div>
        </div>
      </div>
    </div>
    <!-- Heading Ends Here -->


    <!-- Contact Us Starts Here -->
	<br>
	<br>
	<br>
    <div class="SIGNIN">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="contact-form">
              <form id="contact" action="" method="post">
                <div class="row">
                  <div class="col-md-12 col-sm-12">
				  	<form action="SignIn.php" method="POST" name="SIGNIN" onsubmit="return valid()">
                    <fieldset>
                      <input name="username" type="text" id="username" placeholder="Your username" required="">
                    </fieldset>
					<fieldset>
                      <input name="password" type="password" id="password" placeholder="Your password" required="">
                    </fieldset>
					</form>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="main-button">Sign In</button>
                    </fieldset>
                  </div>
                </div>
              </form>
          </div>
          </div>
          <div class="col-md-6">
            <div class="right-content">
              <div class="section-heading">
                <span>Sign In</span>
                <h2>Forgot Something?</h2>
                <p>If you cannot remember your username or your password, you can contact our team.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Contact Us Ends Here -->

    <!-- Footer Starts Here -->
    <br>
    <br>
    <br>
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="sub-footer">
              <p>Copyright &copy; 2020 Cloud Hosting Company
				- Designed by <a rel="nofollow" href="https://templatemo.com">TemplateMo</a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- Footer Ends Here -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/accordions.js"></script>


    <script language = "text/Javascript"> 
      cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
      function clearField(t){                   //declaring the array outside of the
      if(! cleared[t.id]){                      // function makes it static and global
          cleared[t.id] = 1;  // you could use true and false, but that's more typing
          t.value='';         // with more chance of typos
          t.style.color='#fff';
          }
      }

	  function valid() {
	var a = document.forms["SIGNIN"]["username"].value;
	var b = document.forms["SIGNIN"]["password"].value;
	if (a == null || a == "", b == null || b == "") {
		alert("Username and/or password cannot be blank.");
		return false;
	}
}
    </script>

  </body>
</html>
