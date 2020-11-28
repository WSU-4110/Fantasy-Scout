<?php

// Establish connection using init
require 'init.php';

// Make query to create Positions Table
$posTbl = '
CREATE TABLE Positions(
  posID VARCHAR(4) NOT NULL PRIMARY KEY,
  pos VARCHAR(20)
);';

// Make query to create Week table
$weekTbl = '
CREATE TABLE IF NOT EXISTS Week (
  weekID INT(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  weekNum INT(2) UNSIGNED NOT NULL,
  year INT(4) UNSIGNED NOT NULL,
  strtMnth INT(2) NOT NULL,
  strtDay INT(2) NOT NULL,
  endMnth INT(2) NOT NULL,
  endDay INT(2) NOT NULL
 );';

 // Make query to create Accounts table
 $acctTbl = '
 CREATE TABLE IF NOT EXISTS Accounts (
   acctID INT(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   username VARCHAR(20) NOT NULL,
   password VARCHAR(20) NOT NULL,
   email VARCHAR(30) NOT NULL,
   fname VARCHAR(20),
   lname VARCHAR(25),
   regDate INT(8) NOT NULL,
   phone INT(14),
   UNIQUE(username),
   UNIQUE(email)
  );';

 // Make query to create Teams Table
$teamsTbl = '
CREATE TABLE IF NOT EXISTS Teams(
  teamID CHAR(3) NOT NULL PRIMARY KEY,
  teamName VARCHAR(25),
  city VARCHAR(30),
  wins INT(2) UNSIGNED,
  losses INT(2) UNSIGNED,
  ties INT(2) UNSIGNED,
  confr VARCHAR(20),
  divsn VARCHAR(20)
);';

// Make query to create players table
$playersTbl = '
CREATE TABLE IF NOT EXISTS Players (
  playerID INT(6) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  fname VARCHAR(35),
  lname VARCHAR(35),
  posID VARCHAR(4) NOT NULL,
  FOREIGN KEY (posID) REFERENCES Positions(posID),
  teamID CHAR(3) NOT NULL,
  FOREIGN KEY (teamID) REFERENCES Teams(teamID),
  avgRank DOUBLE(5,2) UNSIGNED,
  year INT(4) UNSIGNED,
  gamesPlayed INT(2) UNSIGNED NOT NULL DEFAULT 0,
  week01Rank INT(2) UNSIGNED DEFAULT NULL,
  week02Rank INT(2) UNSIGNED,
  week03Rank INT(2) UNSIGNED,
  week04Rank INT(2) UNSIGNED,
  week05Rank INT(2) UNSIGNED,
  week06Rank INT(2) UNSIGNED,
  week07Rank INT(2) UNSIGNED,
  week08Rank INT(2) UNSIGNED,
  week09Rank INT(2) UNSIGNED,
  week10Rank INT(2) UNSIGNED,
  week11Rank INT(2) UNSIGNED,
  week12Rank INT(2) UNSIGNED,
  week13Rank INT(2) UNSIGNED,
  week14Rank INT(2) UNSIGNED,
  week15Rank INT(2) UNSIGNED,
  week16Rank INT(2) UNSIGNED,
  week17Rank INT(2) UNSIGNED,
  week18Rank INT(2) UNSIGNED,
  week19Rank INT(2) UNSIGNED,
  week20Rank INT(2) UNSIGNED
 );';

 // Make query to create organizations table
 $orgsTbl = '
 CREATE TABLE IF NOT EXISTS Organizations (
   orgID INT(3) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(40) NOT NULL UNIQUE,
   website VARCHAR(50) NOT NULL UNIQUE
 );';

// Make query to create Analysts TABLE
$anlTbl = '
CREATE TABLE IF NOT EXISTS Analysts (
   analystID INT(4) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   fname VARCHAR(35),
   lname VARCHAR(35),
   orgID INT(3) UNSIGNED NOT NULL,
   FOREIGN KEY (orgID) REFERENCES Organizations(orgID),
   ratingN INT(4) UNSIGNED,
   ratingC VARCHAR(2)
);';

// Make query to create Predictions TABLE
$predTbl = '
CREATE TABLE IF NOT EXISTS Predictions (
   predictionID INT(7) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
   analystID INT(4) UNSIGNED,
   FOREIGN KEY (analystID) REFERENCES Analysts(analystID),
   weekID INT(5) UNSIGNED NOT NULL,
   FOREIGN KEY (weekID) REFERENCES Week(weekID),
   playerID INT(6) UNSIGNED NOT NULL,
   FOREIGN KEY (playerID) REFERENCES Players(playerID),
   posID VARCHAR(4) NOT NULL,
   FOREIGN KEY (posID) REFERENCES Positions(posID),
   orgID INT(3) UNSIGNED NOT NULL,
   FOREIGN KEY (orgID) REFERENCES Organizations(orgID),
   projRank INT(2) UNSIGNED NOT NULL,
   rank INT(2) UNSIGNED,
   diff INT(2) UNSIGNED
);';

// EXECUTE CREATE QUERIES

// Position Table Creation
 if (mysqli_query($con, $posTbl)) {
   echo "Positions Table Created Successfully<br><br>";
 } else {
   echo "Positions Table Creation FAILED!:<br>" . mysqli_error($con) . '<br><br>';;
 }
// Week Table Creation
if (mysqli_query($con, $weekTbl)){
  echo "Week Table Created Successfully<br><br>";
} else {
  echo "Week Table Creation FAILED!:<br>" . mysqli_error($con) . '<br><br>';;
}
// Account Table Creation
if (mysqli_query($con, $acctTbl)){
  echo "Accounts Table Created Successfully<br><br>";
} else {
  echo "Accounts Table Creation FAILED!:<br>" . mysqli_error($con) . '<br><br>';;
}
// Teams Table Creation
if (mysqli_query($con, $teamsTbl)){
  echo "Teams Table Created Successfully<br><br>";
} else {
  echo "Teams Table Creation FAILED!:<br>" . mysqli_error($con) . '<br><br>';;
}
// Players Table Creation
if (mysqli_query($con, $playersTbl )){
  echo "Players Table Created Successfully<br><br>";
} else {
  echo "Players Table Creation FAILED!:<br>" . mysqli_error($con) . '<br><br>';
}
// Organizations table creation
if (mysqli_query($con, $orgsTbl)){
  echo "Organizations Table Created Successfully<br><br>";
} else {
  echo "Organizations Table Creation FAILED!:<br>" . mysqli_error($con) . '<br><br>';
}
// Position Table Creation
if (mysqli_query($con, $anlTbl)) {
  echo "Analyst Table Created Successfully<br><br>";
} else {
  echo "Analyst Table Creation FAILED!:<br>" . mysqli_error($con) . '<br><br>';
}
// Position Table Creation
if (mysqli_query($con, $predTbl)) {
  echo "Predictions Table Created Successfully<br><br>";
} else {
  echo "Predictions Table Creation FAILED!:<br>" . mysqli_error($con) . '<br><br>';
}



// Close connection
mysqli_close($con);
?>
