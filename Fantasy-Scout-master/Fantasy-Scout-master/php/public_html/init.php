<?php
   // Initialize connection variables
   $server = "localhost";
   $user = "id15075449_fsmod";
   $pass = "I&/*bDN5P^JLB~RF";
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
      die("Failed to connect to MySQL: " . mysqli_connect_error() . "<br>");
   }
   echo "Connected Successfully to database: FSDB<br><br>";


?>
