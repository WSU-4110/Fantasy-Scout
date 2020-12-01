<?php

require 'init.php';


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
$getWorstOrgs = "
    SELECT *
    FROM Organizations
    ORDER BY ratingN DESC;
";
$getWorstAnalysts = "
    SELECT *
    FROM Analysts
    ORDER BY ratingN DESC;
";
$Organizations = mysqli_query($con,$getOrgs);
$Analysts = mysqli_query($con,$getAnalysts);
$worstOrgs = mysqli_query($con,$getWorstOrgs);
$worstAnalysts = mysqli_query($con,$getWorstAnalysts);

// FIND BEST AND WORST SCORES
// Find best/worst organization/analyst
$bestOrg = mysqli_fetch_array($Organizations);
$nextbestOrg = mysqli_fetch_array($Organizations);
$worstOrg = mysqli_fetch_array($worstOrgs);
$nextworstOrg = mysqli_fetch_array($worstOrgs);
$bestAnalyst = mysqli_fetch_array($Analysts);
$nextbestAnalyst = mysqli_fetch_array($Analysts);
$worstAnalyst = mysqli_fetch_array($worstAnalysts);
$nextworstAnalyst = mysqli_fetch_array($worstAnalysts);

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
    $bestIDtype = "orgID";
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
// Calculate range of each grade
$grade = $range/5;
// Calculate grades from scores
$Aceil = $nextbestScore;
    $A = $Aceil + ($grade/3);
    $Aminus = $A + ($grade/3);
$Bceil = $Aceil + $grade;
    $B = $Bceil + ($grade/3);
    $Bminus = $B + ($grade/3);
$Cceil = $Bceil + $grade;
    $C = $Cceil + ($grade/3);
    $Cminus = $C + ($grade/3);
$Dceil = $Cceil + $grade;
    $D = $Dceil + ($grade/3);
    $Dminus = $D + ($grade/3);
$Eceil = $Dceil + $grade;
    $E = $Eceil + ($grade/3);
    $Eminus = $E + ($grade/3);

// Update grading scale in global table
$updateScale = "
    UPDATE Global
    SET Aceil = $Aceil, A = $A, Aminus = $Aminus,
        Bceil = $Bceil, B = $B, Bminus = $Bminus,
        Cceil = $Cceil, C = $C, Cminus = $Cminus,
        Dceil = $Dceil, D = $D, Dminus = $Dminus,
        Eceil = $Eceil, E = $E, Eminus = $Eminus,
    WHERE globalID > 0;
";
if (mysqli_query($con,$updateScale)) { echo "Global table successfully updated<br><br>"; }
else { echo "Global table UNSUCCESSFULLY updated<br><br>"; }
?>
