<?php
$sql_details = array(
    "user" => getenv("DB_USER"),
    "pass" => getenv("DB_PASSWORD"),
    "db"   => getenv("DB_NAME"),
    "host" => getenv("DB_HOST")
);

$conn = mysqli_connect(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASSWORD"), getenv("DB_NAME"));

// Check connection
if ($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>