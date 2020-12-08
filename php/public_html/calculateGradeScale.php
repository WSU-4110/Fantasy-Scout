<?php

require 'init.php';

function getBest($table) {
    require 'init.php';
    $get = "
        SELECT *
        FROM $table
        ORDER BY ratingN ASC
    ";
    $result = mysqli_query($con,$get);
    $best = mysqli_fetch_array($result);

    return $best;
}
function getNextBest($table) {
    require 'init.php';
    $get = "
        SELECT *
        FROM $table
        ORDER BY ratingN ASC
    ";
    $result = mysqli_query($con,$get);
    $best = mysqli_fetch_array($result);
    $best = mysqli_fetch_array($result);

    return $best;
}

function getWorst($table) {
    require 'init.php';
    $get = "
        SELECT *
        FROM $table
        ORDER BY ratingN DESC
    ";
    $result = mysqli_query($con,$get);
    $worst = mysqli_fetch_array($result);

    return $worst;
}
function getNextWorst($table) {
    require 'init.php';
    $get = "
        SELECT *
        FROM $table
        ORDER BY ratingN DESC
    ";
    $result = mysqli_query($con,$get);
    $worst = mysqli_fetch_array($result);
    $worst = mysqli_fetch_array($result);

    return $worst;
}

function setBest($Bb,$idType) {
    require 'init.php';
    $bestID = $Bb["$idType"];
    $S = "
        UPDATE Organizations
        SET ratingC = 'S'
        WHERE orgID = $bestID;
    ";
    if (mysqli_query($con,$S)) {
        echo "Best score assigned to $idType: $bestID<br><br>";
        return true;
    }
    else {
        echo "Best score NOT assigned to $idType: $bestID! Error: ".mysqli_error()."<br><br>";
        return true;
    }
}
function setWorst($Ww,$idType) {
    require 'init.php';
    $worstID = $Ww["$idType"];
    $F = "
        UPDATE Organizations
        SET ratingC = 'F'
        WHERE $idType = $worstID;
    ";

    if (mysqli_query($con,$F)) {
        echo "Worst score assigned to $idType: $worstID<br><br>";
        return true;
    }
    else {
        echo "Worst score NOT assigned to $idType: $worstID! Error: ".mysqli_error()."<br><br>";
        return false;
    }
}

function scaleGrades($nextbestScore, $nextworstScore) {
    require 'init.php';
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
        SET Aceil = '$Aceil', A = '$A', Aminus = '$Aminus',
            Bceil = '$Bceil', B = '$B', Bminus = '$Bminus',
            Cceil = '$Cceil', C = '$C', Cminus = '$Cminus',
            Dceil = '$Dceil', D = '$D', Dminus = '$Dminus',
            Eceil = '$Eceil', E = '$E', Eminus = '$nextworstScore'
        WHERE globalID > 0;
    ";
    if (mysqli_query($con,$updateScale)) {
        echo "Global table successfully updated<br><br>";
        return true;
    }
    else {
        echo "Global table UNSUCCESSFULLY updated. ERROR: ".mysqli_error($con)."<br><br>";
        return false;
    }
}

$bestOrg = getBest("Organizations");
$worstOrg = getWorst("Organizations");
echo "Best organization id: ".$bestOrg["orgID"]."<br>";
echo "Worst organization id: ".$worstOrg["orgID"]."<br>";
setBest($bestOrg,"orgID");
setWorst($worstOrg,"orgID");

// ASSIGN S TO BEST AND F TO WORST


$nextbest = getNextBest("Organizations");
$nextworst = getNextWorst("Organizations");
echo "Next best organization id: ".$nextbest["orgID"]."<br>";
echo "Next worst organization id: ".$nextworst["orgID"]."<br>";

scaleGrades($nextbest["ratingN"], $nextworst["ratingN"]);

// ***CLOSE CONNECTION WITH SERVER***
if (mysqli_close($con)) {
  echo "Connection to database: FSDB successfully closed.";
}
?>
