<?php

// Establish connection using init
require init.php

// Create Positions Table
$posTbl = '
CREATE TABLE Positions(
  posID VARCHAR(4) NOT NULL PRIMARY KEY,
  pos VARCHAR(20)
);';

// Create Week table
$posTbl = '
CREATE TABLE IF NOT EXISTS Week (
  weekID INT(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  weekNum INT(2) UNSIGNED NOT NULL,
  year INT(4) UNSIGNED NOT NULL,
  strtMnth INT(2) NOT NULL,
  strtDay INT(2) NOT NULL,
  endMnth INT(2) NOT NULL,
  endDay INT(2) NOT NULL
 );';

 // Create Teams Table
$teamsTbl = '
CREATE TABLE IF NOT EXISTS Teams(
  teamID INT(2) UNSIGNED PRIMARY KEY,
  teamName VARCHAR(25),
  city VARCHAR(30),
  wins INT(2) UNSIGNED,
  losses INT(2) UNSIGNED,
  confr VARCHAR(20),
  divsn VARCHAR(20)
);';

// Create Players table
$playersTbl = '
CREATE TABLE IF NOT EXISTS Players (
  playerID INT(6) NOT NULL UNSIGNED AUTO_INCREMENT,
  fname VARCHAR(35),
  lname VARCHAR(35),
  posID VARCHAR(4) NOT NULL FOREIGN KEY (posID) REFERENCES Positions(posID),
  teamID INT(2) UNSIGNED NOT NULL FOREIGN KEY REFERENCES Teams(teamID),
  avgRank INT(5) UNSIGNED,
  year INT(4) UNSIGNED,
  gamesPlayed INT(2) UNSIGNED NOT NULL,
  week01Rank INT(3) UNSIGNED,
  week02Rank INT(3) UNSIGNED,
  week03Rank INT(3) UNSIGNED,
  week04Rank INT(3) UNSIGNED,
  week05Rank INT(3) UNSIGNED,
  week06Rank INT(3) UNSIGNED,
  week07Rank INT(3) UNSIGNED,
  week08Rank INT(3) UNSIGNED,
  week09Rank INT(3) UNSIGNED,
  week10Rank INT(3) UNSIGNED,
  week11Rank INT(3) UNSIGNED,
  week12Rank INT(3) UNSIGNED,
  week13Rank INT(3) UNSIGNED,
  week14Rank INT(3) UNSIGNED,
  week15Rank INT(3) UNSIGNED,
  week16Rank INT(3) UNSIGNED,
  week17Rank INT(3) UNSIGNED,
  week18Rank INT(3) UNSIGNED,
  week19Rank INT(3) UNSIGNED,
  week20Rank INT(3) UNSIGNED
 );';

mysqli_close($con);
?>
