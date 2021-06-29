<?php
include ("../../../DBConn/connectionInfo.php");
require_once('../../../functions/auth.php');

$record_id = $_GET['record_id'];

$query = "SELECT record_id, event_name, DATE_FORMAT(record_timestamp, '%Y-%m-%d %H:%i:%s') as record_timestamp,
                 if_id, if_type, s_name,
                 t_name, processing_endpoint, t_endpoint,
                 frequency
                 FROM SBA_CONFIGMAP
                 WHERE record_id = '".$record_id."'";

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