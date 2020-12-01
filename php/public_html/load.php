<?php

// Establish connection to server using init
require 'init.php';



// Formatted .txt files to be loaded into database.
// First line contains table name, second line contains the PHP insert string
$files = array(
    "txt/loadTeams.txt",
    "txt/loadPos.txt",
    "txt/loadWeeks.txt",
    "txt/loadOrgs.txt"
);

// Create only record in global table
$insertGlobal = "
    INSERT INTO Global (currentWeek)
    VALUES ('12');
";
mysqli_query($con,$insertGlobal);

// For each file to be loaded, load the formatted .txt file into the database
for ($i = 0; $i < sizeof($files); $i++) {
    // Open the current file
    $file = fopen($files[$i], "r");

    // First line is the table name
    $table = fgets($file);
    // Second line contains the data fields in the database that are being inserted into
    $insertString = fgets($file);



    // Read the rest of the file, each line until the end will contain data to be input into database
    while (!feof($file)) {
        // Values to be inserted into database
        $values = fgets($file);
        // String to containing SQL INSERT statement to be executed on mysql database
        $load = "
            INSERT INTO $table ($insertString)
            VALUES ($values);
        ";
        if (mysqli_query($con, $load)) {
            echo "$table loaded successfully into fsdb<br><br>";
        }
        else {
            echo "$table load FAILURE!:<br>" . mysqli_error($con) . "<br><br>";
        }
    }
    fclose($file);
}


// ***CLOSE CONNECTION WITH SERVER***
if (mysqli_close($con)) {
  echo "Connection to database: FSDB successfully closed.";
}
?>
