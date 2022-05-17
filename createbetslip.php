<?php
    session_start();
    include "config.php";
    $con = $connection;
    $rate = $_POST['rate'];
    $count = count($_POST["formMatch"]);
    // find available slip id
    $id = 0;
    $query = "SELECT slip_id FROM Betslip WHERE slip_id = '".$id."'";
    $res = mysqli_query($connection, $query);
    while(mysqli_num_rows($res) > 0){
        $id = $id + 1;
        $query = "SELECT comment_id FROM Comment WHERE comment_id = '".$id."'";
        $res = mysqli_query($connection, $query); 
    }

    // create slip
    $query = "INSERT INTO Betslip(slip_id,no_of_bets,rate) VALUES('".$id."', '".count($_POST["formMatch"])."', '".$rate."')";
    $res = mysqli_query($connection, $query);

    $query = "INSERT INTO EditorPreparesSlip(slip_id,editor_id) VALUES('".$id."', '".$_SESSION['TC_id']."')";
    $res = mysqli_query($connection, $query);

    for($i = 0; $i < count($_POST["formMatch"]); $i++) {
        $values = $_POST["formMatch"][$i];
        list($mid, $btype) = explode("-", $values, 2);
        $query = "INSERT INTO SlipHasBet(slip_id,match_id,bet_type) VALUES('".$id."', '".$mid."', '".$btype."')";
        $res = mysqli_query($connection, $query);
    }
    header("Location: betslips.php");
    exit(); 
?>