<?php
$query1 = "SELECT name FROM SP_USERS WHERE id='$_SESSION[SESS_MEMBER_ID]'";
$data = mysqli_fetch_assoc(mysqli_query($conn, $query1));
$staff_name = $data["name"];
?>