<<?php

// Database onnection script
require 'init.php';

// User login variables
$username = "test_username";
$password = "test_password";
$email = "user_@test.com";

// ***DEFINE QUERY STRINGS***
// Query string to register new user
$reg = "
  INSERT INTO Accounts (email, username, password, regDate)
  VALUES ('$email', '$username', '$password', CURRENT_DATE());
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
