<?php
// SQL server connection information
$sql_details = array(
    "user" => "root",
    "pass" => "",
    "db"   => "tmPortal",
    "host" => "localhost"
);

$conn = mysqli_connect("localhost","root","","tmportal");

// Check connection
if ($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>