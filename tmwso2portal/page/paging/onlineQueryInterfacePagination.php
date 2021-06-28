<?php
include ("../../DBConn/connectionInfo.php");
require_once('../../functions/auth.php');

// Parameters
$param = $_GET["param"];
$search1 = $_GET["search1"];
$search2 = $_GET["search2"];

// Table Name
$table = "sba_trans_log";

// Table's primary key
$primaryKey = "record_id";

// Columns to be displayed
$columns = array (
    array("db" => "rq_uuid", "dt" => 0 ),
    array("db" => "rq_uuid", "dt" => 1 ),
    array("db" => "rq_type", "dt" => 2 ),
    array("db" => "record_type", "dt" => 3 ),
    array("db" => "record_created","dt" => 4,
            "formatter" => function( $d, $row ) {
            return date( "Y-m-d H:i:s", strtotime($d));
        }
    ),
    array("db" => "rq_service_name", "dt" => 5 ),
    array("db" => "audit_pname_1", "dt" => 6 ),
    array("db" => "audit_param_1", "dt" => 7 ),
    array("db" => "audit_pname_2", "dt" => 8 ),
    array("db" => "audit_param_2", "dt" => 9 ),
    array("db" => "audit_pname_3", "dt" => 10 ),
    array("db" => "audit_param_3", "dt" => 11 ),
    array("db" => "audit_pname_4", "dt" => 12 ),
    array("db" => "audit_param_4", "dt" => 13 ),
    array("db" => "audit_pname_5", "dt" => 14 ),
    array("db" => "audit_param_5", "dt" => 15 ),
    array("db" => "audit_pname_6", "dt" => 16 ),
    array("db" => "audit_param_6", "dt" => 17 )
);

// https://github.com/DataTables/DataTables/blob/master/examples/server_side/scripts/ssp.class.php
require("../../include/ssp.class.php");

if ($param == '%' || $param == '') {
    $where = "(record_created BETWEEN '".$search1 ."' AND  '".$search2."')";
    
} else {
    $where = "(record_created BETWEEN '".$search1 ."' AND  '".$search2."') AND ".
        "(audit_param_1 LIKE '%".$param."%' OR audit_param_2 LIKE '%".$param."%'".
        "OR audit_param_3 LIKE '%".$param."%' OR audit_param_4 LIKE '%".$param."%'".
        "OR audit_param_5 LIKE '%".$param."%' OR audit_param_6 LIKE '%".$param."%')";
    
}

echo json_encode(SSP::simpleCustom($_GET, $sql_details, $table, $primaryKey, $columns, $where));

// Close connection
mysqli_close();
?>