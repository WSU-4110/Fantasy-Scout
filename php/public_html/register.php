<<?php

// Database onnection script
require 'init.php';



// User login variables
$username = $_POST["myUname"];
$email = $_POST["myEmail"];
$password = $_POST["myPword"];
$fname = $_POST["myFname"];
$lname = $_POST["myLname"];
$phone = $_POST["myPhone"];



// ***DEFINE QUERY STRINGS***
// Query string to register new user
$reg = "
  INSERT INTO Accounts (username, password, email, fname, lname, phone, regDate)
  VALUES ('$username', '$password', '$email', '$fname', '$lname', '$phone', CURRENT_DATE());
";



// ***REGISTER USER***
if (mysqli_query($con, $reg)) {
  // New user account successfully registered
  echo "New account with login credentials successfully created<br>Email: $email<br>Username: $username<br>Password: $password<br>Welcome!<br><br>";
} else {
  // New user account creation failed
  echo "ERROR! " . mysqli_error($con);
}



// Close connection to Database
mysqli_close($con);

?>
