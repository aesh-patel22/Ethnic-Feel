<?php
$servername = "localhost";
$username = "root"; // change if needed
$password = ""; // change if needed
$dbname = "ethnic_store";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
