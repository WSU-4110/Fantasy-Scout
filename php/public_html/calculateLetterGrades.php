<?php

require 'init.php';

// param1 is standard deviation value to convert to letter grade
// param2 is primary key to be updated
// param3 is primary key type
function gradeLetter($score,$id,$idType) {
    require 'init.php';
    $getScale = "
        SELECT *
        FROM Global
        WHERE globalID > 0;
    ";
    $scale = mysqli_fetch_array(mysqli_query($con,$getScale));
    $Aceil = $scale["Aceil"]; $A = $scale["A"]; $Aminus = $scale["Aminus"];
    $Bceil = $scale["Bceil"]; $B = $scale["B"]; $Bminus = $scale["Bminus"];
    $Cceil = $scale["Cceil"]; $C = $scale["C"]; $Cminus = $scale["Cminus"];
    $Dceil = $scale["Dceil"]; $D = $scale["D"]; $Dminus = $scale["Dminus"];
    $Eceil = $scale["Eceil"]; $E = $scale["E"]; $Eminus = $scale["Eminus"];

    // If the score is less than the nextbestscore or greater than the nextworstscore, they have already been assigned an S or F, so skip
    if ($score < $Aceil OR $score > $Eminus) { }
    // GRADE A
    else {
        if ($score >= $Aceil AND $score < $Bceil ) {
            // A+
            if ($score >= $Aceil AND $score < $A) {
                $letterGrade = "A+";
            }
            // A
            elseif ($score >= $A AND $score < $Aminus) {
                $letterGrade = "A";
            }
            // A-
            else {
                $letterGrade = "A-";
            }
        }
        // GRADE B
        if ($score >= $Bceil AND $score < $Bceil ) {
            // B+
            if ($score >= $Bceil AND $score < $B) {
                $letterGrade = "B+";
            }
            // B
            elseif ($score >= $B AND $score < $Bminus) {
                $letterGrade = "B";
            }
            // B-
            else {
                $letterGrade = "B-";
            }
        }
        // GRADE C
        if ($score >= $Cceil AND $score < $Cceil ) {
            // C+
            if ($score >= $Cceil AND $score < $C) {
                $letterGrade = "C+";
            }
            // C
            elseif ($score >= $C AND $score < $Cminus) {
                $letterGrade = "C";
            }
            // C-
            else {
                $letterGrade = "C-";
            }
        }
        // GRADE D
        if ($score >= $Dceil AND $score < $Dceil ) {
            // D+
            if ($score >= $Dceil AND $score < $D) {
                $letterGrade = "D+";
            }
            // D
            elseif ($score >= $D AND $score < $Dminus) {
                $letterGrade = "D";
            }
            // D-
            else {
                $letterGrade = "D-";
            }
        }
        // GRADE E
        if ($score >= $Eceil AND $score < $Eceil ) {
            // E+
            if ($score >= $Eceil AND $score < $E) {
                $letterGrade = "E+";
            }
            // E
            elseif ($score >= $E AND $score < $Eminus) {
                $letterGrade = "E";
            }
            // E-
            else {
                $letterGrade = "E-";
            }
        }
        $assignGrade = "
            UPDATE Organizations
            SET ratingC = '$letterGrade'
            WHERE $idType = $id;
        ";
        if (mysqli_query($con,$assignGrade)) {
            echo "$letterGrade assigned to Organization with $idType = $id";
            return true;
        }
        else {
            echo "$letterGrade NOT assigned to Organization with $idType = $id! Error: ".mysqli_error();
            return false;
        }
    }

}

// Get all organizations and analysts
$getOrgs = "
    SELECT *
    FROM Organizations
    ORDER BY ratingN ASC;
";
$Organizations = mysqli_query($con,$getOrgs);


// Loop through all Organizations
while ($org = mysqli_fetch_array($Organizations)) {
    // Determine letter grade
    $scr = $org["ratingN"];
    $orgID = $org["orgID"];

    gradeLetter($scr, $orgID, "orgID");
}

// Loop through all Analysts
/*while ($analyst = mysqli_fetch_array($Analysts)) {
    // Determine letter grade
    $score = $analyst["ratingN"];
    $analystID = $analyst["analystID"];
    // If the score is less than the nextbestscore or greater than the nextworstscore, they have already been assigned an S or F, so skip
    if ($score < $nextbestScore OR $score > $nextworstScore) {continue;}
    // GRADE A
    if ($score >= $Aceil AND $score < $Bceil ) {
        // A+
        if ($score >= $Aceil AND $score < $A) {
            $letterGrade = "A+";
        }
        // A
        elseif ($score >= $A AND $score < $Aminus) {
            $letterGrade = "A";
        }
        // A-
        else {
            $letterGrade = "A-";
        }
    }
    // GRADE B
    if ($score >= $Bceil AND $score < $Bceil ) {
        // B+
        if ($score >= $Bceil AND $score < $B) {
            $letterGrade = "B+";
        }
        // B
        elseif ($score >= $B AND $score < $Bminus) {
            $letterGrade = "B";
        }
        // B-
        else {
            $letterGrade = "B-";
        }
    }
    // GRADE C
    if ($score >= $Cceil AND $score < $Cceil ) {
        // C+
        if ($score >= $Cceil AND $score < $C) {
            $letterGrade = "C+";
        }
        // C
        elseif ($score >= $C AND $score < $Cminus) {
            $letterGrade = "C";
        }
        // C-
        else {
            $letterGrade = "C-";
        }
    }
    // GRADE D
    if ($score >= $Dceil AND $score < $Dceil ) {
        // D+
        if ($score >= $Dceil AND $score < $D) {/
            $letterGrade = "D+";
        }
        // D
        elseif ($score >= $D AND $score < $Dminus) {
            $letterGrade = "D";
        }
        // D-
        else {
            $letterGrade = "D-";
        }
    }
    // GRADE E
    if ($score >= $Eceil AND $score < $Eceil ) {
        // E+
        if ($score >= $Eceil AND $score < $E) {
            $letterGrade = "E+";
        }
        // E
        elseif ($score >= $E AND $score < $Eminus) {
            $letterGrade = "E";
        }
        // E-
        else {
            $letterGrade = "E-";
        }
    }
    $assignGrade = "
        UPDATE Analysts
        SET ratingC = '$letterGrade'
        WHERE analystID = $analystID;
    ";
    if (mysqli_query($con,$assignGrade)) {
        echo "$letterGrade assigned to Analyst with analystID = $analystID";
    }
    else {
        echo "$letterGrade NOT assigned to Analyst with analystID = $analystID! Error: ".mysqli_error();
    }
}*/


// ***CLOSE CONNECTION WITH SERVER***
if (mysqli_close($con)) {
  echo "Connection to database: FSDB successfully closed.";
}

?>
