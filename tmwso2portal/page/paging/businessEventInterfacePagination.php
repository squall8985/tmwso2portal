<?php
include ("../../DBConn/connectionInfo.php");
require_once('../../functions/auth.php');

// Parameters
$event_name = $_GET['event_name'];
$if_type = $_GET['if_type'];

// Table Name
$table = "SBA_CONFIGMAP";

// Table's primary key
$primaryKey = "record_id";

// Columns to be displayed
$columns = array (
    array("db" => "record_id", "dt" => 0 ),
    array("db" => "event_name", "dt" => 1 ),
    array("db" => "if_id", "dt" => 2 ),
    array("db" => "if_type", "dt" => 3 ),
    array("db" => "active_flg", "dt" => 4 ),
    array("db" => "s_name", "dt" => 5 ),
    array("db" => "t_name", "dt" => 6 )
);

// https://github.com/DataTables/DataTables/blob/master/examples/server_side/scripts/ssp.class.php
require("../../include/ssp.class.php");

// Where conditions
$where = "if_type LIKE '%".$if_type."%' AND event_name LIKE '%".$event_name."%'";

echo json_encode(SSP::simpleCustom($_GET, $sql_details, $table, $primaryKey, $columns, $where));

// Close connection
mysqli_close();
?>