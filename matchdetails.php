<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

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
                <a class="nav-link" href="Profile.php">Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="betslips.php">Available Betslips</a>
              </li>
              <li class="nav-item active">
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
          </div>
        </div>
      </div>
    </div>

    <!-- Testimonials Starts Here -->
    <div class="testimonials-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <span>Match Details</span>
              <?php
            if($_SESSION['logged'] == true){
                $matchid = $_POST['match'];

                $query = "SELECT match_id, match_type, match_date, match_result FROM Game WHERE match_id ='".$matchid."'";
                $list = mysqli_query($con, $query);
                while($tuple = mysqli_fetch_array($list)) {
                    $tmp = $tuple['match_id'];
                    $query2 = "SELECT Host.team_name AS host, Guest.team_name AS guest 
                    FROM TeamsPlaying, Team AS Host, Team AS Guest
                    WHERE match_id = '" .$tmp ."' AND host_id = Host.team_id AND guest_id = Guest.team_id";
                    $teams = mysqli_query($con, $query2);
                    $teamtuple = mysqli_fetch_array($teams);
                    echo("<h2>".$teamtuple['host']." - ".$teamtuple['guest']."</h2>");
                    echo("<h3>".$tuple['match_date']."</h3>");
                    if($tuple['match_result'] != NULL)
                        echo("<h3>".$tuple['match_result']."</h3>");
                    else
                        echo("<h3>TBA</h3>");

                    echo("</div> </div></div> </div></div>");

                    echo("<div class='services-section services-page'><div class='container'><div class='row'>");

                    $query3 = "SELECT contents,TC_id FROM Comment NATURAL JOIN CommentOnMatch  WHERE match_id ='".$matchid."'";
                    $commentlist = mysqli_query($con, $query3);
                    while($comment = mysqli_fetch_array($commentlist)) {
                        echo("<div class='col-md-4 col-sm-6 col-xs-12'><div class='service-item'>");
                        echo("<h5>".$comment['contents']."</h5>");
                        // find user name
                        $tmp = $comment['TC_id'];
                        $query4 = "SELECT username FROM User WHERE TC_id ='".$tmp."'";
                        $namelist = mysqli_query($con, $query4);
                        $name = mysqli_fetch_array($namelist);
                        echo("<p>".$name['username']."</p>");
                        echo("</div></div>");
                    }
                    // ENTER COMMENT
                    echo("<div class='col-md-4 col-sm-6 col-xs-12'><div class='service-item'>");
                    echo("<h5>Enter your comments</h5>");
                    echo("<form action='matchdetails.php' method='post'><textarea name='comments' id='c1'></textarea><input type='submit' name='match' value='".$tuple['match_id']."' style='background-color:#00bcd4; border-color:#00bcd4;color: #00bcd4'></form>");
                    echo("</div></div>");

                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comments'])) {
                        $comment = $_POST['comments'];
                        $query5 = "SELECT contents FROM Comment WHERE contents = '".$comment."'";
                        $res = mysqli_query($connection, $query5);
                        if(mysqli_num_rows($res) == 0){
                        // find unique id
                            $id = 0; 
                            $query5 = "SELECT comment_id FROM Comment WHERE comment_id = '".$id."'";
                            $res = mysqli_query($connection, $query5);
                            while(mysqli_num_rows($res) > 0){
                                $id = $id + 1;
                                $query5 = "SELECT comment_id FROM Comment WHERE comment_id = '".$id."'";
                                $res = mysqli_query($connection, $query5); 
                            }
                            $date = date('d-m-y h:i:s');
                            $query6 = "INSERT INTO Comment(comment_id, TC_id, comment_date, contents) VALUES('".$id ."', '".$_SESSION['TC_id']."', '".$date."', '".$comment."')";
                            $res = mysqli_query($connection, $query6);
                        
                            $query6 = "INSERT INTO CommentOnMatch(comment_id, match_id) VALUES('".$id ."', '".$matchid."')";
                            $res = mysqli_query($connection, $query6); 
                        }
                    }
                }
            }
              ?>
            </div>
      </div>
    </div>
           
    <!-- Testimonials Ends Here -->

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
