<<?php

// Database onnection script
require 'init.php';

// User login variables
$username = "test_username1";
$password = "test_password";



// ***DEFINE QUERY STRINGS***
// Query string to check if account with identical email or username exists
$logincheck = "
  SELECT acctID
  FROM Accounts
  WHERE username = '$username' OR email = '$username' AND password = '$password';
";
$login = mysqli_num_rows(mysqli_query($con, $logincheck));



// ***LOGIN USER***
if ($login) {
// Login found record with idential username or email AND identical password
// Login Successful
echo "Account $username successfully logged in.<br><br>";
} else {
  // ERROR! New user could not be created
  echo "User with those login credentials<br>Username: $username<br>Password: $password<br>could not be found. Please try again.<br><br>" . mysqli_error($con);
}



// Close connection to Database
mysqli_close($con);

?>
