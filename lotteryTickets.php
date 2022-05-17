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
              session_start();
              include "config.php";
              include "functions.php";
              $con = $connection;
              if(isBettor($_SESSION['TC_id'],$con)){
                echo("<li class='nav-item'><a class='nav-link' href='wallet.php'>My Wallet</a></li>");
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
            <h1>My Lottery Tickets</h1>
            <form method="POST">
            <input class="button button1" type="submit" value="Buy Ticket"/> <br/>
            </form>
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
            $user_name = "root";
            $password = "";
            
            if($_SESSION['logged'] === false || !isBettor($_SESSION['TC_id'], $con)){
                header("Location: SignIn.php");
            }
            else{
                // Find lottery tickets of the current user
                $query1 = "select * from LotteryTicket natural join BettorBoughtTicket where bettor_id = '" . $_SESSION['TC_id'] ."' ";
                $tickets = mysqli_query($con, $query1);
                
                if(mysqli_num_rows($tickets) != 0){
                    while($ticket = mysqli_fetch_array($tickets)) { 

                        // Find the lottery info
                        $query2 = "select * from Lottery where lottery_id = ' ". $ticket['lottery_id']." '";
                        $lotteries = mysqli_query($con, $query2);
                        if(mysqli_num_rows($lotteries) == 0){
                            echo "Could not find any lotteries in the database.";
                            //exit();
                        }
                        else{
                            $lottery = mysqli_fetch_array($lotteries);

                                

                                echo "<div class='col-md-4 col-sm-6 col-xs-12'>
                                        <div class='lotteryticket'>";
                                echo "<h5>Lottery Ticket " . $ticket['ticket_id'] ."</h5>";
                                echo "<p>Ticket Purchase Date: ".$ticket['ticket_purchase_date']."</p>";
                                echo "<p>Lottery ID: ".$lottery['lottery_id']."</p>";
                                echo "<p>Lottery Start Date: ".$lottery['lottery_start_date']."</p>";
                                echo "<p>Lottery End Date: ".$lottery['lottery_end_date']."</p>";

                                $now = new DateTime('now');
                                if($lottery['lottery_end_date'] <= $now){
                                    if($ticket['reward'] != 0)
                                        echo "<p>Lottery Result: ".$ticket['reward']."</p>";
                                    else 
                                        echo "<p>Better luck next time:(</p>";
                                    echo "</div></div>";
                                }
                                else{
                                    echo "<h5>Lottery Result: Not concluded yet.</h5>";
                                    echo "</div></div>";
                                }
                        }
                    }
                }

            }

            if($_SERVER["REQUEST_METHOD"] == "POST" ) {
                $l_id = "select * from Lottery where lottery_end_date > cast(now() as date)";
                $l = mysqli_query($con, $l_id);
                if(mysqli_num_rows($lotteries) > 0){
                  $li = mysqli_fetch_array($l);
                  createLotteryTicket($_SESSION['TC_id'], $li['lottery_id'], $con);
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