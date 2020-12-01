<<?php

// Database onnection script
require 'init.php';



// User login variables
//$acctID = $_POST["acctID"];
$orgID = $_POST["x"];


// ***DEFINE QUERY STRINGS***
// Query string to register new user
/*
INSERT INTO Accounts (username, password, email, fname, lname, phone, regDate)
VALUES ('$username', '$password', '$email', '$fname', '$lname', '$phone', CURRENT_DATE());
*/

$reg = "SELECT * FROM Bookmarks WHERE acctID = 1 AND orgID = '$orgID'";




// ***UPDATE Bookmark***
if (mysqli_num_rows(mysqli_query($con, $reg)) != 0) { //toggled for deletion
    $reg = "DELETE FROM Bookmarks WHERE acctID = 1 AND orgID = '$orgID'";
      if (mysqli_query($con, $reg)){
          echo "succesful deletion";
      }else{
          echo "failure to complete deletion";
      }
} else { //toggled for addition
    $reg = "INSERT INTO Bookmarks (acctID, orgID) VALUES (1, '$orgID')";
      if (mysqli_query($con, $reg)){
          echo "succesful addition";
      }else{
          echo "failure to complete addition";
      }
}



// Close connection to Database
mysqli_close($con);

?>
