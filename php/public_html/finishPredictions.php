<<?php

// Database connection script
require 'init.php';



// Week# is passed into script
$weekNum = $_POST["WeekNum"];
// From Week#, get WeekID
$getWeek = "
    SELECT *
    FROM Week
    WHERE weekNum = $weekNum;
";
$week = mysqli_fetch_array(mysqli_query($con,$getWeek));
$week = $week["weekID"];
// Format field name for week in Database
if ($weekNum < 10) {
    $weekField = "week0".$weekNum."Rank";
}
else {
    $weekField = "week"."$weekNum"."Rank";
}

// Get all predictions made for this week
$getPredictions = "
    SELECT *
    FROM Predictions
    WHERE weekID = '$week';
";
$Predictions = mysqli_query($con,$getPredictions);

// Loops through all predictions retrieved
while ($row = mysqli_fetch_array($Predictions)) {
    // Get rank of player that prediction is regarding
    $playerID = $row["playerID"];
    $getRank = "
        SELECT *
        FROM Players
        WHERE playerID = '$playerID';
    ";
    $Rank = mysqli_query($con,$getRank);
    $Rank = mysqli_fetch_array($Rank);
    $Rank = $Rank["$weekField"];

    // Calculate prediction diff from difference of result and predicted result
    $projRank = $row["projRank"];
    $diff = abs($Rank - $projRank);

    // Update prediction with result rank and diff value
    $predictionID = $row["predictionID"];
    $update = "
        UPDATE Predictions
        SET rank = $Rank, diff = $diff
        WHERE predictionID = $predictionID;
    ";
    if (mysqli_query($con,$update)) {
        echo "Prediction for week $weekNum successfully updated<br><br>";
    }
    else {
        echo "Prediction for week $weekNum UNSUCCESSFULLY updated<br><br>"; 
    }

}



// ***CLOSE CONNECTION WITH SERVER***
if (mysqli_close($con)) {
  echo "Connection to database: FSDB successfully closed.";
}

?>
