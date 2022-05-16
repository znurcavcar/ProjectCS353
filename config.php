<?php
    $dbhost =  'localhost';
    $user = 'root';
    $password = '26dqr543';
    $dbname = 'betman';

    $connection = mysqli_connect($dbhost, $user, $password, $dbname);

    if(!$connection)
	    die("Failed to connect to the database.");

    mysqli_select_db( $connection, $dbname);

    // USER
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE User");
    }
    catch(exception $e){
        $exists = false;
    }

    if( $exists == false ){
        $query = "CREATE TABLE User (
            TC_id INT NOT NULL , 
            password VARCHAR(20) NOT NULL, 
            username VARCHAR(30) NOT NULL, 
            email VARCHAR(100) NOT NULL, 
            phone INT NOT NULL, 
            date_of_birth DATE NOT NULL,
            PRIMARY KEY (TC_id))";
        $table = mysqli_query($connection, $query);
    }

    // GENERAL USER
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE GeneralUser");
    }
    catch(exception $e){
        $exists = false;
    }

    if( $exists == false ){
        $query = "CREATE TABLE GeneralUser (
            TC_id INT NOT NULL,
            PRIMARY KEY (TC_id),
            FOREIGN KEY (TC_id) REFERENCES User (TC_id))";
        $table = mysqli_query($connection, $query);
    }

    // ADMIN
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE Admin");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE Admin (
            TC_id INT NOT NULL,
            PRIMARY KEY (TC_id),
            FOREIGN KEY (TC_id) REFERENCES User (TC_id))";
        $table = mysqli_query($connection, $query);
    }

    // Bettor
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE Bettor");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE Bettor (
            TC_id INT NOT NULL,
            PRIMARY KEY (TC_id),
            FOREIGN KEY (TC_id) REFERENCES GeneralUser (TC_id))";
        $table = mysqli_query($connection, $query);
    }

    // Editor
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE Editor");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE Editor (
            TC_id INT NOT NULL,
            success_rate FLOAT,
            PRIMARY KEY (TC_id),
            FOREIGN KEY (TC_id) REFERENCES GeneralUser (TC_id))";
        $table = mysqli_query($connection, $query);
    }

    // Wallet
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE Wallet");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE Wallet (
            TC_id INT NOT NULL,
            wallet_id INT NOT NULL,
            real_currency FLOAT,
            app_currency FLOAT, 
            PRIMARY KEY (TC_id, wallet_id),
            FOREIGN KEY (TC_id) REFERENCES Bettor (TC_id))";
        $table = mysqli_query($connection, $query);
    }

    // Match / Game
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE Game");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE Game (
            match_id INT NOT NULL,
            match_type VARCHAR(20) NOT NULL, 
            match_date DATE NOT NULL,
            match_result VARCHAR(20),
            PRIMARY KEY (match_id))";
        $table = mysqli_query($connection, $query);
    }

    // Team
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE Team");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE Team (
            team_id INT NOT NULL,
            team_name VARCHAR(30) NOT NULL, 
            win_rate FLOAT,
            PRIMARY KEY (team_id))";
        $table = mysqli_query($connection, $query);
    }

    // Teams Playing
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE TeamsPlaying");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE TeamsPlaying (
            host_id INT NOT NULL, 
            guest_id INT NOT NULL, 
            match_id INT NOT NULL,
            PRIMARY KEY (match_id),
            FOREIGN KEY (host_id) REFERENCES Team (team_id),
            FOREIGN KEY (guest_id) REFERENCES Team (team_id),
            FOREIGN KEY (match_id) REFERENCES Game (match_id))";
        $table = mysqli_query($connection, $query);
    }

    // BetSlip
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE BetSlip");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE BetSlip (
            slip_id INT NOT NULL,
            no_of_bets INT,
            rate INT,
            PRIMARY KEY (slip_id))";
        $table = mysqli_query($connection, $query);
    }

    // EditorPreparesSlip
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE EditorPreparesSlip");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE EditorPreparesSlip (
            slip_id INT NOT NULL,
            editor_id INT NOT NULL,
            PRIMARY KEY (slip_id),
            FOREIGN KEY (slip_id) REFERENCES BetSlip (slip_id),
            FOREIGN KEY (editor_id) REFERENCES Editor (TC_id))";
        $table = mysqli_query($connection, $query);
    }

    // Bet
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE Bet");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE Bet(
            match_id INT NOT NULL,
            bet_type VARCHAR(20) NOT NULL, 
            bet_name VARCHAR(20), 
            MBN INT NOT NULL, 
            odds FLOAT NOT NULL,
            PRIMARY KEY (match_id, bet_type),
            FOREIGN KEY (match_id) REFERENCES Game (match_id))";
        $table = mysqli_query($connection, $query);
    }

    // SlipHasBet
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE SlipHasBet");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE SlipHasBet (
            slip_id INT NOT NULL,
            match_id INT NOT NULL, 
            bet_type VARCHAR(20) NOT NULL,
            PRIMARY KEY (slip_id, match_id, bet_type),
            FOREIGN KEY (match_id, bet_type) REFERENCES Bet (match_id, bet_type),
            FOREIGN KEY (slip_id) REFERENCES BetSlip (slip_id),
            FOREIGN KEY (match_id) REFERENCES Game (match_id))";
        $table = mysqli_query($connection, $query);
    }

    // BettorOwnsSlip
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE BettorOwnsSlip ");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE BettorOwnsSlip (
            bettor_id INT NOT NULL,
            slip_id INT NOT NULL,
            PRIMARY KEY (slip_id),
            FOREIGN KEY (slip_id) REFERENCES BetSlip (slip_id),
            FOREIGN KEY (bettor_id) REFERENCES Bettor (TC_id))";
        $table = mysqli_query($connection, $query);
    }

    // BettorMakesBet 
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE BettorMakesBet");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE BettorMakesBet (
            bettor_id INT NOT NULL,
            match_id INT NOT NULL, 
            bet_type VARCHAR(20) NOT NULL, 
            bet_date DATE NOT NULL, 
            amount FLOAT,
            PRIMARY KEY (bettor_id, match_id, bet_type),
            FOREIGN KEY (bettor_id) REFERENCES Bettor (TC_id),
            FOREIGN KEY (match_id) REFERENCES Game (match_id),
            FOREIGN KEY (match_id, bet_type) REFERENCES Bet (match_id, bet_type))";
        $table = mysqli_query($connection, $query);
    }

    // BettorFollowsEditor 
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE BettorFollowsEditor");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE BettorFollowsEditor (
            bettor_id INT NOT NULL, 
            editor_id INT NOT NULL,
            PRIMARY KEY(bettor_id, editor_id),
            FOREIGN KEY (bettor_id) REFERENCES Bettor (TC_id),
            FOREIGN KEY (editor_id) REFERENCES Editor (TC_id))";
        $table = mysqli_query($connection, $query);
    }

    // Lottery 
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE Lottery");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE Lottery (
            lottery_id INT NOT NULL,
            lottery_start_date DATE NOT NULL,
            lottery_end_date DATE NOT NULL,
            PRIMARY KEY(lottery_id))";
        $table = mysqli_query($connection, $query);
    }

    // LotteryTicket 
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE LotteryTicket");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE LotteryTicket ( 
            ticket_id INT NOT NULL, 
            lottery_id INT NOT NULL, 
            reward FLOAT,
            PRIMARY KEY(ticket_id, lottery_id),
            FOREIGN KEY (lottery_id) REFERENCES Lottery (lottery_id))";
        $table = mysqli_query($connection, $query);
    }

    // BettorBoughtTicket  
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE BettorBoughtTicket");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE BettorBoughtTicket (
            ticket_id INT NOT NULL,
            lottery_id INT NOT NULL, 
            bettor_id INT NOT NULL, 
            ticket_purchase_date DATE,
            PRIMARY KEY(ticket_id, lottery_id),
            FOREIGN KEY (ticket_id,lottery_id) REFERENCES LotteryTicket (ticket_id,lottery_id),
            FOREIGN KEY (bettor_id) REFERENCES Bettor (TC_id))";
        $table = mysqli_query($connection, $query);
    }

    // Comment  
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE Comment");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE Comment (
            comment_id INT NOT NULL,
            TC_id INT NOT NULL, 
            comment_date DATE, 
            contents VARCHAR(500),
            PRIMARY KEY( comment_id ),
            FOREIGN KEY (TC_id) REFERENCES GeneralUser (TC_id))";
        $table = mysqli_query($connection, $query);
    }

    // CommentOnSlip  
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE CommentOnSlip");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE CommentOnSlip (
            comment_id INT NOT NULL, 
            slip_id INT NOT NULL,
            PRIMARY KEY(comment_id, slip_id),
            FOREIGN KEY (comment_id) REFERENCES Comment (comment_id),
            FOREIGN KEY (slip_id) REFERENCES BetSlip (slip_id))";
        $table = mysqli_query($connection, $query);
    }

    // CommentOnMatch  
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE CommentOnMatch");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE CommentOnMatch (
            comment_id INT NOT NULL, 
            match_id INT NOT NULL,
            PRIMARY KEY(comment_id, match_id),
            FOREIGN KEY (comment_id) REFERENCES Comment (comment_id),
            FOREIGN KEY (match_id) REFERENCES Game (match_id))";
        $table = mysqli_query($connection, $query);
    }

    // Friend  
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE Friend");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE Friend (
            TC_id INT NOT NULL,
            friend_id INT NOT NULL,
            PRIMARY KEY(TC_id, friend_id),
            FOREIGN KEY (TC_id) REFERENCES Bettor (TC_id),
            FOREIGN KEY (friend_id) REFERENCES Bettor (TC_id))";
        $table = mysqli_query($connection, $query);
    }

    // UserLikesSlip 
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE UserLikesSlip");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE UserLikesSlip (
            TC_id INT NOT NULL,
            slip_id INT NOT NULL,
            PRIMARY KEY(TC_id, slip_id),
            FOREIGN KEY (TC_id) REFERENCES GeneralUser (TC_id),
            FOREIGN KEY (slip_id) REFERENCES BetSlip (slip_id))";
        $table = mysqli_query($connection, $query);
    }

    // UserSharesSlip 
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE UserSharesSlip");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE UserSharesSlip (
            TC_id INT NOT NULL,
            slip_id INT NOT NULL,
            PRIMARY KEY(TC_id, slip_id),
            FOREIGN KEY (TC_id) REFERENCES GeneralUser (TC_id),
            FOREIGN KEY (slip_id) REFERENCES BetSlip (slip_id))";
        $table = mysqli_query($connection, $query);
    }

    // BetRemovedByAdmin 
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE BetRemovedByAdmin");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE BetRemovedByAdmin (
            TC_id INT NOT NULL, 
            match_id INT NOT NULL, 
            bet_type VARCHAR(20) NOT NULL, 
            removal_date DATE,
            PRIMARY KEY(TC_id, match_id, bet_type),
            FOREIGN KEY (TC_id) REFERENCES Admin (TC_id),
            FOREIGN KEY (match_id, bet_type) REFERENCES Bet (match_id, bet_type))";
        $table = mysqli_query($connection, $query);
    }

    // BetChangedByAdmin  
    $exists = true;
    try{
        $result = mysqli_query($connection, "DESCRIBE BetChangedByAdmin");
    }
    catch(exception $e){
        $exists = false;
    }
        
    if( $exists == false ){
        $query = "CREATE TABLE BetChangedByAdmin (
            TC_id INT NOT NULL, 
            match_id INT NOT NULL, 
            bet_type VARCHAR(20) NOT NULL, 
            change_date DATE,
            new_odd FLOAT,
            PRIMARY KEY(TC_id, match_id, bet_type),
            FOREIGN KEY (TC_id) REFERENCES Admin (TC_id),
            FOREIGN KEY (match_id, bet_type) REFERENCES Bet (match_id, bet_type))";
        $table = mysqli_query($connection, $query);
    }
?>