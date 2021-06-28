<?php
include ("../../DBConn/connectionInfo.php");
require_once('../../functions/auth.php');

// Parameters
$name_search = $_GET["name_search"];
$user_name_search = $_GET["user_name_search"];
$search1 = $_GET["search1"];
$search2 = $_GET["search2"];
$search3 = $_GET["search3"];
$search4 = $_GET["search4"];

// Table Name
$table = "sp_users";

// Table's primary key
$primaryKey = "id";

// Columns to be displayed
$columns = array (
    array("db" => "id", "dt" => 0 ),
    array("db" => "username", "dt" => 1 ),
    array("db" => "name", "dt" => 2 ),
    array("db" => "status","dt" => 3,
        "formatter" => function( $d, $row ) {
        if ($d == 1)
            return "Enable";
            else
                return "Disable";
        }
    ),
    array("db" => "last_login_timestamp","dt" => 4,
        "formatter" => function( $d, $row ) {
            return date( "Y-m-d H:i:s", strtotime($d));
        }
    ),
    array("db" => "role_dashboard","dt" => 5,
        "formatter" => function( $d, $row ) {
            if ($d == 1)
                return true;
            else
                return false;
        }
    ),
    array("db" => "role_business_event","dt" => 6,
        "formatter" => function( $d, $row ) {
        if ($d == 1)
            return true;
            else
                return false;
        }
    ),
    array("db" => "role_online","dt" => 7,
        "formatter" => function( $d, $row ) {
        if ($d == 1)
            return true;
            else
                return false;
        }
    ),
    array("db" => "role_batch","dt" => 8,
        "formatter" => function( $d, $row ) {
        if ($d == 1)
            return true;
            else
                return false;
        }
    ),
    array("db" => "role_sms","dt" => 9,
        "formatter" => function( $d, $row ) {
        if ($d == 1)
            return true;
            else
                return false;
        }
    ),
    array("db" => "role_query","dt" => 10,
        "formatter" => function( $d, $row ) {
        if ($d == 1)
            return true;
            else
                return false;
        }
    ),
    array("db" => "role_user_management","dt" => 11,
        "formatter" => function( $d, $row ) {
        if ($d == 1)
            return true;
            else
                return false;
        }
    ),
);

// https://github.com/DataTables/DataTables/blob/master/examples/server_side/scripts/ssp.class.php
require("../../include/ssp.class.php");

// Where conditions
$where = "(created_timestamp BETWEEN '".$search1."' AND  '".$search2."') ".
    "AND (last_login_timestamp BETWEEN '".$search3."' AND  '".$search4."') ".
    "AND name LIKE '%".$name_search."%' AND username LIKE '%".$user_name_search."%'";

echo json_encode(SSP::simpleCustom($_GET, $sql_details, $table, $primaryKey, $columns, $where));

// Close connection
mysqli_close();
?>