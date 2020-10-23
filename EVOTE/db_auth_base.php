<?php


$servername = "localhost";

$username = "root";
$password = "";
$dbname = "sbsevote";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Unable to establish a secure connection with the server.");
 } 
 setlocale(LC_MONETARY, 'en_IN');
 date_default_timezone_set('Asia/Dubai');

?>
