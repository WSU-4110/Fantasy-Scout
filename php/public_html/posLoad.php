<?php

// Establish connection to server using init
require 'init.php';



// ***MAKE SQL QUERY STRINGS***
// Make query to load ESPN org stats
$positions = array(
  array("QB", "Quarterback"),
  array("RB", "Runningback"),
  array("WR", "Wide receiver"),
  array("TE", "Tight end"),
  array("DEF", "Defense"),
  array("K", "Kicker"),
  array("SPC", "Special teams")
);



// ***EXECUTE SQL QUERIES***

for ($i=0; $i < sizeof($positions); $i++) {
  $posID = $positions[$i][0];
  $pos = $positions[$i][1];
  // NOTE: CHECK IS NOT WORKING!!!
  /*$check = "
    SELECT 1
    FROM Positions
    WHERE pos = $pos;
  ";
  if (!mysqli_query($con, $check)) {*/
  // Position record does not exist in database, add it
    $load = "
      INSERT INTO Positions (posID, pos)
      VALUES ('$posID', '$pos');
    ";
    if (mysqli_query($con, $load)) {
      echo "Position $posID loaded successfully<br><br>";
    } else {
      echo "Position $pos load FAILURE!:<br>" . mysqli_error($con) . "<br><br>";
    }
  }
  /*else {
    // Position record already exists
    echo "Position $posID: $pos already exists in database.<br><br>";
  }
}*/



// ***CLOSE CONNECTION WITH SERVER***
if (mysqli_close($con)) {
  echo "Connection to database: FSDB successfully closed.";
}
?>
