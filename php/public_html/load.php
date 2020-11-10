<?php

// Establish connection to server using init
require 'init.php';



// ***MAKE SQL QUERY STRINGS***
// Make query to load teams
$teams = "loadTeams.txt";

$file = fopen($teams);

$table = fgets($file);
$insertString = fgets($file);

// ***EXECUTE SQL QUERIES***

while (!feof($file)) {
  $values = fgets($file);
  $load = "
    INSERT INTO $table ($insertString)
    VALUES ($values);
  ";
  if (mysqli_query($con, $load)) {
    echo "Team loaded successfully into fsdb<br><br>";
  } else {
    echo "Team load FAILURE!:<br>" . mysqli_error($con) . "<br><br>";
  }
}



// ***CLOSE CONNECTION WITH SERVER***
if (mysqli_close($con)) {
  echo "Connection to database: FSDB successfully closed.";
}
?>
