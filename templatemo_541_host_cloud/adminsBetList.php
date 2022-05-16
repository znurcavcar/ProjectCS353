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
          <a class="navbar-brand" href="index.html"><h2>Host <em>Cloud</em></h2></a>
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
                <a class="nav-link" href="about.html">About Us</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="services.html">Our Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
            </ul>
          </div>
          <div class="functional-buttons">
            <ul>
              <li><a href="#">Log in</a></li>
              <li><a href="#">Sign Up</a></li>
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
            include ("config.php");
            include ("functions.php");
            $user_name = "root";
            $password = "";
            $con = $connection;
            
            // Find ongoing bets
            //$query1 = "select MBN, bet_type, odds from BET, Game where bet.match_id == game.match_id and match_date <= GETDATE()";
            $query1 = "select * from Bet";
            $bets = mysqli_query($con, $query1);
            
            if(mysqli_num_rows($bets) == 0){
                echo "Could not find any bets in the database.";
                //exit();
            }
            
            while($bet = mysqli_fetch_array($bets)) { 
                // Find the match info
                $query2 = "select * from Game";
                $games = mysqli_query($con, $query2);

                while($game = mysqli_fetch_array($games)) {  
                    $tmp = $game['match_id'];

                    $query3 = "select host.team_name as host, guest.team_name as guest from TeamsPlaying, Team as host, Team as guest 
                            where match_id = ' . $tmp . ' and host_id = host.team_id and guest_id = guest.team_id";
                    $teams = mysqli_query($con, $query2);
                    $teamtuple = mysqli_fetch_array($teams);

                    echo "<div class='col-md-4 col-sm-6 col-xs-12'>
                            <div class='match'>";
                    echo "<h5>".$teamtuple['host']." - ".$teamtuple['guest']."</h5>";
                    echo "<h5>".$game['match_type']."</h5>";
                    echo "<p>".$game['match_date']."</p";
                    echo "</div></div>";
                } 

                echo "<h5>".$bet['MBN']."</h5>";
                echo "<h5>".$bet['bet_type']."</h5>";
                echo "<h5>".$bet['odds']."</h5>";
                
                echo "<div class=\"CancelBet\">
                <form method=\"POST\" name=\"CancelBet\">
                <button type=\"submit\" class=\"btn btn-success\">Cancel</button>
                </form></div>";

                if($_SERVER["REQUEST_METHOD"] == "POST") {
                    $now = new DateTime('now');
                    cancelBet($bet['bet_type'], $bet['match_id'], $_SESSION['TC_id'], $now, $con);
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