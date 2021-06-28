<?php
include ("../../DBConn/connectionInfo.php");
require_once('../../functions/auth.php');

// Parameters
$event_name = $_GET["event_name"];
$req_status = $_GET["req_status"];
$request_id = $_GET["request_id"];
$rq_uuid = $_GET["rq_uuid"];
$search1 = $_GET["search1"];
$search2 = $_GET["search2"];

// Table Name
$table = "sba_trans";

// Table's primary key
$primaryKey = "record_id";

// Columns to be displayed
$columns = array (
    array("db" => "record_id", "dt" => 0 ),
    array("db" => "rs_description", "dt" => 1 ),
    array("db" => "record_created","dt" => 2,
            "formatter" => function( $d, $row ) {
            return date( "Y-m-d H:i:s", strtotime($d));
        }
    ),
    array("db" => "event_name", "dt" => 3 ),
    array("db" => "rq_service_name", "dt" => 4 ),
    array("db" => "status", "dt" => 5 ),
    array("db" => "in_msg_id", "dt" => 6 ),
    array("db" => "rq_uuid", "dt" => 7 )
);

// https://github.com/DataTables/DataTables/blob/master/examples/server_side/scripts/ssp.class.php
require("../../include/ssp.class.php");

// Where conditions
$where = "(record_created BETWEEN '".$search1 ."' AND  '".$search2."') ".
    "AND status LIKE '%".$req_status."%' AND event_name LIKE '%".$event_name."%' ".
    "AND rq_uuid LIKE '%".$rq_uuid."%' AND in_msg_id LIKE '%".$request_id."%'";

echo json_encode(SSP::simpleCustom($_GET, $sql_details, $table, $primaryKey, $columns, $where));

// Close connection
mysqli_close();
?>