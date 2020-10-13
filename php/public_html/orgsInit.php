<?php 
   // Initialize connection variables
   $server = "localhost";
   $user = "id15075449_fsmod";
   $pass = "FSpasswordcsc4111^";
   $db = "id14771451_data";

   //create connection 
   $con=mysqli_connect($server,$userName,$pass,$db);
   // Check connection
   if (mysqli_connect_errno())
   {
      echo "Failed to connect to MySQL: " . mysqli_connect_error(); 
   }
   // Create Players Table
   $posTbl = '
   CREATE TABLE IF NOT EXISTS Players (
	playerID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(35),
    lname VARCHAR(35),
    FOREIGN KEY (posID),
    totalPts INT(5) UNSIGNED,
    ptsperGame INT(3) UNSIGNED,
    year INT(4) UNSIGNED,
    gamesPlayed INT(2) UNSIGNED,
    FOREIGN KEY (teamID),
    week01Pts INT(3) UNSIGNED, 
    week02Pts INT(3) UNSIGNED, 
    week03Pts INT(3) UNSIGNED, 
    week04Pts INT(3) UNSIGNED, 
    week05Pts INT(3) UNSIGNED, 
    week06Pts INT(3) UNSIGNED, 
    week07Pts INT(3) UNSIGNED, 
    week08Pts INT(3) UNSIGNED, 
    week09pts INT(3) UNSIGNED, 
    week10Pts INT(3) UNSIGNED, 
    week11Pts INT(3) UNSIGNED, 
    week12Pts INT(3) UNSIGNED, 
    week13Pts INT(3) UNSIGNED, 
    week14Pts INT(3) UNSIGNED, 
    week15Pts INT(3) UNSIGNED, 
    week16Pts INT(3) UNSIGNED, 
    week17Pts INT(3) UNSIGNED, 
    week18Pts INT(3) UNSIGNED, 
    week19Pts INT(3) UNSIGNED, 
    week20Pts INT(3) UNSIGNED
    );'; 

   mysqli_close($con); 
?>