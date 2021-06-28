<?php
// Include database connection details
include ('../DBConn/connectionInfo.php');

// Sanitize the POST values
$username = $_POST['username'];

// Create query
$query = "SELECT username FROM sp_users WHERE username='$username'";

if($result = mysqli_query($conn, $query)) {
    $data = mysqli_fetch_assoc($result);
    $temp =  $data["username"];
    
    if ($temp != "")
        echo json_encode(true);
        else
            echo json_encode(false);
} else{
    echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);

?>