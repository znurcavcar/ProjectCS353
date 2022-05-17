<?php
    session_start();
    include "config.php";
    include "functions.php";
    $con = $connection;
    
    /*
    $query = "WITH chosenmatch(match_id) AS (SELECT match_id FROM Game WHERE match_type='Football')
            SELECT M.match_id AS mid, COUNT(*) AS c1
            FROM chosenmatch AS M, CommentOnMatch AS CM, Comment AS C
            WHERE M.match_id = CM.match_id AND CM.comment_id =C.comment_id 
            AND C.TC_id = '987654321' GROUP BY M.match_id";
    $complist = mysqli_query($connection, $query);
    while($tuple = mysqli_fetch_array($complist)) {
        $tmp1 = $tuple['mid'];
        $tmp2 = $tuple['c1'];

        echo("Match ID - ".$tmp1."\n");
        echo("Count - ".$tmp2."\n");
    }
    $query = "INSERT INTO Lottery(lottery_id, lottery_start_date, lottery_end_date) VALUES(1, '2022-06-12 18:00:00', '2022-06-12 18:00:00')";
    $complist = mysqli_query($connection, $query);
    $query = "INSERT INTO LotteryTicket(ticket_id, lottery_id, reward) VALUES(1, 1, 10)";
    $complist = mysqli_query($connection, $query);
    $query = "INSERT INTO BettorBoughtTicket(ticket_id, lottery_id, bettor_id,ticket_purchase_date) VALUES(1, 1, 987654321, NULL)";
    $complist = mysqli_query($connection, $query);
    $query = "INSERT INTO LotteryTicket(ticket_id, lottery_id, reward) VALUES(2, 1, 150)";
    $complist = mysqli_query($connection, $query);
    $query = "INSERT INTO BettorBoughtTicket(ticket_id, lottery_id, bettor_id,ticket_purchase_date) VALUES(2, 1, 987654321, NULL)";
    $complist = mysqli_query($connection, $query);
    $query = "INSERT INTO LotteryTicket(ticket_id, lottery_id, reward) VALUES(3, 1, 0)";
    $complist = mysqli_query($connection, $query);
    $query = "INSERT INTO BettorBoughtTicket(ticket_id, lottery_id, bettor_id,ticket_purchase_date) VALUES(3, 1, 987654321, NULL)";
    $complist = mysqli_query($connection, $query);
    $query = "INSERT INTO LotteryTicket(ticket_id, lottery_id, reward) VALUES(4, 1, 50)";
    $complist = mysqli_query($connection, $query);
    $query = "INSERT INTO BettorBoughtTicket(ticket_id, lottery_id, bettor_id,ticket_purchase_date) VALUES(4, 1, 987654321, NULL)";
    $complist = mysqli_query($connection, $query);
    $query = "INSERT INTO LotteryTicket(ticket_id, lottery_id, reward) VALUES(5, 1, 0)";
    $complist = mysqli_query($connection, $query);
    $query = "INSERT INTO BettorBoughtTicket(ticket_id, lottery_id, bettor_id,ticket_purchase_date) VALUES(5, 1, 987654321, NULL)";
    $complist = mysqli_query($connection, $query);*/

    $query = "SELECT COUNT(*) AS c1
            FROM BettorBoughtTicket AS BT, (SELECT ticket_id, lottery_id FROM LotteryTicket WHERE reward BETWEEN 0 AND 100) AS LT
            WHERE LT.ticket_id = BT.ticket_id AND LT.lottery_id = BT.lottery_id AND BT.bettor_id = '987654321'";
    $complist = mysqli_query($connection, $query);
    while($tuple = mysqli_fetch_array($complist)) {
        $tmp1 = $tuple['c1'];

        echo("Number of times user won money from the lottery but less than 100 TL  - ".$tmp1."\n");
    }

?>