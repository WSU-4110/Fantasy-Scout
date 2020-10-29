<?php

// Establish connection to server using init
require 'init.php';



// ***MAKE SQL QUERY STRINGS***
// Make query to load teams
$teams = array(
  // ***NFC***
  // West
  array("Seahawks","Seattle","5","1","0","NFC","West"),
  array("Cardinals","Arizona","5","2","0","NFC","West"),
  array("Rams","Los Angeles","5","2","0","NFC","West"),
  array("49ers","San Francisco","4","3","0","NFC","West"),
  // North
  array("Packers","Green Bay","5","1","0","NFC","North"),
  array("Chicago","Bears","5","2","0","NFC","North"),
  array("Lions","Detroit","3","3","0","NFC","North"),
  array("Vikings","Minnesota","1","5","0","NFC","North"),
  // South
  array("Buccaneers","Tampa Bay","5","2","0","NFC","South"),
  array("Saints","New Orleans","4","2","0","NFC","South"),
  array("Panthers","Carolina","3","4","0","NFC","South"),
  array("Falcons","Atlanta","1","6","0","NFC","South"),
  // East
  array("Eagles","Philadelphia","2","4","1","NFC","East"),
  array("Football Team","Washington","2","5","0","NFC","East"),
  array("Cowboys","Dallas","2","5","0","NFC","East"),
  array("Giants","New York","1","6","0","NFC","East"),

  // ***AFC***
  // East
  array("Bills","Buffalo","5","2","0","AFC","East"),
  array("Dolphins","Miami","3","3","0","AFC","East"),
  array("Patriots","New England","2","4","0","AFC","East"),
  array("Jets","New York","0","7","0","AFC","East"),
  // North
  array("Steelers","Pittsburgh","6","0","0","AFC","North"),
  array("Ravens","Baltimore","5","1","0","AFC","North"),
  array("Browns","Cleveland","5","2","0","AFC","North"),
  array("Bengals","Cincinatti","1","5","1","AFC","North"),
  // South
  array("Titans","Tennessee","5","1","0","AFC","South"),
  array("Colts","Indianapolis","4","2","0","AFC","South"),
  array("Texans","Houston","1","6","0","AFC","South"),
  array("Jaguars","Jacksonville","1","6","0","AFC","South"),
  // West
  array("Chiefs","Kansas City","6","1","0","AFC","West"),
  array("Raiders","Las Vegas","3","3","0","AFC","West"),
  array("Chargers","Las Angeles","2","4","0","AFC","West"),
  array("Broncos","Denver","2","4","0","AFC","West"),
);



// ***EXECUTE SQL QUERIES***

for ($i=0; $i < sizeof($teams); $i++) {
  $name   = $teams[$i][0];
  $city   = $teams[$i][1];
  $wins   = $teams[$i][2];
  $losses = $teams[$i][3];
  $ties   = $teams[$i][4];
  $conf   = $teams[$i][5];
  $div    = $teams[$i][6];
  // NOTE: CHECK IS NOT WORKING!!!
  /*$check = "
    SELECT 1
    FROM teams
    WHERE pos = $pos;
  ";
  if (!mysqli_query($con, $check)) {*/
  // Position record does not exist in database, add it
    $load = "
      INSERT INTO Teams (teamName,city,wins,losses,ties,confr,divsn)
      VALUES ('$name', '$city', '$wins', '$losses', '$ties', '$conf', '$div');
    ";
    if (mysqli_query($con, $load)) {
      echo "Team $city $name loaded successfully into fsdb<br><br>";
    } else {
      echo "Team $city $name load FAILURE!:<br>" . mysqli_error($con) . "<br><br>";
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
