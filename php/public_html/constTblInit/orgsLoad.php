<?php

require 'init.php';

$loadESPN = '
INSERT INTO Organizations (name, website)
VALUES ("ESPN","https://www.espn.com/fantasy/football/");';

$loadFF = '
INSERT INTO Organizations (name, website)
VALUES ("Fantasy Footballers","https://www.thefantasyfootballers.com/");';

$loadNFL = '
INSERT INTO Organizations (name, website)
VALUES ("NFL","https://fantasy.nfl.com/");';

$loadYahoo = '
INSERT INTO Organizations (name, website)
VALUES ("Yahoo Sports","https://sports.yahoo.com/");';

if (mysqli_query($con, $loadESPN)) {
  echo "ESPN Table loaded successfully<br><br>";
} else {
  echo "ESPN Table load FAILURE!:<br>" . mysqli_error() . "<br><br>";
}

if (mysqli_query($con, $loadFF)) {
  echo "Fantasy Footballers Table loaded successfully<br><br>";
} else {
  echo "Fantasy Footballers Table load FAILURE!:<br>" . mysqli_error() . "<br><br>";
}

if (mysqli_query($con, $loadNFL)) {
  echo "NFL Table loaded successfully<br><br>";
} else {
  echo "NFL Table load FAILURE!:<br>" . mysqli_error() . "<br><br>";
}

if (mysqli_query($con, $loadYahoo)) {
  echo "Yahoo Table loaded successfully<br><br>";
} else {
  echo "Yahoo Table load FAILURE!:<br>" . mysqli_error() . "<br><br>";
}

mysqli_close();
?>
