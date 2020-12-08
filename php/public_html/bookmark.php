<?php
// Start the session
session_start();

// Database onnection script
require 'init.php';



// User login variables
$acctID = $_SESSION['acctID'];
$orgID = $_POST["x"];


// ***DEFINE QUERY STRINGS***
// Query string to register new user
/*
INSERT INTO Accounts (username, password, email, fname, lname, phone, regDate)
VALUES ('$username', '$password', '$email', '$fname', '$lname', '$phone', CURRENT_DATE());
*/

$reg = "SELECT * FROM Bookmarks WHERE acctID = '$acctID' AND orgID = '$orgID'";


// ***UPDATE Bookmark***
if (mysqli_num_rows(mysqli_query($con, $reg)) != 0) { //toggled for deletion
    $reg = "DELETE FROM Bookmarks WHERE acctID = '$acctID' AND orgID = '$orgID'";
      if (mysqli_query($con, $reg)){
          header("Location: https://fantasyscout.000webhostapp.com/Fantasy-Scout/Fantasy%20Scouts%20Web%20App/index.html");
      }else{
          header("Location: https://fantasyscout.000webhostapp.com/Fantasy-Scout/Fantasy%20Scouts%20Web%20App/analyst.html");
      }
} else { //toggled for addition
    $reg = "INSERT INTO Bookmarks (acctID, orgID) VALUES ('$acctID', '$orgID')";
      if (mysqli_query($con, $reg)){
          header("Location: https://fantasyscout.000webhostapp.com/Fantasy-Scout/Fantasy%20Scouts%20Web%20App/index.html");
      }else{
          header("Location: https://fantasyscout.000webhostapp.com/Fantasy-Scout/Fantasy%20Scouts%20Web%20App/analyst.html");
      }
}

// Close connection to Database
mysqli_close($con);

?>
