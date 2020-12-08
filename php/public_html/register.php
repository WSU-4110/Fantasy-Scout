<?php
//Start Session
session_start();
// Database onnection script
require 'init.php';



// User login variables
$username = $_POST["myUname"];
$email = $_POST["myEmail"];
$password = $_POST["myPword"];
/*$fname = $_POST["myFname"];
$lname = $_POST["myLname"];
$phone = $_POST["myPhone"];*/



// ***DEFINE QUERY STRINGS***
// Query string to register new user
/*
INSERT INTO Accounts (username, password, email, fname, lname, phone, regDate)
VALUES ('$username', '$password', '$email', '$fname', '$lname', '$phone', CURRENT_DATE());
*/
$reg = "
  INSERT INTO Accounts (username, password, email, regDate)
  VALUES ('$username', '$password', '$email', CURRENT_DATE());
";



// ***REGISTER USER***
if (mysqli_query($con, $reg)) {
      $logincheck = "
      SELECT acctID
      FROM Accounts
      WHERE username = '$username' AND password = '$password' OR email = '$username' AND password = '$password';
    ";
    $res = mysqli_query($con, $logincheck);
    $row = mysqli_fetch_assoc($res);
    $_SESSION['acctID'] = $row['acctID'];
  header("Location: https://fantasyscout.000webhostapp.com/Fantasy-Scout/Fantasy%20Scouts%20Web%20App/index.html");
} else {
  // New user account creation failed
  header("Location: https://fantasyscout.000webhostapp.com/Fantasy-Scout/Fantasy%20Scouts%20Web%20App/login.html");
}



// Close connection to Database
mysqli_close($con);

?>
