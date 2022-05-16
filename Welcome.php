<?php
session_start();

include("config.php");
include("functions.php");

if(!checkLog()){
    if(isset($_POST['admin'])){
		header("Location: SignUpAdmin.php");
        die;
	}
	
    if(isset($_POST['editor'])){
		header("Location: SignUpEditor.php");
        die;
	}

    if(isset($_POST['bettor'])){
		header("Location: SignUpBettor.php");
        die;
	}
}
else{
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

    <title>Betman - Welcome Page</title>

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
              <li class="nav-item active">
                <a class="nav-link" href="Welcome.php">Welcome</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="AboutUs.php">About Us</a>
              </li>
            </ul>
          </div>
          <div class="functional-buttons">
            <ul>
              <li><a href="SignIn.php">Sign in</a></li>
              <li><a href="#signup-section">Sign Up</a></li>
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
            <h1>Welcome to Betman!</h1>
            <p><span>~ Social Betting Platform ~</span></p>
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
              <img src="assets/images/betman-logo-bigger.png" alt="">
            </div>
          </div>
          <div class="col-md-6">
            <div class="right-content">
              <div class="section-heading">
			  <section id="signup-section">
                <span>Welcome!</span>
                <h2>Want to Know More About Us?</h2>
                <p>If you want to know more about Betman, you can always pay a visit to our "About Us" page. Now let us talk about the best part of Betman: our wonderful members!</p>
              </div>
              <div id='tabs'>
                  <ul>
                    <li><a href='#tabs-1'>Bettor</a></li>
                    <li><a href='#tabs-2'>Editor</a></li>
                    <li><a href='#tabs-3'>Admin</a></li>
                  </ul>
                  <section class='tabs-content'>
                    <article id='tabs-1'>
                      <p>Ut elementum a elit sed tristique. Pellentesque sed semper erat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean quam erat, rutrum ut malesuada a, commodo vitae lectus. Integer volutpat sapien in arcu fringilla, ac eleifend est facilisis.
                      <br><br>Phasellus finibus lacus eu scelerisque rutrum. Duis purus eros, blandit ultricies iaculis in, commodo quis lacus. Pellentesque interdum varius enim nec accumsan.</p>
					  <div class="functional-buttons">
						<br>
            			<ul>
              				<li><a href="SignIn.php">Sign Up as Bettor</a></li>
            			</ul>
         			  </div>
                    </article>
                    <article id='tabs-2'>
                      <p>Aenean molestie, odio quis viverra ultricies, leo tellus lacinia neque, sit amet maximus tortor nunc aliquet felis. Duis sit amet nibh non sapien tincidunt bibendum. Curabitur rutrum justo id leo ornare, suscipit lobortis augue volutpat.
                      <br><br>Sed ligula arcu, interdum eu magna eget, tristique aliquet nibh. Aenean sodales justo vitae ex pharetra, vitae tincidunt dolor condimentum. Cras vel mattis risus.</p>
					  <div class="functional-buttons">
					    <br>
            			<ul>
              				<li><a href="SignIn.php">Sign Up as Editor</a></li>
            			</ul>
         			  </div>
					</article>
                    <article id='tabs-3'>
                      <p>Fusce in semper velit, at tempus augue. Morbi quis auctor ipsum, ut accumsan neque. Vivamus dapibus ipsum placerat ante commodo, eget suscipit tortor hendrerit. Quisque lacinia sed velit et maximus.
                      <br><br>Quisque dictum, lacus a malesuada finibus, arcu magna luctus risus, eu accumsan risus elit vitae lacus. Vestibulum et lorem non erat efficitur iaculis ut nec nibh. Vestibulum mauris ipsum, tempor tincidunt justo sit amet, bibendum tincidunt dui.</p>
					  <div class="functional-buttons">
					  	<br>
            			<ul>
              				<li><a href="SignIn.php">Sign Up as Admin</a></li>
            			</ul>
         			  </div>
					</article>
                  </section>
				</section>
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