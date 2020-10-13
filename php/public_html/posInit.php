<?php 
   // Initialize connection variables
   $server = "localhost";
   $user = "id15075449_fsmod";
   $pass = "FSpasswordcsc4111^";
   $db = "id15075449_fsdb";

   //create connection 
   $con = mysqli_connect($server,$user,$pass,$db);
   // Check connection
   if (mysqli_connect_errno())
   {
      echo '<br>Server: ' . $server;
      echo '<br>Username:' . $user;
      echo '<br>Password: ' . $pass;
      echo '<br>Database: ' . $db . '<br>';
      die("Failed to connect to MySQL: " . mysqli_connect_error()); 
   }
   echo "Connected Successfully";
   
   // Create Positions Table Query String
   $posTbl = '
   CREATE TABLE Positions(
       posId VARCHAR(3) PRIMARY KEY,
       pos VARCHAR(20)
       );';  
   //Execute SQLi query
   if (mysqli_query($con, $posTbl)) {
       echo '<br>Positions table created successfully<br>';
   }
   else {
       echo '<br>Error creating positions table: ' . $con->error . '<br>';
   }
   
   // Populate Positions Table 
   mysqli_query($con,"INSERT INTO Positions(posId, pos) VALUES ('C', 'Center')");
   mysqli_query($con,"INSERT INTO Positions(posId, pos) VALUES ('OG', 'Offensive Guard')");
   mysqli_query($con,"INSERT INTO Positions(posId, pos) VALUES ('OT', 'Offensive Tackle')");
   mysqli_query($con,"INSERT INTO Positions(posId, pos) VALUES ('QB', 'Quarterback')");
   mysqli_query($con,"INSERT INTO Positions(posId, pos) VALUES ('HB', 'Halfback')");
   mysqli_query($con,"INSERT INTO Positions(posId, pos) VALUES ('FB', 'Fullback')");
   mysqli_query($con,"INSERT INTO Positions(posId, pos) VALUES ('WR', 'Wide receiver')");
   mysqli_query($con,"INSERT INTO Positions(posId, pos) VALUES ('TE', 'Tight end')");
   mysqli_query($con,"INSERT INTO Positions(posId, pos) VALUES ('DT', 'Defensive Tackle')");
   mysqli_query($con,"INSERT INTO Positions(posId, pos) VALUES ('DE', 'Defensive End')");
   mysqli_query($con,"INSERT INTO Positions(posId, pos) VALUES ('LB', 'Linebacker')");
   mysqli_query($con,"INSERT INTO Positions(posId, pos) VALUES ('CB', 'Cornerback')");
   mysqli_query($con,"INSERT INTO Positions(posId, pos) VALUES ('S', 'Safety')");
   mysqli_query($con,"INSERT INTO Positions(posId, pos) VALUES ('HB', 'Halfback')");
   mysqli_query($con,"INSERT INTO Positions(posId, pos) VALUES ('K', 'Kicker')");
   
   mysqli_close($con); 
?>