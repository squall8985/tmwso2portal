<?php
error_reporting(E_ALL & ~ E_NOTICE);
// Use in menu.php
$MODULE = "DASHBOARD";

include ("DBConn/connectionInfo.php");
require_once ("functions/auth.php");
include ("include/username.php");

date_default_timezone_set("Asia/Kuala_Lumpur");

/*require_once ('functions/dashboard.php');*/

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Smart Biz API Support Portal</title>
<title>Smart Biz API Support Portal</title>
<script type="text/javascript" src="js/custom/modal.js"></script>
<script type="text/javascript" src="js/custom/commonFunction.js"></script>
<script type="text/javascript" src="js/plugins/fontawesome-free-5.8.1-web/js/all.js"></script>
<link rel="icon" type="image/png" href="images/unifi-logo-telekom.ico" />
<link rel="stylesheet" type="text/css" href="js/plugins/fontawesome-free-5.8.1-web/css/fontawesome.min.css" />
<link rel="stylesheet" type="text/css" href="js/plugins/fontawesome-free-5.8.1-web/css/brands.min.css" />
<link rel="stylesheet" type="text/css" href="js/plugins/fontawesome-free-5.8.1-web/css/solid.min.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/sb-admin-2.css" />
<link rel="stylesheet" type="text/css" href="css/secondary.css" />
<link rel="stylesheet" type="text/css" href="js/plugins/dataTables/DataTables-1.10.18/css/dataTables.semanticui.min.css" />
<link rel="stylesheet" type="text/css" href="js/plugins/dataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" type="text/css" href="js/plugins/dataTables/datatables.min.css" />
<link rel="stylesheet" type="text/css" href="js/plugins/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="js/plugins/selective/css/selectize.bootstrap3.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
<script type="text/javascript" src="js/plugins/chartjs/Chart.min.js"></script>
<script type="text/javascript" src="js/plugins/chartjs/samples/utils.js"></script>
<script type="text/javascript">
<?php /*require_once ('functions/dashboard_script.php');*/ ?>
</script>
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="js/plugins/chartjs/Chart.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
         <?php include ("include/menu.php"); ?>
	</nav>
	<div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
    			<h1 class="page-header">Dashboard</h1>
            </div>
        </div>
		<div class="row">
			<div class="col-lg-12 alert alert-success">
              Welcome, <?php echo $staff_name;?>. Today is <?php echo date("l, jS \of F Y - h:i:s A"); ?>
           </div>
		</div>
		<div class="row" style="margin-left:-50px;">
			<div class="col-lg-5 col-md-4" style="width:950px;">
				<table>
				<tr>
					<td style="width:700px;height:300px;text-align:center;">
						<span id="chartContainer-online-bar-chart">
							<div><canvas id="chart-area-online"></canvas></div>
						</span>
					</td>
					<td style="width:700px;height:300px;text-align:center;">
						<span id="chartContainer-batch-bar-chart">
							<div><canvas id="chart-area-batch"></canvas></div>
						</span>
					</td>
				</tr>
				<tr>
					<td style="width:700px;text-align:center;"><span id="chartContainer-online-bar-chart-header"><h3></h3></span></td>
					<td style="width:700px;text-align:center;"><span id="chartContainer-batch-bar-chart-header"><h3></h3></span></td>
				</tr>
				</table>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="js/plugins/dataTables/datatables.min.js"></script>
<script type="text/javascript" src="js/plugins/moment-2.8.4/moment.min.js"></script>
<script type="text/javascript" src="js/plugins/datetime-1.10.19/datetime-moment.js"></script>
<script type="text/javascript" src="js/plugins/daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="js/plugins/metisMenu/metisMenu.min.js"></script>
<script type="text/javascript" src="js/formsInit.js"></script>
<script type="text/javascript" src="js/plugins/selective/js/standalone/selectize.min.js"></script>
<script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="js/bootstrap-3.4.1-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/custom/modal.js"></script>
<?php include ("page/modal/user/userChangePasswordModal.php"); ?>

<?php include ("include/modal/popupModal.php"); ?>
<?php include ("include/functions/changePassword.php"); ?>
</html>