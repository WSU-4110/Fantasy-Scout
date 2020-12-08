<?php
// Start the session
session_start();

// Database onnection script
require 'init.php';

// User login variables
$username = $_POST["myUname"];
$password = $_POST["myPword"];


// ***DEFINE QUERY STRINGS***
// Query string to check if account with identical email or username exists
$logincheck = "
  SELECT acctID
  FROM Accounts
  WHERE username = '$username' AND password = '$password' OR email = '$username' AND password = '$password';
";
$login = mysqli_num_rows(mysqli_query($con, $logincheck));

// ***LOGIN USER***
if ($login) {
// Login found record with idential username or email AND identical password
// Login Successful
    $res = mysqli_query($con, $logincheck);
    $row = mysqli_fetch_assoc($res);
    $_SESSION['acctID'] = $row['acctID'];
    header("Location: https://fantasyscout.000webhostapp.com/Fantasy-Scout/Fantasy%20Scouts%20Web%20App/index.html");
} else {
  // ERROR! New user could not be created
  header("Location: https://fantasyscout.000webhostapp.com/Fantasy-Scout/Fantasy%20Scouts%20Web%20App/register.html");
}



// Close connection to Database
mysqli_close($con);

?>
