<?php

// Establish connection to server using init
require 'init.php';



// ***MAKE SQL QUERY STRINGS***
// Make query to load ESPN org stats
$loadESPN = '
INSERT INTO Organizations (name, website)
VALUES ("ESPN","https://www.espn.com/fantasy/football/");';

// Make query to Load Fantasy Footballers org stats
$loadFF = '
INSERT INTO Organizations (name, website)
VALUES ("Fantasy Footballers","https://www.thefantasyfootballers.com/");';

// Make query to load NFL org stats
$loadNFL = '
INSERT INTO Organizations (name, website)
VALUES ("NFL","https://fantasy.nfl.com/");';

// Make query to load Yahoo Sports org stats
$loadYahoo = '
INSERT INTO Organizations (name, website)
VALUES ("Yahoo Sports","https://sports.yahoo.com/");';



// ***EXECUTE SQL QUERIES
// Execute ESPN load query
if (mysqli_query($con, $loadESPN)) {
  echo "ESPN Table loaded successfully<br><br>";
} else {
  echo "ESPN Table load FAILURE!:<br>" . mysqli_error() . "<br><br>";
}

// Execute Fantasy Footballers load query
if (mysqli_query($con, $loadFF)) {
  echo "Fantasy Footballers Table loaded successfully<br><br>";
} else {
  echo "Fantasy Footballers Table load FAILURE!:<br>" . mysqli_error() . "<br><br>";
}

// Execute NFL load query
if (mysqli_query($con, $loadNFL)) {
  echo "NFL Table loaded successfully<br><br>";
} else {
  echo "NFL Table load FAILURE!:<br>" . mysqli_error() . "<br><br>";
}

// Execute Yahoo Sports load query
if (mysqli_query($con, $loadYahoo)) {
  echo "Yahoo Table loaded successfully<br><br>";
} else {
  echo "Yahoo Table load FAILURE!:<br>" . mysqli_error() . "<br><br>";
}



// ***CLOSE CONNECTION WITH SERVER
mysqli_close($con);
?>
