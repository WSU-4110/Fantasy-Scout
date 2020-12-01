<?php

require 'init.php';

// param1: query string to obtain all predictions to be analyzed
function stdDev($Preds) {
    require 'init.php';
    // Query to get all predictions for this organization
    $Predictions = mysqli_query($con,$Preds);

    // Declare/reset variables for stdDev calulation
    $diffSum = 0; // Sum of all difference values
    $n = 0; // number of diffs summed
    $stdDev = 0; // Standard deviation value
    // TESTING
    echo "BEFORE:<br>    stdDev: $stdDev<br>    diffSum: $diffSum<br>    n: $n<br><br>";
    while ($pred = mysqli_fetch_array($Predictions)) {
        $diff = $pred["diff"];
        // Raise diff to power of 2 as per standard deviation equation
        $n += 1;
        $diffSum += ($diff**2);
    }
    // Divide summation of diff squares by n-1 then take square root, as per standard deviation equation.
    // Only do this if n > 1, since division by 0 is undefined. do not assign accuracy ranking for organizations with only 1 prediction.
    if ($n > 1) {
        $diffSum /= ($n-1);
        $stdDev = sqrt($diffSum);
    }
    echo "AFTER:<br>    stdDev: $stdDev<br>    diffSum: $diffSum<br>    n: $n<br><br>";
    return $stdDev;
}

// RANK ORGANIZATIONS
// get all organizations
$getOrganizations = "
    SELECT *
    FROM Organizations
    WHERE orgID > 0;
";
$Organizations = mysqli_query($con,$getOrganizations);

// Calculate numeric accuracy rank value (standard deviation) for each organization
while ($Organization = mysqli_fetch_array($Organizations)) {
    // get organization primary key
    $OrganizationID = $Organization["orgID"];
    // Query to get all predictions for this organization
    $P = "
        SELECT *
        FROM Predictions
        WHERE orgID = $OrganizationID;
    ";
    $Dev = stdDev($P);
    // Assign organization numeric ranking equal to that organization's standard deviation ($stdDev)
    $assignNumRank = "
        UPDATE Organizations
        SET ratingN = $Dev
        WHERE orgID = $OrganizationID;
    ";
    if (mysqli_query($con,$assignNumRank)) {
        echo "Organization with orgID = $OrganizationID successfully assigned standard deviation of $Dev<br><br>";
    }
    else {
        echo "Organization with orgID = $OrganizationID UNSUCCESSFULLY assigned standard deviation of $Dev. Error: ".mysqli_error()."<br><br>";
    }
}

/*
// RANK ANALYSTS
// get all analysts
$getAnalysts = "
    SELECT *
    FROM Analysts
    WHERE analystID > 0;
";
$analysts = mysqli_query($con,$getAnalysts);
// Calculate numeric accuracy rank value (standard deviation) for each analyst
while ($analyst = mysqli_fetch_array($analysts)) {
    // get analyst primary key
    $analystID = $analyst["analystID"];
    // Query to get all predictions for this analyst
    $Predictions = "
        SELECT *
        FROM Predictions
        WHERE analystID = $analystID;
    ";
    $Predictions = mysqli_query($con,$Predictions);
    // Sum all the diffs to be used in calculating standard deviation
    $diffSum = 0;
    // number of diffs summed
    $n = 0;
    $diff = 0;
    $stdDev = 0;
    while ($pred = mysqli_fetch_array($Predictions)) {
        $diff = $pred["diff"];
        // Raise diff to power of 2 as per standard deviation equation
        $n += 1;
        $diffSum += ($diff**2);
    }
    // Divide summation of diff squares by n-1 then take square root, as per standard deviation equation.
    // Only do this if n > 1, since division by 0 is undefined. do not assign accuracy ranking for organizations with only 1 prediction.
    if ($n > 1) {
        $diffSum /= ($n-1);
        $stdDev = sqrt($diffSum);
    }
    // Assign organization numeric ranking equal to that organization's standard deviation ($stdDev)
    $assignNumRank = "
        UPDATE Analysts
        SET ratingN = $stdDev
        WHERE orgID = $analystID;
    ";
    if (mysqli_query($con,$assignNumRank)) {
        echo "Analyst with analystID = $analystID successfully assigned standard deviation of $stdDev<br><br>";
    }
    else {
        echo "Analyst with analystID = $analystID UNSUCCESSFULLY assigned standard deviation of $stdDev. Error: ".mysqli_error()."<br><br>";
    }
}*/



// ***CLOSE CONNECTION WITH SERVER***
if (mysqli_close($con)) {
  echo "Connection to database: FSDB successfully closed.";
}

?>
