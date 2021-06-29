<?php
include ("../../../DBConn/connectionInfo.php");
require_once('../../../functions/auth.php');

$id = $_GET['id'];

$query = "SELECT DATE_FORMAT(created_timestamp, '%Y-%m-%d %H:%i:%s') as created_timestamp,
                 DATE_FORMAT(updated_timestamp, '%Y-%m-%d %H:%i:%s') as updated_timestamp,
                 DATE_FORMAT(last_login_timestamp, '%Y-%m-%d %H:%i:%s') as last_login_timestamp,
                 username,
                 name,
                 status
                 FROM SP_USERS
                 WHERE id = '".$id."'";

if ($result = mysqli_query($conn, $query)) {
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $res[] = $row;
        }
        
        echo json_encode($res);
        
        // Free result selection
        // mysqli_free_result($query);
        // mysqli_close($conn);
        
        exit();
    } else {
        echo "No records matching your query were found.";
    }
} else {
    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
}
?>