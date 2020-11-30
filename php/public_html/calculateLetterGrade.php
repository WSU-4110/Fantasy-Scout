<?php

$require 'init.php';


// Get all all organizations and all analysts.
$getOrgs = "
    SELECT *
    FROM Organizations
    ORDER BY ratingN ASC;
";
$getAnalysts = "
    SELECT *
    FROM Analysts
    ORDER BY ratingN ASC;
";
$Organizations = mysqli_fetch_array(mysqli_query($con,$getOrgs));
$Analysts = mysqli_fetch_array(mysqli_query($con,$getAnalysts));

// FIND BEST AND WORST SCORES
// Find best/worst organization/analyst
$bestOrg = $Organizations[0];
$worstOrg = $Organizations[sizeof($Organizations)-1];
$bestAnalyst = $Analysts[0];
$worstAnalyst = $Analysts[sizeof($Analysts)-1];

// From the best/worst org/analyst, determine which is the best and which is the worst
// Find best
if ($bestOrg["ratingN"] > $bestAnalyst["ratingN"]) {
    // Best analyst has best score
    $best = $bestAnalyst;
    $bestScore = $bestAnalyst["ratingN"];
    $bestTable = "Analysts";
    $bestID = $best["analystID"];
    $bestIDtype = "analystID";
}
elseif ($bestOrg["ratingN"] < $bestAnalyst["ratingN"]) {
    // Best organization has best score
    $best = $bestOrg;
    $bestScore = $bestOrg["ratingN"];
    $bestTable = "Organizations";
    $bestID = $best["orgID"];
}
else {
    // The scores are the same
}
// Find worst
if ($worstOrg["ratingN"] < $worstAnalyst["ratingN"]) {
    // worst analyst has worst score
    $worst = $worstAnalyst;
    $worstScore = $worstAnalyst["ratingN"];
    $worstTable = "Analysts";
    $worstID = $worst["analystID"];
    $worstIDtype = "analystID";
}
elseif ($worstOrg["ratingN"] > $worstAnalyst["ratingN"]) {
    // worst organization has worst score
    $worst = $worstOrg;
    $worstScore = $worstOrg["ratingN"];
    $worstTable = "Organizations";
    $worstID = $worst["orgID"];
    $worstIDtype = "orgID";
}
else {
    // The scores are the same
}

// ASSIGN S TO BEST AND F TO WORST
$S = "
    UPDATE $bestTable
    SET ratingC = 'S'
    WHERE $bestIDtype = $bestID;
";
$F = "
    UPDATE $worstTable
    SET ratingC = 'F'
    WHERE $worstIDtype = $worstID;
";

// calculate A-E grading scale, and within those scales calculate +- scales




// ***CLOSE CONNECTION WITH SERVER***
if (mysqli_close($con)) {
  echo "Connection to database: FSDB successfully closed.";
}

?>
