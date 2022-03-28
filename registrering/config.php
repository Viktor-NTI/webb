<?php
// Slå på fel rapporteing
ini_set("display_errors", 1);
error_reporting(E_ALL);

//Uppgifter för databasen, användare, lösenord
$användare = "bloggen_db";
$lösenord = "g!jsy6qd5IyzlU(0";
$dbNamn = "bloggen_db";
$host = "localhost";

// Logga in
$conn = new mysqli($host, $användare, $lösenord, $dbNamn);

//Check connection
if ($conn->connect_errno) {
    die("You died. " . $conn->connect_errno);
} else {
    //echo "<p>You didn't die! Poggie Woggie</p>";
}
?>