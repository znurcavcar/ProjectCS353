<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <title>Host Cloud Template - Services</title>

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
          <a class="navbar-brand" href="index.html"><h2>Host <em>Cloud</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="Profile.php">Profile</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="betslips.php">Available Betslips</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="matchlist.php">Matches</a>
              </li>
              <?php

              if(isBettor($_SESSION['TC_id'],$con)){
                echo("<li class='nav-item'><a class='nav-link' href='wallet.php'>My Wallet</a></li>");
                echo("<li class='nav-item active'><a class='nav-link' href='betlist.php'>Bets</a></li>");
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
            <h1>Ongoing Bets</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- Heading Ends Here -->


    <!-- Services Starts Here -->
    <div class="services-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
            </div>
          </div>
          <?php

          session_start();
            include ("config.php");
            include ("functions.php");
            $user_name = "root";
            $password = "";
            $con = $connection;

            // Find ongoing bets
            $query1 = "select * from Bet, Game where bet.match_id = game.match_id and 
                      match_date >= cast(now() as date)";

            $bets = mysqli_query($con, $query1);
            
            if(mysqli_num_rows($bets) == 0){
                echo "Could not find any bets in the database.";
                //exit();
            }
            
            while($bet = mysqli_fetch_array($bets)) { 
                $tmp1 = $bet['match_id'];

                // Find the match info
                $query2 = "select * from Game where match_id = ' ". $tmp1." '";
                $match = mysqli_query($con, $query2);
                if(mysqli_num_rows($match) == 0){
                  echo "Could not find any games in the database.";
                  //exit();
                }
                else{
                  $games = mysqli_fetch_array($match);

                  if(!isCancelled($_SESSION['TC_id'], $games['match_id'], $bet['bet_type'], $con)){
                    $query3 = "select hostTeam.team_name as host, guestTeam.team_name as guest from TeamsPlaying, Team as hostTeam, Team as guestTeam 
                    where match_id = ' ". $tmp1 . "' and host_id = hostTeam.team_id and guest_id = guestTeam.team_id";
            
                        $teams = mysqli_query($con, $query3);
                        $teamtuple = mysqli_fetch_array($teams);

                        echo "<div class='col-md-4 col-sm-6 col-xs-12'>
                                <div class='match'>";
                        echo "<h5>".$teamtuple['host']." - ".$teamtuple['guest']."</h5>";
                        echo "<h5>".$games['match_type']."</h5>";
                        echo "<p>".$games['match_date']."</p";
                        echo "<h5>".$bet['MBN']."</h5>";
                        echo "<h5>".$bet['bet_type']."</h5>";
                        echo "<h5>".$bet['odds']."</h5>";
                        echo "</div></div>";
                    }
                  }

                    
              }
          

          ?>
        </div>
      </div>
    </div>
    <!-- Services Ends Here -->

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