<?php
// Include database connection details
include ('../DBConn/connectionInfo.php');

// Start session
session_start();

// Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION["SESS_MEMBER_ID"]) || (trim($_SESSION["SESS_MEMBER_ID"]) == "")) {
    header("location: index.php");
    exit();
} else {
    if (isset($_SESSION["RANDOM"])) {
        $id = $_SESSION["SESS_MEMBER_ID"];
        $random = $_SESSION["RANDOM"];
        
        $select = "SELECT * FROM sp_users WHERE id=$id";
        if ($result = mysqli_query($conn, $select)) {
            if (mysqli_num_rows($result) == 1) {
                $data = mysqli_fetch_assoc(mysqli_query($conn, $select));
                
                $randomTemp = $data["special"];
                $status = $data["status"];
                
                if ($random == $randomTemp && $status == 1) {
                    // Do nothing
                } else if ($status == 0) { 
                    // Kick out account disable
                    header("location: index.php?timeout=disabled");
                    exit();
                } else {
                    // Kick out
                    header("location: index.php?timeout=timeout");
                    exit();
                }
            } else {
                // If user deleted
                // Kick out
                header("location: index.php?timeout=accountDeleted");
                exit();
            }
        }
    }
}
?>