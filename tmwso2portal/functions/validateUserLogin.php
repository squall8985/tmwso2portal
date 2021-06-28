<?php
// Start session
session_start();

// Include database connection details
include ('../DBConn/connectionInfo.php');

$username= $_POST['username'];
$password = $_POST['pass'];

// Create query
$select = "SELECT * FROM SP_USERS WHERE username='$username' AND password='$password'";
if ($result = mysqli_query($conn, $select)) {
    if (mysqli_num_rows($result) == 1) {
        // Login Successful
        $query = "SELECT name, username, status, id, status, role_dashboard, role_business_event, role_online, role_batch, role_sms, role_query, role_user_management FROM SP_USERS WHERE username='$username' AND password='$password'";
        $data = mysqli_fetch_assoc(mysqli_query($conn, $query));
        
        $status = $data["status"];
        
        if ($status ==  0) {
            echo "Your account suspended.<br />Please contact administrator.";
        } else {
            session_regenerate_id();
            $userID = $data["id"];
            $name = $data["name"];
            $usernames= $data["username"];
            $status = $data["status"];
            $role_dashboard = $data["role_dashboard"];
            $role_business_event = $data["role_business_event"];
            $role_online = $data["role_online"];
            $role_batch = $data["role_batch"];
            $role_sms = $data["role_sms"];
            $role_query = $data["role_query"];
            $role_user_management = $data["role_user_management"];

            // For timeout mechanism
            $random = time();
            
            $_SESSION["SESS_MEMBER_ID"] = $userID;
            $_SESSION["SESS_MEMBER_NAME"] = $name;
            $_SESSION["SESS_MEMBER_USER_NAME"] = $usernames;
            $_SESSION["ROLE_DASHBOARD"] = $role_dashboard;
            $_SESSION["ROLE_BUSINESS_EVENT"] = $role_business_event;
            $_SESSION["ROLE_ONLINE"] = $role_online;
            $_SESSION["ROLE_BATCH"] = $role_batch;
            $_SESSION["ROLE_SMS"] = $role_sms;
            $_SESSION["ROLE_QUERY"] = $role_query;
            $_SESSION["ROLE_USER_MANAGEMENT"] = $role_user_management;
            $_SESSION["RANDOM"] = $random;

            $update = "UPDATE SP_USERS SET last_login_timestamp = NOW(), special = '$random' WHERE id=$userID";
            
            mysqli_query($conn, $update);
            
            session_write_close();
            echo "Success login";
        }

        mysqli_free_result($query);
        mysqli_close($conn);
        
    } else {
        echo "Your login details is invalid.";
    }
} else {
    echo "ERROR: Could not able to execute $sql. ".mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>