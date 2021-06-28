<?php
include ('../DBConn/connectionInfo.php');

$sql = "CALL P_SOA_Resubmission(:cdate)";
$resubmission = oci_parse($conn, $sql);
$resubmitDate = $_POST['updateDate'];

oci_bind_by_name($resubmission, ':cdate', $resubmitDate);
oci_execute($resubmission);
echo "<script>alert ('Data has been resubmitted.')</script>";
echo "<script>window.location = '../Resubmission.php'</script>";
?>
