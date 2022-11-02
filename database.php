<?php
    //CONNECT TO MYSQL DATABASE USING MYSQLI
 $servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password,'youcodescrumboard');

// Check connection
if ($conn->connect_error) {
  echo("Connection failed: " . $conn->connect_error);
}
echo ("Connected successfully");



    
?>