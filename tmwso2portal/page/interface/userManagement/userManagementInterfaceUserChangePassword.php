<?php
include ("../../../DBConn/connectionInfo.php");
require_once('../../../functions/auth.php');

// Parameters
$id = $_POST["id"];
$password = $_POST["password"];

if(!$conn) {
    die('Could not connect: ' . mysql_error());
}

$sql = "UPDATE SP_USERS SET password='$password'".
       " WHERE id=$id";

$exec = mysqli_query($conn, $sql);

if (!$exec) {
    $msg= "SQL : " . $sql . " ERROR : " . mysqli_error($conn);
    echo $msg;
}

// mysqli_close();
?>