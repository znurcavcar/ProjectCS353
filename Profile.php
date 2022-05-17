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
?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <title>Betman - Profile</title>

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
          <a class="navbar-brand" href="index.html"><h2>BETMAN</h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="Profile.php">Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="betslips.php">Available Betslips</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="matchlist.php">Matches</a>
              </li>
              <?php
              $con = $connection;
              if(isBettor($_SESSION['TC_id'],$con)){
                echo("<li class='nav-item'><a class='nav-link' href='wallet.php'>My Wallet</a></li>");
                echo("<li class='nav-item'><a class='nav-link' href='betlist.php'>Bets</a></li>");
                echo("<li class='nav-item'><a class='nav-link' href='mybetslips.php'>My Betslips</a></li>");
                echo("<li class='nav-item'><a class='nav-link' href='lotteryTickets.php'>My Lottery Tickets</a></li>");
              }
              if(isAdmin($_SESSION['TC_id'],$con)){
                echo("<li class='nav-item'><a class='nav-link' href='adminsBetList.php'>Bets</a></li>");
              }
              ?>
            </ul>
          </div>
          <div class="functional-buttons">
            <ul>
              <li><a href="SignOut.php">Sign Out</a></li>
            </ul>
            </form>
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
            <h1>Profile</h1>
            <p><span>All your account information at one place!</span></p>
          </div>
        </div>
      </div>
    </div>
    <!-- Heading Ends Here -->


    <!-- About Us Starts Here -->
    <div class="about-us">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="left-image">
              <img src="assets/images/pp.png" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-content">
              <div class="section-heading">
			  <section id="profile-section">
                <br>
                <span>Profile</span>
                <h2><?php echo $user_data['username']?></h2>
                <p><?php echo ("TC No: ".$user_data['TC_id'])?></p>
                <p><?php echo ("E-mail: ".$user_data['email'])?></p>
                <p><?php echo ("Phone No: ".$user_data['phone'])?></p>
                <p><?php echo ("Date of Birth: ".$user_data['date_of_birth'])?></p>
                <div class="functional-buttons">
                    <ul>
                        <br><br>
                        <li><a href="#">Change Password</a></li>
                    </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- About Us Ends Here -->

    <!-- Footer Starts Here -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <img src="assets/images/betman-logo-white.png" alt="" class="center">
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

