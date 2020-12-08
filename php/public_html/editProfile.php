<?php
// Start the session
session_start();

// Database onnection script
require 'init.php';



// User login variables
$username = $_POST["myUname"];
$bio = $_POST["myBio"];
$acctID = $_SESSION['acctID'];
/*$fname = $_POST["myFname"];
$lname = $_POST["myLname"];
$phone = $_POST["myPhone"];*/



// ***DEFINE QUERY STRINGS***
// Query string to register new user
/*
INSERT INTO Accounts (username, password, email, fname, lname, phone, regDate)
VALUES ('$username', '$password', '$email', '$fname', '$lname', '$phone', CURRENT_DATE());
*/

$reg = "UPDATE Accounts SET username='$username', bio='$bio' WHERE acctID='$acctID'";


// ***UPDATE USER***
if (mysqli_query($con, $reg)) {
  //user account successfully updated
  header("Location: https://fantasyscout.000webhostapp.com/Fantasy-Scout/Fantasy%20Scouts%20Web%20App/index.html");
} else {
  //user account update failed
  header("Location: https://fantasyscout.000webhostapp.com/Fantasy-Scout/Fantasy%20Scouts%20Web%20App/settings.html");
}



// Close connection to Database
mysqli_close($con);

?>
