
<?php
session_start();

include("config.php");
include("functions.php");

$user_name = "root";
$password = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $tc_no = $_POST['tc_no'];
    $email = $_POST['email'];
	$user_name = $_POST['username'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    //$result = mysqli_query($connection, "select * from user where TC_id = '$tc_no' or email = '$email' or username = '$user_name' or phone = '$phone'");
    $result = mysqli_query($connection, "select * from user where (TC_id = " .$tc_no. " or email = " .$email." or username = " .$user_name." or phone = " .$phone. ")");
	
    if(is_null($result)){ // if there exists no users with the given TC no, email, username and phone number
        if($password == $password_confirm){
            createBettor($tc_no, $email, $user_name, $phone, $dob, $password);
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

<html>
    <head>
    	<style>
		.LOGG{
			text-align: center;
  			margin: auto;
  			border: 3px solid #0aaef2;
  			padding: 10px; 
			position: absolute;
  			top: 25%;
			left: 25%;
  			width: 50%;
		}
		
		form{
			color: black;
		}

		input[type=text]{
			width: 50%;
  			padding: 12px 20px;
  			margin: 8px 0;
  			box-sizing: border-box;
  			border: none;
  			background-color: #d2e0f2;
  			color: white;
		}

		input[type=password]{
			width: 50%;
  			padding: 12px 20px;
  			margin: 8px 0;
  			box-sizing: border-box;
  			border: none;
  			background-color: #d2e0f2;
  			color: white;
		}

		.button {
			background-color: #0aaef2; 
			border: none;
			border-radius: 8px;
			color: white;
			padding: 15px 30px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 4px;
			cursor: pointer;
			-webkit-transition-duration: 0.4s;
			transition-duration: 0.4s;
		}

		.button:hover {
			background-color: #0055c0;
			color: white;
		}
		</style>
    </head>

    <body>
		<div class="SIGNUP">
        	<h2>Sign Up</h2>
        	<form action="SignUpBettor.php" method="POST" name="SIGNUP" onsubmit="return valid()">
            	<label for="username">Username: </label>
	   			<input type="text" name="username" /> <br/>
				<label for="tc_no">TC No: </label>
				<input type="number" name="tc_no"/> <br/>
				<label for="email">E-mail: </label>
				<input type="email" name="email"/> <br/>
				<label for="phone">Phone No: </label>
				<input type="tel" name="phone"/> <br/>
				<label for="dob">Date of Birth: </label>
				<input type="date" name="dob"/> <br/>
				<label for="password">Password: </label>
				<input type="password" name="password"/> <br/>
				<label for="password_confirm">Password Confirmation: </label>
				<input type="password" name="password_confirm"/> <br/>
            	<input class="button button1" type="submit" value="SignUp"/> <br/>
			</form>
		</div>
    </body>
</html>

<script type="text/javascript">
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