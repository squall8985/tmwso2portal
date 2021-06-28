<?php
include ("../../../DBConn/connectionInfo.php");
require_once('../../../functions/auth.php');

$record_id = $_GET['record_id'];

$query = "SELECT record_id, message_id, record_type,
                event_name, status,
                scode,
                hand_phone_no, add_property,
                DATE_FORMAT(record_timestamp, '%Y-%m-%d %H:%i:%s') as record_timestamp,
                rq_uuid
                FROM sba_sms_online
                WHERE record_id = '".$record_id."'";

if ($result = mysqli_query($conn, $query)) {
    if (mysqli_num_rows($result) == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            $res[] = $row;
        }

        echo json_encode($res);

        // Free result selectiont
        mysqli_free_result($query);
        mysqli_close($conn);

        exit();
    } else {
        echo "No records matching your query were found.";
    }
} else {
    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
}
?>