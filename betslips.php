<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <title>Betman - Available Betslips</title>

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
              <li class="nav-item">
                <a class="nav-link" href="index.html">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="betslips.php">My Betslips</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="wallet.php">My Wallet</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="matchlist.php">Matches</a>
              </li>
            </ul>
          </div>
          <div class="functional-buttons">
            <ul>
              <li><a href="#">Sign Out</a></li>
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
          </div>
        </div>
      </div>
    </div>
    <!-- Heading Ends Here -->


    <!-- Betslips Starts Here -->
    <div class="services-section services-page">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Available Betslips</h2>
            </div>
          </div>
          <?php
            session_start();
            include "config.php";
            $con = $connection;

            $uid = $_SESSION['TC_id'];

            $query = "SELECT * FROM Betslip";
            $complist = mysqli_query($connection, $query);

            // find the bets on the betslips
            while($tuple = mysqli_fetch_array($complist)) {
                $tmp = $tuple['slip_id'];
                $query2 = "SELECT * 
                          FROM SlipHasBet
                          WHERE slip_id = '" .$tmp."' ";
                $bets = mysqli_query($connection, $query2);
                echo("<div class='col-md-4 col-sm-6 col-xs-12'><div class='service-item'>");
                echo("<h4>Betslip ID: ".$tuple['slip_id']."<br>Number of Bets: ".$tuple['no_of_bets']."<br>Rate: ".$tuple['rate']."</h4>");
                while($bettuple = mysqli_fetch_array($bets)){
                  // find the bets on the betslip
                  $tmpid = $bettuple['match_id'];
                  $tmptype = $bettuple['bet_type'];
                  $query3 = "SELECT * 
                          FROM Bet
                          WHERE match_id = '" .$tmpid."' AND bet_type = '" .$tmptype."' ";
                  $betinfo = mysqli_query($connection, $query3);
                  $betinfo = mysqli_fetch_array($betinfo);

                  // find the teams on the bet
                  $query4 = "SELECT * 
                          FROM TeamsPlaying
                          WHERE match_id = '" .$tmpid."' ";
                  $gameinfo = mysqli_query($connection, $query4);
                  $gameinfo = mysqli_fetch_array($gameinfo);

                  // find the guest&host info
                  $host_id = $gameinfo['host_id'];
                  $query5 = "SELECT * 
                          FROM Team
                          WHERE team_id = '" .$host_id."' ";
                  $hostinfo = mysqli_query($connection, $query5);
                  $hostinfo = mysqli_fetch_array($hostinfo);
                  $guest_id = $gameinfo['guest_id'];
                  $query6 = "SELECT * 
                          FROM Team
                          WHERE team_id = '" .$guest_id."' ";
                  $guestinfo = mysqli_query($connection, $query6);
                  $guestinfo = mysqli_fetch_array($guestinfo);
                  echo(" Host - Guest: ".$hostinfo['team_name']." - ".$guestinfo['team_name']." <br> Bet Type: ".$betinfo['bet_type']." <br> Bet Name: ".$betinfo['bet_name']." <br> MBN: ".$betinfo['MBN']." <br> Odds: ".$betinfo['odds']."<br><br></h4>");  
                }
                // Add to my betslips IF NOT ALREADY ADDED
                $query6 = "SELECT * 
                          FROM BettorOwnsSlip
                          WHERE bettor_id = '" .$_SESSION['TC_id']."' AND slip_id='".$tuple['slip_id']."'";
                $res = mysqli_query($connection, $query6);
                if(mysqli_num_rows($res) == 0){
                  echo("<form action='addtobetslip.php' method='post'><button type='submit' name='slip' value='".$tuple['slip_id']."' style='background-color:#00bcd4; border-color:#00bcd4'>Bet on this Slip</button></form>");
                }
                else
                  echo("<h5>Slip already owned!</h5>");
                echo("</div></div>");
            }
          ?>
        </div>
      </div>
    </div>
    <!-- Matches Ends Here --> 

    <!-- Footer Starts Here -->
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
