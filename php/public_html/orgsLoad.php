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



// ***EXECUTE SQL QUERIES***

// ESPN
// Check if NFL already exists in Database
$check = "
  SELECT 1
  FROM Organizations
  WHERE name = 'ESPN';
";
if (!mysqli_query($con, $check)) {
// Execute ESPN load query
  if (mysqli_query($con, $loadESPN)) {
    echo "ESPN Table loaded successfully<br><br>";
  } else {
    echo "ESPN Table load FAILURE!:<br>" . mysqli_error() . "<br><br>";
  }
}
else {
  echo "Organization ESPN already exists in database.<br><br>";
}

// FANTASY FOOTBALLERS
// Check if Fantasy Footballers already exists in Database
$check = "
  SELECT 1
  FROM Organizations
  WHERE name = 'Fantasy Footballers';
";
if (!mysqli_query($con, $check)) {
  // Execute Fantasy Footballers load query
  if (mysqli_query($con, $loadFF)) {
    echo "Fantasy Footballers Table loaded successfully<br><br>";
  } else {
    echo "Fantasy Footballers Table load FAILURE!:<br>" . mysqli_error() . "<br><br>";
  }
}
else {
  echo "Organization Fantasy Footballers already exists in database.<br><br>";
}

// NFL
// Check if NFL already exists in Database
$check = "
  SELECT 1
  FROM Organizations
  WHERE name = 'NFL';
";
if (!mysqli_query($con, $check)) {
// Execute NFL load query
  if (mysqli_query($con, $loadNFL)) {
    echo "NFL Table loaded successfully<br><br>";
  } else {
    echo "NFL Table load FAILURE!:<br>" . mysqli_error() . "<br><br>";
  }
}
else {
    echo "Organization NFL already exists in database.<br><br>";
}

// YAHOO SPORTS
// Check if NFL already exists in Database
$check = "
  SELECT 1
  FROM Organizations
  WHERE name = 'Yahoo Sports';
";
if (!mysqli_query($con, $check)) {
// Execute Yahoo Sports load query
  if (mysqli_query($con, $loadYahoo)) {
    echo "Yahoo Table loaded successfully<br><br>";
  } else {
    echo "Yahoo Table load FAILURE!:<br>" . mysqli_error() . "<br><br>";
  }
}
else {
  echo "Organization Yahoo Sports alreadt exists in database.<br><br>";
}



// ***CLOSE CONNECTION WITH SERVER
mysqli_close($con);
?>
