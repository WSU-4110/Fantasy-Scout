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
$Organizations = mysqli_query($con,$getOrgs);
$Analysts = mysqli_query($con,$getAnalysts);

// FIND BEST AND WORST SCORES
// Find best/worst organization/analyst
$bestOrg = mysqli_fetch_array($Organizations);
while ($row = mysqli_fetch_array($Organizations)) {
    $worstOrg = mysqli_fetch_array($Organizations);
}
$bestAnalyst = mysqli_fetch_array($Analysts);
while ($row = mysqli_fetch_array($Analysts)) {
    $worstAnalyst = mysqli_fetch_array($Analysts);
}

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
    $bestIDtype = "orgID"
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
if (mysqli_query($con,$S)) {
    echo "Best score assigned to $bestIDtype: $bestID<br><br>";
}
else {
    echo "Best score NOT assigned to $bestIDtype: $bestID! Error: ".mysqli_error()."<br><br>";
}
if (mysqli_query($con,$F)) {
    echo "Worst score assigned to $bestIDtype: $bestID<br><br>";
}
else {
    echo "Worst score NOT assigned to $bestIDtype: $bestID! Error: ".mysqli_error()."<br><br>";
}

// calculate A-E grading scale, and within those scales calculate +- scales
// Find next best and next worst score
$nextbestOrg = $Organizations[1];
$nextworstOrg = $Organizations[sizeof($Organizations)-2];
$nextbestAnalyst = $Analysts[1];
$nextworstAnalyst = $Analysts[sizeof($Analysts)-2];
if ($nextbestOrg["ratingN"] > $nextbestAnalyst["ratingN"]) {
    // Next best analyst has best score
    $nextbest = $nextbestAnalyst;
    $nextbestScore = $nextbestAnalyst["ratingN"];
    /*$bestTable = "Analysts";
    $bestID = $best["analystID"];
    $bestIDtype = "analystID";*/
}
elseif ($nextbestOrg["ratingN"] < $nextbestAnalyst["ratingN"]) {
    // Next best organization has best score
    $nextbest = $nextbestOrg;
    $nextbestScore = $nextbestOrg["ratingN"];
    /*$bestTable = "Organizations";
    $bestID = $best["orgID"];*/
}
else {
    // The scores are the same
}
if ($nextworstOrg["ratingN"] < $nextworstAnalyst["ratingN"]) {
    // Next worst analyst has worst score
    $nextworst = $nextworstAnalyst;
    $nextworstScore = $nextworstAnalyst["ratingN"];
    /*$worstTable = "Analysts";
    $worstID = $worst["analystID"];
    $worstIDtype = "analystID";*/
}
elseif ($nextworstOrg["ratingN"] > $nextworstAnalyst["ratingN"]) {
    // Next worst organization has worst score
    $nextworst = $nextworstOrg;
    $nextworstScore = $nextworstOrg["ratingN"];
    /*$worstTable = "Organizations";
    $worstID = $worst["orgID"];*/
}
else {
    // The scores are the same
}
// Calculate difference between next best and next worst score
$range = $nextworstScore - $nextbestScore;
$grade = $range/5;


// ***CLOSE CONNECTION WITH SERVER***
if (mysqli_close($con)) {
  echo "Connection to database: FSDB successfully closed.";
}

?>
