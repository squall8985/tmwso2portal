<?php
// SQL server connection information
$sql_details = array(
    "user" => "wso_app",
    "pass" => "Pswd2019",
    "db"   => "wso",
    "host" => "172.20.196.182"
);

$conn = mysqli_connect("172.20.196.182","wso_app","Pswd2019","wso");

// Check connection
if ($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>