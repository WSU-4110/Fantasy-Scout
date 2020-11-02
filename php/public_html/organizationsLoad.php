<?php

// Establish connection to server using init
require 'init.php';



// ***MAKE SQL QUERY STRINGS***
// Make query to load ESPN org stats
$orgs = array(
  array("ESPN", "https://www.espn.com/fantasy/football/"),
  array("Fantasy Footballers", "https://www.thefantasyfootballers.com/"),
  array("NFL", "https://fantasy.nfl.com/"),
  array("Yahoo Sports", "https://sports.yahoo.com/")
);



// ***EXECUTE SQL QUERIES***

for ($i=0; $i < sizeof($orgs); $i++) {
  $name = $orgs[$i][0];
  $website = $orgs[$i][1];
  // NOTE: CHECK NOT WORKING!
  /*$check = "

  ";
  if (!mysqli_query($con, $check)) {*/
  // Organization record does not exist in database, add it
    $load = "
      INSERT INTO Organizations (name, website)
      VALUES ('$name', '$website');
    ";
    if (mysqli_query($con, $load)) {
      echo "Organization $name loaded successfully<br><br>";
    } else {
      echo "ORganization $name load FAILURE!:<br>" . mysqli_error($con) . "<br><br>";
    }
  }
  /*else {
    // Organization record already exists
    echo "Organization $name: $website already exists in database.<br><br>";
  }
}*/



// ***CLOSE CONNECTION WITH SERVER***
if (mysqli_close($con)) {
  echo "Connection to database: FSDB successfully closed.";
}
?>
