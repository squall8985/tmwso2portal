<?php
include ('../DBConn/connectionInfo.php');

//$sql = "CALL P_SOA_Resubmission(:cdate)";
//$resubmission = oci_parse($conn, $sql);
//$resubmitDate = $_POST['updateDate'];

//oci_bind_by_name($resubmission, ':cdate', $resubmitDate);
//oci_execute($resubmission);




/*$queryRES1 = "SELECT count(REQUEST_ID) as noresult
FROM 
(SELECT A.REQUEST_ID,A.EVENT_NAME,A.REQ_STATUS, A.CREATED_DATE, A.TARGET_RES_DESC, A.MSG_ORIGINATED, A.MSG_TERMINATED,A.MESSAGE_ID,
CASE 
  WHEN B.RQ_UUID IS NULL THEN 'N'
  ELSE 'Y'
END AS RESUBMISSION_FLAGS
FROM T_POOL_SOA_ONLINE A
LEFT JOIN SOA_RESUBMISSION_LOG B ON  A.REQUEST_ID=B.RQ_UUID AND B.RESUBMISSION_FLAG='N')
WHERE REQ_STATUS!='Completed' AND TO_CHAR(CREATED_DATE,'DD-MM-YYYY')='" . $_POST['updateDate'] . "' AND EVENT_NAME='" . $_POST['event'] . "' AND 
TARGET_RES_DESC='" . $_POST['desc'] . "' AND RESUBMISSION_FLAGS='Y'";*/

//echo $queryRES1;
//$stidRES1 = oci_parse($conn, $queryRES1);
//oci_execute($stidRES1);




$queryRES = "UPDATE SOA_RESUBMISSION_LOG SET RESUBMISSION_FLAG='Y' WHERE  RQ_UUID IN (SELECT REQUEST_ID
FROM 
(SELECT A.REQUEST_ID,A.EVENT_NAME,A.REQ_STATUS, A.CREATED_DATE, A.TARGET_RES_DESC, A.MSG_ORIGINATED, A.MSG_TERMINATED,A.MESSAGE_ID,
CASE 
  WHEN B.RQ_UUID IS NULL THEN 'N'
  ELSE 'Y'
END AS RESUBMISSION_FLAGS
FROM T_POOL_SOA_ONLINE A
LEFT JOIN SOA_RESUBMISSION_LOG B ON  A.REQUEST_ID=B.RQ_UUID AND B.RESUBMISSION_FLAG='N')
WHERE REQ_STATUS!='Completed' AND TO_CHAR(CREATED_DATE,'DD-MM-YYYY')='" . $_POST['updateDate'] . "' AND EVENT_NAME='" . $_POST['event'] . "' AND 
TARGET_RES_DESC='" . $_POST['desc'] . "' AND RESUBMISSION_FLAGS='Y')";

//echo $queryRES;
$stidRES = oci_parse($conn, $queryRES);
oci_execute($stidRES);


//while (($row = oci_fetch_array($stidRES1, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
//$noresult = $row['noresult'];
//echo $noresult;
//}

//echo $noresult;

echo "<script>alert ('". $noresult ."' data has been resubmitted.')</script>";
echo "<script>window.location = '../resubmission2.php'</script>";

?>
