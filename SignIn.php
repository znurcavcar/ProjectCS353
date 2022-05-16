<?php
session_start();

include("config.php");
include("functions.php");

$user_name = "root";
$password = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {
	$user_name = $_POST['username'];
    $password = $_POST['password'];

	if(!empty($user_name) && !empty($password)){
		$result = mysqli_query($connection, "select * from user where username = '" .$user_name. "'");
		if($result && mysqli_num_rows($result) > 0)
		{
			$user_data = mysqli_fetch_assoc($result);
			if($user_data['password'] === $password){ // password is correct
				// getting student information to use on other pages
				$_SESSION['username'] = $user_data['username'];
				$_SESSION['TC_id'] = $user_data['TC_id'];
				$_SESSION['email'] = $user_data['email'];
				$_SESSION['phone']= $user_data['phone'];
				$_SESSION['date_of_birth']= $user_data['date_of_birth'];
				$_SESSION['logged'] = true;
				header("Location: Wallet.php");
				die;
			}
			else{
				echo "<script type='text/javascript'>alert('Invalid Username or Password.');</script>";
				$_SESSION['logged'] = false;
			}
		}
		else{
			echo "<script type='text/javascript'>alert('Invalid Username or Password.');</script>";
			$_SESSION['logged'] = false;
		}
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

		.body{
			background-image: url("./images/loginbackground.jpg");
			background-size: cover;
		}
		</style>
    </head>

    <body>
		<div class="SIGNIN">
        	<h2>Login</h2>
        	<form action="SignIn.php" method="POST" name="SIGNIN" onsubmit="return valid()">
            	<label for="username">Username: </label>
	   			<input type="text" name="username" /> <br/>
            	Password: <input type="password" name="password"/> <br/>
            	<input class="button button1" type="submit" value="Sign In"/> <br/>
			</form>
		</div>
    </body>
</html>

<script type="text/javascript">
import React from 'react';
import loginbackground from "./images/loginbackground.jpg";
function valid() {
	var a = document.forms["SIGNIN"]["username"].value;
	var b = document.forms["SIGNIN"]["password"].value;
	if (a == null || a == "", b == null || b == "") {
		alert("Username and/or password cannot be blank.");
		return false;
	}
}

function bg() {
	// Import result is the URL of your image
	return <img src={loginbackground} alt="loginbackground" />;
}

export default bg;
</script>