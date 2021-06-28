<?php
include ("../../../DBConn/connectionInfo.php");
require_once('../../../functions/auth.php');

// Parameters
$rq_uuid = $_GET["rq_uuid"];

// Table Name
$table = "SBA_TRANS_LOG";

// Table's primary key
$primaryKey = "record_id";

// Columns to be displayed
$columns = array (
    array("db" => "record_id", "dt" => 0 ),
    array("db" => "record_type", "dt" => 1 ),
    array("db" => "record_created","dt" => 2,
            "formatter" => function( $d, $row ) {
            return date( "Y-m-d H:i:s", strtotime($d));
        }
    ),
    array("db" => "rq_uuid", "dt" => 3 ),
    array("db" => "rq_msg_id", "dt" => 4 ),
    array("db" => "rq_type", "dt" => 5 ),
    array("db" => "rq_message_type", "dt" => 6 ),
    array("db" => "audit_pname_1", "dt" => 7 ),
    array("db" => "audit_param_1", "dt" => 8 ),
    array("db" => "audit_pname_2", "dt" => 9 ),
    array("db" => "audit_param_2", "dt" => 10 ),
    array("db" => "audit_pname_3", "dt" => 11 ),
    array("db" => "audit_param_3", "dt" => 12 ),
    array("db" => "audit_pname_4", "dt" => 13 ),
    array("db" => "audit_param_4", "dt" => 14 ),
    array("db" => "audit_pname_5", "dt" => 15 ),
    array("db" => "audit_param_5", "dt" => 16 ),
    array("db" => "audit_pname_6", "dt" => 17 ),
    array("db" => "audit_param_6", "dt" => 18 ),
    array("db" => "rq_payload", "dt" => 19 ),
    array("db" => "rq_json_payload", "dt" => 20 ),
    array("db" => "err_cd", "dt" => 21 ),
    array("db" => "err_msg", "dt" => 22 ),
    array("db" => "err_detail", "dt" => 23 ),
    array("db" => "err_exception", "dt" => 24 ),
    array("db" => "err_payload", "dt" => 25 ),
    array("db" => "err_json_payload", "dt" => 26 )
);

// https://github.com/DataTables/DataTables/blob/master/examples/server_side/scripts/ssp.class.php
require("../../../include/ssp.class.php");

// Where conditions
$where = "rq_uuid = '".$rq_uuid."' OR rq_msg_id='".$rq_uuid."'";

echo json_encode(SSP::simpleCustom($_GET, $sql_details, $table, $primaryKey, $columns,$where));

// Close connection
mysqli_close();
?>