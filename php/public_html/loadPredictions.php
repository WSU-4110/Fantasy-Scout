<?php

// Establish connection to server using init
require 'init.php';



// Formatted .txt files to be loaded into database.
// First line contains table name, second line contains the PHP insert string
$files = array(
  "txt/examplepredictionfile1.txt",
  "txt/examplepredictionfile2.txt"
);



// For each file to be loaded, load the formatted .txt file into the database
for ($i = 0; $i < sizeof($files); $i++) {
  // Open the current file
  $file = fopen($files[$i], "r");

  // First line is the table name
  $table = fgets($file);
  // Second line contains week Number
  $weekNum = fgets($file);
  // fgets() adds 1 extra whitespace to end of weekNum which breaks formatting.
  // split string into array and ensure that weekNum contains only 2 digits with no whitespace
  $weekNum = str_split($weekNum);
  $weekNum = "$weekNum[0]"."$weekNum[1]";
  $week = "week".$weekNum."Rank";
  // Third line contains the data fields in the database that are being inserted into
  $insertString = fgets($file);



  // Read the rest of the file, each line until the end will contain data to be input into database
  while (!feof($file)) {
    // Values to be inserted into database
    $values = fgets($file);
    // .txt files may contain lines of whitespace at the end which will result in previous line being added multiple times.
    // If line of whitespace is detected, move to next file or end loop.
    if ($values == "") { continue; }

    // Place data fields into variables
    sscanf($values,"%s %s %s %s %s %s %s %s",$org,$Pfname,$Plname,$rank,$pos,$team,$analyFname, $analyLname);
    $existingPlayerCheck = "
      SELECT *
      FROM Players
      WHERE fname = '$fname' AND lname = '$lname';
    ";
    // CHECK TO SEE IF PLAYER ALREADY EXISTS. IF NOT, ADD THEM
    $playerExistsCheck = mysqli_query($con, $existingPlayerCheck);
    if ($playerExistsCheck) {
        $player = mysqli_fetch_array($playerExistsCheck);
    }
    else {
        $addPlayer = "
          INSERT INTO Players (fname, lname, position, team, gamesPlayed)
          VALUES ('$Pfname','$Plname','$pos','$team','0')
        ";
        $player = mysqli_fetch_array(mysqli_query($con,$addPlayer));
    }
    $playerID = $player["playerID"];
    // GET ORGANIZATION PARIMARY KEY
    $getOrgId = "
      SELECT *
      FROM Organizations
      WHERE name = '$org'
    ";
    $orgID = mysqli_fetch_array(mysqli_query($con,$getOrgId));
    $orgID = $orgID["orgID"];
    // IF ANALYST IS PROVIDED, GET ANALYST ID
    if ($analyFname != 'none') {
      $getAnalyId = "
        SELECT *
        FROM Analysts
        WHERE fname = '$analyFname' AND lname = '$analyLname'
      ";
      $analyID = mysqli_fetch_array(mysqli_query($con,$getAnalyId));
      $analyID = $analyID["analystID"];
    }


  }
  fclose($file);
}


// ***CLOSE CONNECTION WITH SERVER***
if (mysqli_close($con)) {
  echo "Connection to database: FSDB successfully closed.";
}
?>
