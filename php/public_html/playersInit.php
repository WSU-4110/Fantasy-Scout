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
   $posTbl = '
   CREATE TABLE IF NOT EXISTS Week (
	weekID INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    weekNum INT(2) UNSIGNED NOT NULL,
    year INT(4) UNSIGNED,
    strtMnth INT(2),
    strtDay INT(2),
    endMnth INT(2),
    endDay INT(2)
    );'; 

   mysqli_close($con); 
?>