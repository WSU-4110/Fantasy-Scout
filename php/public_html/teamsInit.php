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
   // Create Positions Table
   $teamsTbl = '
   CREATE TABLE IF NOT EXISTS Teams(
    teamID INT(2) UNSIGNED PRIMARY KEY,
    teamName VARCHAR(25),
    city VARCHAR(30),
    wins INT(2) UNSIGNED,
    losses INT(2) UNSIGNED,
    confr VARCHAR(20),
    divsn VARCHAR(20)
    );';

   mysqli_close($con); 
?>