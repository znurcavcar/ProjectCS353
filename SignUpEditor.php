<?php
session_start();

include("config.php");
include("functions.php");

$user_name = "root";
$password = "";

if(checkLog()){
	header("Location: Wallet.php");
	die;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $tc_no = $_POST['tc_no'];
    $email = $_POST['email'];
	$user_name = $_POST['username'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    //$result = mysqli_query($connection, "select * from user where TC_id = '$tc_no' or email = '$email' or username = '$user_name' or phone = '$phone'");
    $result = mysqli_query($connection, "select * from user where (TC_id = '" .$tc_no. "' or email = '" .$email."' or username = '" .$user_name."' or phone = '" .$phone. "')");
	
    if(mysqli_num_rows($result) == 0){ // if there exists no users with the given TC no, email, username and phone number
        if($password == $password_confirm){
            createEditor($tc_no, $email, $user_name, $phone, $dob, $password, $connection);
        }
        else{
            echo "<script type='text/javascript'>alert('Your passwords do not match.');</script>";
			$_SESSION['logged'] = false;
        }
    }
    else{
        echo "<script type='text/javascript'>alert('A user with the given TC no, e-mail, username or phone number already exists.');</script>";
        $_SESSION['logged'] = false;  
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

    <title>Betman - Sign Up Editor</title>

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
              <li><a href="SignIn.php">Sign In</a></li>
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
            <h1>Sign Up - Editor</h1>
            <p><span>Don't have an account yet? You can sign up here.</span></p>
          </div>
        </div>
      </div>
    </div>
    <!-- Heading Ends Here -->


    <!-- Contact Us Starts Here -->
	<br>
	<br>
	<br>
    <div class="SIGNUP">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="contact-form">
              <form id="contact" action="" method="post">
                <div class="row">
                  <div class="col-md-12 col-sm-12">
				  	<form action="SignUpEditor.php" method="POST" name="SIGNUP" onsubmit="return valid()">
                    <fieldset>
                      <input name="username" type="text" id="username" placeholder="Your username" required="">
                    </fieldset>
					<fieldset>
                      <input name="tc_no" type="number" id="tc_no" placeholder="Your TC No" required="">
                    </fieldset>
					<fieldset>
                      <input name="email" type="text" id="email" placeholder="Your E-mail" required="">
                    </fieldset>
					<fieldset>
                      <input name="phone" type="tel" id="phone" placeholder="Your Phone No" required="">
                    </fieldset>
					<fieldset>
                      <input name="dob" type="date" id="dob" placeholder="Your Date of Birth" required="">
                    </fieldset>
					<fieldset>
                      <input name="password" type="password" id="password" placeholder="Your Password" required="">
                    </fieldset>
					<fieldset>
                      <input name="password_confirm" type="password" id="password_confirm" placeholder="Your Password Again" required="">
                    </fieldset>
					</form>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="main-button">Sign Up</button>
                    </fieldset>
                  </div>
                </div>
              </form>
          </div>
          </div>
          <div class="col-md-6">
            <div class="right-content">
              <div class="section-heading">
                <span>Sign Up - Editor</span>
                <h2>Have Some Questions?</h2>
                <p>If you have any questions regarding the registration process, you can contact our team. We are here to help!</p>
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
			var a = document.forms["SIGNUP"]["username"].value;
			var b = document.forms["SIGNUP"]["tc_no"].value;
			var c = document.forms["SIGNUP"]["email"].value;
			var d = document.forms["SIGNUP"]["phone"].value;
			var e = document.forms["SIGNUP"]["dob"].value;
			var f = document.forms["SIGNUP"]["password"].value;
			var g = document.forms["SIGNUP"]["password_confirm"].value;
			if (a == null || a == "", b == null || b == "", c == null || c == "", d == null || d == "", e == null || e == "", f == null || f == "", g == null || g == "") {
				alert("Required areas cannot be blank.");
				return false;
			}
		}
    </script>

  </body>
</html>
