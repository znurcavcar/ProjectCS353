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

function changeOdd($type, $mid, $odd, $connection){
	$query = "update Bet set ' . $odd . ' 
				where bet_type = ' . $type . ' 
				and match_id = ' . $mid . '";
	$res = mysqli_query($connection, $query);
	if(!$res){
		echo "Failed to change the odd";
		exit();
	}
}

function cancelBet($type, $mid, $uid, $date, $connection){
	$query = "insert into BetRemovedByAdmin values(' . $uid . ',
				' . $mid . ', ' . $date . ', ' . $date . ')";
	$res = mysqli_query($connection, $query);
	if(!$res){
		echo "Failed to cancel the bet";
		exit();
	}
}

?>