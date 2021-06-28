<?php
include ("../../../DBConn/connectionInfo.php");
require_once('../../../functions/auth.php');

// Parameters
$username = $_POST["username"];
$name = $_POST["name"];
$password = $_POST["password"];

$role_dashboard = $_POST["role_dashboard"];
if (!isset($role_dashboard)) { $role_dashboard = 0; }

$role_business = $_POST["role_business"];
if (!isset($role_business)) { $role_business = 0; }

$role_online = $_POST["role_online"];
if (!isset($role_online)) { $role_online = 0; }

$role_sms = $_POST["role_sms"];
if (!isset($role_sms)) { $role_sms = 0; }

$role_query = $_POST["role_query"];
if (!isset($role_query)) { $role_query = 0; }

$role_user_management= $_POST["role_user_management"];
if (!isset($role_user_management)) { $role_user_management = 0; }

$role_batch = $_POST["role_batch"];
if (!isset($role_batch)) { $role_batch = 0; }

if(!$conn) {
    die('Could not connect: ' . mysql_error());
}

$sql = "INSERT INTO SP_USERS (name, username, password, role_dashboard, role_business_event, role_online, role_batch, role_sms, role_query, role_user_management) values ". 
       "('$name', ".
       "'$username', ".
       "'$password', ".
       "$role_dashboard, ".
       "$role_business, ".
       "$role_online, ".
       "$role_batch, ".
       "$role_sms, ".
       "$role_query, ".
       "$role_user_management)";

$exec = mysqli_query($conn, $sql);

if (!$exec) {
    $msg= "SQL : " . $sql . " ERROR : " . mysqli_error($conn);
    echo $msg;
}

mysqli_close();
?>