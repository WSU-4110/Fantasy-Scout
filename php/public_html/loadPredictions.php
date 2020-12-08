<?php

// Establish connection to server using init
require 'init.php';



// Formatted .txt files to be loaded into database.
// First line contains table name, second line contains the PHP insert string
$files = array(
  "txt/week12predictions/bb10.txt",
  "txt/week12predictions/draftKings.txt",
  "txt/week12predictions/espn.txt",
  "txt/week12predictions/fanTrax.txt",
  "txt/week12predictions/yDaily.txt"
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
  if ($weekNum < 10) {
      // If weeknum is less than 10, format it to 1 digit
      $weekNum = "$weekNum[1]";
  }
  else {
      $weekNum = "$weekNum[0]"."$weekNum[1]";
  }
  // Third line contains the data fields in the database that are being inserted into
  $insertString = fgets($file);


  $successes = 0;
  $failures = 0;
  // Read the rest of the file, each line until the end will contain data to be input into database
  while (!feof($file)) {
    // Values to be inserted into database
    $values = fgets($file);
    // .txt files may contain lines of whitespace at the end which will result in previous line being added multiple times.
    // If line of whitespace is detected, move to next file or end loop.
    if ($values == "") { continue; }

    // Place data fields into variables
    sscanf($values,"%s %s %s %s %s %s %s %s",$org,$Pfname,$Plname,$rank,$pos,$team,$analyFname,$analyLname);
    $existingPlayerCheck = "
      SELECT *
      FROM Players
      WHERE fname = '$Pfname' AND lname = '$Plname';
    ";
    // CHECK TO SEE IF PLAYER ALREADY EXISTS. IF NOT, ADD THEM
    $playerExistsCheck = mysqli_query($con, $existingPlayerCheck);
    // Player exists
    if ($playerExistsCheck) {
        $player = mysqli_fetch_array($playerExistsCheck);
    }
    // Player doesn't exist
    /*else {
        $addPlayer = "
          INSERT INTO Players (fname, lname, position, team, gamesPlayed)
          VALUES ('$Pfname','$Plname','$pos','$team','0');
        ";
        $player = mysqli_fetch_array(mysqli_query($con,$addPlayer));
    }*/
    // Get the player's primary key
    $playerID = $player["playerID"];

    // GET ORGANIZATION PARIMARY KEY
    $getOrgId = "
      SELECT *
      FROM Organizations
      WHERE name = '$org';
    ";
    $orgID = mysqli_fetch_array(mysqli_query($con,$getOrgId));
    $orgID = $orgID["orgID"];

    // IF ANALYST IS PROVIDED, GET ANALYST ID
    /*if ($analyFname != 'none') {
      $getAnalyId = "
        SELECT *
        FROM Analysts
        WHERE fname = '$analyFname' AND lname = '$analyLname';
      ";
      // Get analyst
      $analyID = mysqli_fetch_array(mysqli_query($con,$getAnalyId));
      if ($analyID) {
          // If analyst exists, get the analyst ID
          $analyID = $analyID["analystID"];
          echo "AnalystID: $analyID successfully retrieved<br><br>";
      }
      else {
          // If analyst doesn't exist, add new analyst with relevant data
          $addAnalyst = "
            INSERT INTO Analysts (fname,lname,orgID)
            VALUES ('$analyFname','$analyLname','$orgID');
          ";
          mysqli_query($con,$addAnalyst);
          $analyID = mysqli_fetch_array(mysqli_query($con,$getAnalyId));
          $analyID = $analyID["analystID"];
          echo "AnalystID: $analyID successfully created and retrieved<br><br>";
      }
    }
    else { echo "No analyst for this prediction<br><br>"; }*/

    // GET WEEK PRIMARY KEY
    $weekID = $weekNum;

    // BUILD PREDICTION AND INSERT INTO database
    if ($analyFname == 'none') {
        // If analyst is not provided, insert without analystID
        $Prediction = "
            INSERT INTO $table (weekID, playerID, posID, orgID, teamID, projRank)
            VALUES ('$weekID', '$playerID', '$pos', '$orgID', '$team', '$rank');
        ";
        if (mysqli_query($con,$Prediction)) {
            $successes += 1;
        }
        else {
            $failures += 1;
        }
    }
    /*else {
        $Prediction = "
            INSERT INTO $table (weekID, playerID, posID, orgID, teamID, projRank, analystID)
            VALUES ('$weekID', '$playerID', '$pos', '$orgID', '$team', '$rank', '$analyID');
        ";
        if (mysqli_query($con,$Prediction)) {
            $successes += 1;
        }
        else {
            $failures += 1;
        }
    }*/

  }
  fclose($file);
  echo "Loop #: $i | Prediction load for organization with ID: $orgID<br>
     $successes predictions successfully loaded into database<br>
     $failures predictions unsuccessfully loaded into database<br><br>";
}


// ***CLOSE CONNECTION WITH SERVER***
if (mysqli_close($con)) {
  echo "Connection to database: FSDB successfully closed.";
}
?>
