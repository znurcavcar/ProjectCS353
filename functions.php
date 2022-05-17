<?php
include("config.php");

function checkLog(){
	// is the user logged in?
	if($_SESSION['logged'] === true)
		return true;
	else
		return false;
}

function isBettor($tc_no, $connection){
    if(checkLog()){
        $queryUser = "select * from bettor where (TC_id = '" .$tc_no. "')";
        $result = mysqli_query($connection, $queryUser);
        if(mysqli_num_rows($result) == 0)
            return false;
        else
            return true;
    }
    else
        return false;
}

function isEditor($tc_no, $connection){
    if(checkLog()){
        $queryUser = "select * from editor where (TC_id = '" .$tc_no. "')";
        $result = mysqli_query($connection, $queryUser);
        if(mysqli_num_rows($result) == 0)
            return false;
        else
            return true;
    }
    else
        return false;
}

function isAdmin($tc_no, $connection){
    if(checkLog()){
        $queryUser = "select * from admin where (TC_id = '" .$tc_no. "')";
        $result = mysqli_query($connection, $queryUser);
        if(mysqli_num_rows($result) == 0)
            return false;
        else
            return true;
    }
    else
        return false;
}

function logout(){
	$_SESSION['logged'] = false;
    session_destroy();
}

function createBettor($tc_no, $email, $username, $phone, $dob, $password, $connection){
    // inserting the user into user table
    // ('$username', '" . md5($password) . "', '$email', '$create_datetime')"
	$queryUser = ("INSERT INTO User (TC_id, password, username, email, phone, date_of_birth) VALUES('$tc_no', '$password', '$username', '$email', '$phone', '$dob')");
    $resultUser = mysqli_query($connection, $queryUser);

    // inserting the user into bettor table
    $queryBettor = ("INSERT INTO GeneralUser (TC_id) values('$tc_no')");
	$resultBettor = mysqli_query($connection, $queryBettor);
    $queryBettor = ("INSERT INTO Bettor (TC_id) values('$tc_no')");
	$resultBettor = mysqli_query($connection, $queryBettor);

	if(!$resultUser || !$resultBettor){ // is the user info inserted into the database?
		echo "Failed to create account.";
		return false;
		exit();
	}

	// if the database is updated successfully, display a message and start session
    $result = mysqli_query($connection, "select * from user where TC_id = '$tc_no'");
    $user_data = mysqli_fetch_assoc($result);

    // getting user information to use on other pages
    $_SESSION['tc_no'] = $user_data['TC_id'];
    $_SESSION['email'] = $user_data['email'];
    $_SESSION['username'] = $user_data['username'];
    $_SESSION['phone'] = $user_data['phone'];
    $_SESSION['dob'] = $user_data['date_of_birth'];
    $_SESSION['logged'] = true;

	echo "<script language='JavaScript'> window.alert('Succesfully created account!')</script>";
    header("Location: Wallet.php");    // change redirection according to what your teammates name the main page!!!
	return true;
}

function createEditor($tc_no, $email, $username, $phone, $dob, $password, $connection){

    // inserting the user into user table
	$queryUser = ("INSERT INTO User (TC_id, password, username, email, phone, date_of_birth) VALUES('$tc_no', '$password', '$username', '$email', '$phone', '$dob')");
    $resultUser = mysqli_query($connection, $queryUser);

    // inserting the user into editor table
    $queryEditor = ("INSERT INTO GeneralUser (TC_id) values('$tc_no')");
	$resultEditor = mysqli_query($connection, $queryEditor);
    $queryEditor = ("INSERT INTO Editor (TC_id) values('$tc_no')");
	$resultEditor = mysqli_query($connection, $queryEditor);

	if(!$resultUser || !$resultEditor){ // is the user info inserted into the database?
		echo "Failed to create account.";
		return false;
		exit();
	}

	// if the database is updated successfully, display a message and start session
    $result = mysqli_query($connection, "select * from user where TC_id = '$tc_no'");
    $user_data = mysqli_fetch_assoc($result);

    // getting user information to use on other pages
    $_SESSION['tc_no'] = $user_data['TC_id'];
    $_SESSION['email'] = $user_data['email'];
    $_SESSION['username'] = $user_data['username'];
    $_SESSION['phone'] = $user_data['phone'];
    $_SESSION['dob'] = $user_data['date_of_birth'];
    $_SESSION['logged'] = true;

	echo "<script language='JavaScript'> window.alert('Succesfully created account!')</script>"; 
    header("Location: Wallet.php");    // change redirection according to what your teammates name the main page!!!
	return true;
}

function createAdmin($tc_no, $email, $username, $phone, $dob, $password, $connection){

    // inserting the user into user table
	$queryUser = ("INSERT INTO User (TC_id, password, username, email, phone, date_of_birth) VALUES('$tc_no', '$password', '$username', '$email', '$phone', '$dob')");
    $resultUser = mysqli_query($connection, $queryUser);

    // inserting the user into admin table
    $queryAdmin = ("INSERT INTO Admin (TC_id) values('$tc_no')");
	$resultAdmin = mysqli_query($connection, $queryAdmin);

	if(!$resultUser || !$resultAdmin){ // is the user info inserted into the database?
		echo "Failed to create account.";
		return false;
		exit();
	}

	// if the database is updated successfully, display a message and start session
    $result = mysqli_query($connection, "select * from user where TC_id = '$tc_no'");
    $user_data = mysqli_fetch_assoc($result);

    // getting user information to use on other pages
    $_SESSION['tc_no'] = $user_data['TC_id'];
    $_SESSION['email'] = $user_data['email'];
    $_SESSION['username'] = $user_data['username'];
    $_SESSION['phone'] = $user_data['phone'];
    $_SESSION['dob'] = $user_data['date_of_birth'];
    $_SESSION['logged'] = true;

	echo "<script language='JavaScript'> window.alert('Succesfully created account!')</script>"; 
    header("Location: Wallet.php");    // change redirection according to what your teammates name the main page!!!
	return true;
}

function createWallet($tc_no, $connection){

    // inserting new wallet into the wallet table
	$queryWallet = ("INSERT INTO Wallet (TC_id, wallet_id, real_currency, app_currency) VALUES('$tc_no', '$tc_no', 0, 10)");
    $resultWallet = mysqli_query($connection, $queryWallet);
	if(!$resultWallet){ // is the wallet info inserted into the database?
		echo "Failed to create wallet.";
		return false;
		exit();
	}
	return true;
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

function createLotteryTicket($TC_id, $lottery_id, $connection){
	$win = random_int(0, 1000000);
	$id = 1;
	$last = "select ticket_id from LotteryTicket where ticket_id = '".$id."'";
	$res = mysqli_query($connection, $last);

	while(mysqli_num_rows($res) > 0){
		$id = $id + 1;
		$last = "select ticket_id from LotteryTicket where ticket_id = '".$id."'";
		$res = mysqli_query($connection, $last);
	}
	$q1 = "INSERT INTO LotteryTicket(ticket_id, lottery_id, reward) VALUES('" . $id ."','" . $lottery_id ." ', '" . $win ." ') ";
	
	$res1 = mysqli_query($connection, $q1);
	if(!$res1){
		echo "<script language='JavaScript'> window.alert('Failed to create lottery ticket')";
		//exit();
	}
	else{
		$q2 = "INSERT INTO BettorBoughtTicket(ticket_id, lottery_id, bettor_id, ticket_purchase_date) VALUES('" . $id ." ', '" . $lottery_id ." ','" . $TC_id ." ', cast(now() as date))";
		$res2 = mysqli_query($connection, $q2);
		if(!$res2){
			echo "Failed to create bettorboughtticket";
			exit();
		}
	}
	
}
?>
