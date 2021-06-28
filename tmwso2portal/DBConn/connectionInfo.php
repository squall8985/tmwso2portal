<?php
// SQL server connection information
$sql_details = array(
    "user" => "wso_app",
    "pass" => "",
    "db"   => "Pswd2019",
    "host" => "172.20.196.182"
);

$conn = mysqli_connect("localhost","root","","tmportal");

// Check connection
if ($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>