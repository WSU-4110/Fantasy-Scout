<<?php

// Database onnection script
require 'init.php';

// User login variables
$user = "";
$pass = "";

// ***DEFINE QUERY STRINGS***
// Query string to check if account with identical email or username exists
$logincheck = "
  SELECT (
    SELECT accID
    FROM Accounts
    WHERE username = $user OR email = $user AND password = $pass;
    ) AS accID
"



// ***LOGIN USER***
if (mysqli_query($con, $logincheck)) {
// Login found record with idential username or email AND identical password
// Login Successful
echo "Account $user successfully logged in.<br><br>";
} else {
  // ERROR! New user could not be created
  echo "User with those login credentials could not be found.<br>Please try again.<br><br>";
}



// Close connection to Database
mysqli_close($con);

?>
