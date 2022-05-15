<?php
include("config.php");

function checkLog(){
	
	if($_SESSION['logged'] === true)
		return true;
	else
		return false;
}

function logout(){
    $_SESSION['logged'] = false;
}

function changeOdd($type, $mid, $odd, $con){
    $query = "update Bet set odd = " . $odd . " where bet_type = " . $type . " and match_id = '$mid'";
	$res = mysqli_query($con, $query);
	
}

function cancelBet(){
	;
}



?>