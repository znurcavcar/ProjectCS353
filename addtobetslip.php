<?php
    session_start();
    include "config.php";
    $con = $connection;
    $sid = $_POST['slip'];
    
    $query = "INSERT INTO BettorOwnsSlip(bettor_id,slip_id) VALUES ('".$_SESSION['TC_id']."', '".$sid."')";
    $table = mysqli_query($con, $query);
    header("Location: betslips.php");
    exit(); 
?>