<?php
include ("../../../DBConn/connectionInfo.php");
require_once('../../../functions/auth.php');

// Parameters
$id = $_GET["id"];

// Table Name
$table = "sp_users";

// Table's primary key
$primaryKey = "id";

// Columns to be displayed
$columns = array (
    array("db" => "role_dashboard","dt" => 0,
        "formatter" => function( $d, $row ) {
        if ($d == 1)
            return true;
            else
                return false;
        }
    ),
    array("db" => "role_business_event","dt" => 1,
        "formatter" => function( $d, $row ) {
        if ($d == 1)
            return true;
            else
                return false;
        }
    ),
    array("db" => "role_online","dt" => 2,
        "formatter" => function( $d, $row ) {
        if ($d == 1)
            return true;
            else
                return false;
        }
    ),
    array("db" => "role_batch","dt" => 3,
        "formatter" => function( $d, $row ) {
        if ($d == 1)
            return true;
            else
                return false;
        }
    ),
    array("db" => "role_sms","dt" => 4,
        "formatter" => function( $d, $row ) {
        if ($d == 1)
            return true;
            else
                return false;
        }
    ),
    array("db" => "role_query","dt" => 5,
        "formatter" => function( $d, $row ) {
        if ($d == 1)
            return true;
            else
                return false;
        }
    ),
    array("db" => "role_user_management","dt" => 6,
        "formatter" => function( $d, $row ) {
        if ($d == 1)
            return true;
            else
                return false;
        }
    )
);
// https://github.com/DataTables/DataTables/blob/master/examples/server_side/scripts/ssp.class.php
require("../../../include/ssp.class.php");

// Where conditions
$where = "id = '".$id."'";

echo json_encode(SSP::simpleCustom($_GET, $sql_details, $table, $primaryKey, $columns, $where));

// Close connection
mysqli_close();
?>