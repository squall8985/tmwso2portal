<?php
include ("../../DBConn/connectionInfo.php");
require_once('../../functions/auth.php');

// Parameters
$event_name = $_GET['event_name'];
$req_status = $_GET['req_status'];
$record_type = $_GET['record_type'];
$messageId = $_GET['messageId'];
$handphoneNo = $_GET['handphoneNo'];
$search1 = $_GET['search1'];
$search2 = $_GET['search2'];

// Table Name
$table = "SBA_SMS_ONLINE";

// Table's primary key
$primaryKey = "record_id";

// Columns to be displayed
$columns = array (
    array("db" => "record_id", "dt" => 0 ),
    array("db" => "sms_content", "dt" => 1 ),
    array("db" => "record_type", "dt" => 2 ),
    array("db" => "record_timestamp","dt" => 3,
        "formatter" => function( $d, $row ) {
        return date( "Y-m-d H:i:s", strtotime($d));
        }
    ),
    array("db" => "event_name", "dt" => 4 ),
    array("db" => "scode", "dt" => 5 ),
    array("db" => "message_id", "dt" => 6 ),
    array("db" => "hand_phone_no", "dt" => 7 ),
    array("db" => "status", "dt" => 8 ),
    array("db" => "rs_description", "dt" => 9 ),
    array("db" => "rq_uuid", "dt" => 10 )
);


// https://github.com/DataTables/DataTables/blob/master/examples/server_side/scripts/ssp.class.php
require("../../include/ssp.class.php");

// Where conditions
$where = "(record_timestamp BETWEEN '".$search1 ."' AND  '".$search2."') AND record_type LIKE '%".$record_type."%' ".
    "AND status LIKE '%".$req_status."%' AND event_name LIKE '%".$event_name."%'".
    "AND message_id LIKE '%".$messageId."%' AND hand_phone_no LIKE '%".$handphoneNo."%'";

echo json_encode(SSP::simpleCustom($_GET, $sql_details, $table, $primaryKey, $columns,$where));

// Close connection
// mysqli_close();
?>