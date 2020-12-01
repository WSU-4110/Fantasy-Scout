<<?php

// Database onnection script
require 'init.php';



// User login variables
$username = $_POST["myUname"];
$bio = $_POST["myBio"];
/*$fname = $_POST["myFname"];
$lname = $_POST["myLname"];
$phone = $_POST["myPhone"];*/



// ***DEFINE QUERY STRINGS***
// Query string to register new user
/*
INSERT INTO Accounts (username, password, email, fname, lname, phone, regDate)
VALUES ('$username', '$password', '$email', '$fname', '$lname', '$phone', CURRENT_DATE());
*/

$reg = "UPDATE Accounts SET username='$username', email='$bio' WHERE acctID=1";




// ***UPDATE USER***
if (mysqli_query($con, $reg)) {
  //user account successfully updated
  echo "Account updated<br>Username: $username<br>Bio: $bio<br>Success!<br><br>";
} else {
  // New user account creation failed
  echo "ERROR! " . mysqli_error($con);
}



// Close connection to Database
mysqli_close($con);

?>
