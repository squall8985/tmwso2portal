<?php
include ("../../../DBConn/connectionInfo.php");
require_once('../../../functions/auth.php');

// Parameters
$id = $_POST["record_id"];
$status = $_POST["status"];
$statusTemp = false;

if ($status == "Enable") {
    $statusTemp = 0;
} else {
    $statusTemp = 1;
}

if(!$conn) {
    die('Could not connect: ' . mysql_error());
}

$sql = "UPDATE SP_USERS SET status=$statusTemp".
       " WHERE id=$id";

$exec = mysqli_query($conn, $sql);

if (!$exec) {
    $msg= "SQL : " . $sql . " ERROR : " . mysqli_error($conn);
    echo $msg;
}

mysqli_close();
?>