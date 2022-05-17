<?php
session_start();

include("config.php");
include("functions.php");

    if(!checkLog()){
	    header("Location: SignIn.php");
	    die;
    }

    $user_data['username'] = $_SESSION['username'];
    $user_data['TC_id'] = $_SESSION['TC_id'];
    $user_data['email'] = $_SESSION['email'];
    $user_data['phone'] = $_SESSION['phone'];
    $user_data['date_of_birth'] = $_SESSION['date_of_birth'];

    if(!isEditor($user_data['TC_id'], $connection)){
        header("Location: Wallet.php");
        die;
    }
	
	if(isset($_POST['create'])){
		header("Location: Wallet.php");
		die;
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

    <title>Betman - Create Bet Slip</title>

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

    <!-- ** Preloader Start ** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ** Preloader End ** -->

    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.html"><h2>BETMAN</h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.html">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="betslips.php">My Betslips</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="matchlist.php">Matches</a>
              </li>
            </ul>
          </div>
          <div class="functional-buttons">
            <ul>
              <li><a href="Welcome.php">Sign Out</a></li>
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
            <h1>Create Bet Slip</h1>
            <p><span>Share Your Predictions with Your Followers</span></p>
          </div>
        </div>
      </div>
    </div>
    <!-- Heading Ends Here -->

    <!-- Contact Us Starts Here -->
    <div class="contact-us">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
              <form id="contact" action="" method="post">
                <div class="row">
                  <?php
                  include "config.php";
                  $con = $connection;
                  $query = "SELECT * FROM Bet";
                  $list = mysqli_query($con, $query);
                  echo("<div class='col-lg-12'><h3>Available Betss\n</h3></div>");
                  echo("<div>");
                  while($tuple = mysqli_fetch_array($list)){
                    $mid = $tuple['match_id']."-".$tuple['bet_type'];
                    echo("<input type='checkbox' name='formMatch[]' value='".$mid."' checked/>".$tuple['match_id']." - ".$tuple['bet_type']."<br />");
                  }
                  echo("</div>");
                  ?>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="main-button">Send Message</button>
                    </fieldset>
                  </div>
                </div>
              </form>
          
          </div>
          <div class="col-md-6">
            <div class="right-content">
              <div class="section-heading">
                <span>Create Bet Slip</span>
                <h2>Your Predictions</h2>
                <p>Use your predictions while creating this bet slip in order to share your predictions with your followers. Your foresight might help others!</p>
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
    </script>

  </body>
</html>