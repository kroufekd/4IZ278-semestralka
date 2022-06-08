<?php

/* localhost */

$servername = "127.0.0.1";
$username = "root";
$password = "";
$db_name = "db_swimsys";

/* server 

$servername = "127.0.0.1";
$username = "krod04";
$password = "EiCaih9oa7shae9ziz";   
$db_name = "krod04";
*/
// Create connection
$conn = new mysqli($servername, $username, $password, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>