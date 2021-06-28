<?php

// Online Dashboard
$startOnline = null;
$endOnline = null;
$startBatch = null;
$endBatch = null;

$sql1 = "select TO_CHAR(RECORD_MODIFIED_DATE,'DD/MM/YYYY HH24:MI:SS') as
            ENDDATETIME, TO_CHAR(RECORD_MODIFIED_DATE,'DD/MM/YYYY') as
            STARTDATETIME, RECORD_COUNT 
            from T_DASHBOARD_SUMMARY where RECORD_DATE = TO_CHAR(SYSDATE, 'DD-MON-YY') and IF_TYPE = 'O' AND STATUS = 'Completed'";
$result1=oci_parse($conn,$sql1);
oci_execute($result1);
while($row = oci_fetch_assoc($result1)) {
    $data1 = $row['RECORD_COUNT'];
    if ($row['ENDDATETIME'] != null || $row['ENDDATETIME'] != '') {
        $startOnline = $row['STARTDATETIME'];
        $endOnline = $row['ENDDATETIME'];
    }
}

$sql2 = "select TO_CHAR(RECORD_MODIFIED_DATE,'DD/MM/YYYY HH24:MI:SS') as
            ENDDATETIME, TO_CHAR(RECORD_MODIFIED_DATE,'DD/MM/YYYY') as
            STARTDATETIME, RECORD_COUNT
            from T_DASHBOARD_SUMMARY where RECORD_DATE = TO_CHAR(SYSDATE, 'DD-MON-YY') and IF_TYPE = 'O' AND STATUS = 'Processed'";
$result2=oci_parse($conn,$sql2);
oci_execute($result2);
while($row = oci_fetch_assoc($result2)) {
    $data2 = $row['RECORD_COUNT'];
    if ($row['ENDDATETIME'] != null || $row['ENDDATETIME'] != '') {
        $startOnline = $row['STARTDATETIME'];
        $endOnline = $row['ENDDATETIME'];
    }
}

$sql3="select TO_CHAR(RECORD_MODIFIED_DATE,'DD/MM/YYYY HH24:MI:SS') as
            ENDDATETIME, TO_CHAR(RECORD_MODIFIED_DATE,'DD/MM/YYYY') as
            STARTDATETIME, RECORD_COUNT 
            from T_DASHBOARD_SUMMARY where RECORD_DATE = TO_CHAR(SYSDATE, 'DD-MON-YY') and IF_TYPE = 'O' AND STATUS = 'Error'";
$result3=oci_parse($conn,$sql3);
oci_execute($result3);
while($row = oci_fetch_assoc($result3)) {
    $data3 = $row['RECORD_COUNT'];
    if ($row['ENDDATETIME'] != null || $row['ENDDATETIME'] != '') {
        $startOnline = $row['STARTDATETIME'];
        $endOnline = $row['ENDDATETIME'];
    }
}

$sum = $data1 + $data2+ $data3;

$dataPointsOnline = null;
$dataPointsOnlineBar = null;

if ($sum != 0) {
    $dataPointsOnline = array( 
        array("y"=>(round(($data1 / $sum) * 100, 2)), "label"=>"Completed"),
        array("y"=>(round(($data2 / $sum) * 100, 2)), "label"=>"Processed"),
        array("y"=>(round(($data3 / $sum) * 100, 2)), "label"=>"Error")
    );

    $dataPointsOnlineBar = array((round($data1)),(round($data2)),(round($data3)));
}

// Batch Dashboard
// $sql4 = "select TO_CHAR(RECORD_MODIFIED_DATE,'DD/MM/YYYY HH24:MI:SS') as
//             ENDDATETIME, TO_CHAR(RECORD_MODIFIED_DATE,'DD/MM/YYYY') as
//             STARTDATETIME, RECORD_COUNT 
//             from T_DASHBOARD_SUMMARY where RECORD_DATE = TO_CHAR(SYSDATE, 'DD-MON-YY') and IF_TYPE = 'B' AND STATUS = 'Completed'";
// $result4=oci_parse($conn,$sql4);
// oci_execute($result4);
// while($row = oci_fetch_assoc($result4)) {
//     $data4 = $row['RECORD_COUNT'];
//     if ($row['ENDDATETIME'] != null || $row['ENDDATETIME'] != '') {
//         $startBatch = $row['STARTDATETIME'];
//         $endBatch = $row['ENDDATETIME'];
//     }
// }

// $sql5 = "select TO_CHAR(RECORD_MODIFIED_DATE,'DD/MM/YYYY HH24:MI:SS') as
//             ENDDATETIME, TO_CHAR(RECORD_MODIFIED_DATE,'DD/MM/YYYY') as
//             STARTDATETIME, RECORD_COUNT 
//             from T_DASHBOARD_SUMMARY where RECORD_DATE = TO_CHAR(SYSDATE, 'DD-MON-YY') and IF_TYPE = 'B' AND STATUS = 'Sent'";
// $result5=oci_parse($conn,$sql5);
// oci_execute($result5);
// while($row = oci_fetch_assoc($result5)) {
//     $data5 = $row['RECORD_COUNT'];
//     if ($row['ENDDATETIME'] != null || $row['ENDDATETIME'] != '') {
//         $startBatch = $row['STARTDATETIME'];
//         $endBatch = $row['ENDDATETIME'];
//     }
// }

// $sql6="select TO_CHAR(RECORD_MODIFIED_DATE,'DD/MM/YYYY HH24:MI:SS') as
//             ENDDATETIME, TO_CHAR(RECORD_MODIFIED_DATE,'DD/MM/YYYY') as
//             STARTDATETIME, RECORD_COUNT
//             from T_DASHBOARD_SUMMARY where RECORD_DATE = TO_CHAR(SYSDATE, 'DD-MON-YY') and IF_TYPE = 'B' AND STATUS = 'Error'";
// $result6=oci_parse($conn,$sql6);
// oci_execute($result6);
// while($row = oci_fetch_assoc($result6)) {
//     $data6 = $row['RECORD_COUNT'];
//     if ($row['ENDDATETIME'] != null || $row['ENDDATETIME'] != '') {
//         $startBatch = $row['STARTDATETIME'];
//         $endBatch = $row['ENDDATETIME'];
//     }
// }

// $sql7="select TO_CHAR(RECORD_MODIFIED_DATE,'DD/MM/YYYY HH24:MI:SS') as
//             ENDDATETIME, TO_CHAR(RECORD_MODIFIED_DATE,'DD/MM/YYYY') as
//             STARTDATETIME, RECORD_COUNT
//             from T_DASHBOARD_SUMMARY where RECORD_DATE = TO_CHAR(SYSDATE, 'DD-MON-YY') and IF_TYPE = 'B' AND STATUS = 'Rejected'";
// $result7=oci_parse($conn,$sql7);
// oci_execute($result7);
// while($row = oci_fetch_assoc($result7)) {
//     $data7 = $row['RECORD_COUNT'];
//     if ($row['ENDDATETIME'] != null || $row['ENDDATETIME'] != '') {
//         $startBatch = $row['STARTDATETIME'];
//         $endBatch = $row['ENDDATETIME'];
//     }
// }

// $sum2 = $data4 + $data5 + $data6 + $data7;

// $dataPointsBatch = null;
// $dataPointsBatchBar = null;

// if ($sum2 != 0) {
//     $dataPointsBatch = array(
//         array("y"=>(round(($data4 / $sum2) * 100, 2)), "label"=>"Completed"),
//         array("y"=>(round(($data5 / $sum2) * 100, 2)), "label"=>"Sent"),
//         array("y"=>(round(($data6 / $sum2) * 100, 2)), "label"=>"Error"),
//         array("y"=>(round(($data7 / $sum2) * 100, 2)), "label"=>"Rejected")
//     );

//     $dataPointsBatchBar = array((round($data4)),(round($data5)),(round($data6)),(round($data7)));
// }

?>