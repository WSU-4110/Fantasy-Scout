<<?php

// Database onnection script
require 'init.php';

// User login variables
$user = "";
$pass = "";
$email = "";

// ***DEFINE QUERY STRINGS***
// Query string to check if account with identical email or username exists
$regcheck = "
  SELECT (
    SELECT accID
    FROM Accounts
    WHERE username = $user OR email = $email;
    ) AS accID
"
// Query string to register new user
$reg = "
  INSERT INTO Accounts (email, username, password)
  VALUES ($email, $user, $pass);
";



// ***REGISTER USER***
if (!mysqli_query($con, $regcheck)) {
// Register check DID NOT find record with identical username or password, so user can register.
// Execute new user registration
  if (mysqli_query($con, $reg)) {
    // New user account successfully registered
    echo "New account with login credentials<br>Email: $Email<br>Username: $user<br>Password: $pass<br>Welcome!<br><br>";
  } else {
    // ERROR! New user could not be created
      echo "ERROR!: New user could not be created: " . mysqli_error($con) . "<br><br>";
  }

}

  

// Close connection to Database
mysqli_close($con);

?>
