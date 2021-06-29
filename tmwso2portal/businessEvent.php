<?php
error_reporting(E_ALL & ~E_NOTICE);
include ("DBConn/connectionInfo.php");
require_once('functions/auth.php');
include ("include/username.php");

$tz = "Asia/Kuala_Lumpur";
$timestamp = time();

$start = new DateTime("now", new DateTimeZone($tz));
$start->setTimestamp($timestamp);
$start->modify("-365 day");

$end = new DateTime("now", new DateTimeZone($tz));
$end->setTimestamp($timestamp);
$end->modify("+1 day");

// Use in menu.php
$MODULE = "BUSINESSEVENT";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
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
    <style>
        .modal {
          text-align: center;
        }

        @media screen and (min-width: 768px) { 
          .modal:before {
            display: inline-block;
            vertical-align: middle;
            content: " ";
            height: 100%;
          }
        }

        .modal-dialog {
          display: inline-block;
          text-align: left;
          vertical-align: middle;
        }

        table, th, td {
            width:700px;
        }

        table.center {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
     	<?php include ("include/menu.php"); ?>
    </nav>
  	<div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">BUSINESS EVENT</h1>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     Business Data
                  </div>
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="col-md-6">
                              <table class="center">
                                  <tr>
                                  	<td>
                                  		<div class="">
                                        	<label>Interface Type:</label>
                                      	</div>
                                      	<div class="" style="width: 300px;">
                                        	<select class="search" name="if_type" id="if_type">
                                            	<option value="">All</option>
                                                <?php
                                                    $sqlGetEvent = "SELECT DISTINCT(if_type) FROM SBA_CONFIGMAP WHERE if_type IS NOT NULL ORDER BY if_type ASC";
                                                    $printed = false;
            
                                                    if ($resultEvent = $conn->query($sqlGetEvent)) {
                                                        
                                                        while($row = $resultEvent->fetch_assoc()) {
                                                            $x = $_GET['if_type'];
                                                            
                                                            if (isset($x) && $printed == false && strtolower($x) == strtolower($row['if_type'])) {
                                                                echo "<option selected=\"selected\" value=".$row['if_type'].">".$row['if_type']."</option>";
                                                                $printed = false;
                                                            } else {
                                                                echo "<option value=".$row['if_type'].">".$row['if_type']."</option>";
                                                            }
                                                        }
                                                    }
                                                    $resultEvent->close();
                                                ?>
                                         	</select>
                                      	</div>
                                  	</td>
                                  	<td>
                                  		<div class="">
                                        	<label>Event Name:</label>
                                      	</div>
                                      	<div class="" style="width: 300px;">
                                        	<select class="search" name="event_name" id="event_name">
                                            	<option value="">All</option>
                                                <?php
                                                    $sqlGetEvent = "SELECT DISTINCT(event_name) FROM SBA_CONFIGMAP WHERE event_name IS NOT NULL ORDER BY event_name ASC";
                                                    $printed = false;
            
                                                    if ($resultEvent = $conn->query($sqlGetEvent)) {
                                                        
                                                        while($row = $resultEvent->fetch_assoc()) {
                                                            $x = $_GET['event_name'];
                                                            
                                                            if (isset($x) && $printed == false && strtolower($x) == strtolower($row['event_name'])) {
                                                                echo "<option selected=\"selected\" value=".$row['event_name'].">".$row['event_name']."</option>";
                                                                $printed = false;
                                                            } else {
                                                                echo "<option value=".$row['event_name'].">".$row['event_name']."</option>";
                                                            }
                                                        }
                                                    }
                                                    $resultEvent->close();
                                                ?>
                                         	</select>
                                      	</div>
                                  	</td>
                                  </tr>
                                  <tr>
                                  	<td>
                                        <div class="" style="padding-bottom:20px;">
                                        	<button type="submit" name="btnSearch" id="btnSearch" class="btn btn-primary" title="Checking">
                                        	<i class="fa fa-check-square" aria-hidden="true"></i> Submit
                                        	</button>
                                        </div>
                                  	</td>
                                  </tr>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="panel panel-default">
                              <div class="panel-body">
                                 <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables">
                                       <thead>
                                          <tr>
                                          	 <th style='font-size:12px; vertical-align:middle;'></th>
                                             <th style='font-size:12px; vertical-align:middle;'>EVENT NAME</th>
                                             <th style='font-size:12px; vertical-align:middle;'>INTERFACE ID</th>
                                             <th style='font-size:12px; vertical-align:middle;'>INTERFACE TYPE</th>
                                             <th style='font-size:12px; vertical-align:middle;'>ACTIVE FLAG</th>
                                             <th style='font-size:12px; vertical-align:middle;'>SOURCE</th>
                                             <th style='font-size:12px; vertical-align:middle;'>TARGET</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
    	</div>
	</div>

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
	<script>
   	$(document).ready(function() {
		var $select1 = $("#event_name").selectize();
        $select1[0].selectize.on("change", function() {
          $("#btnSearch").click();
        });

		var $select2 = $("#if_type").selectize();
        $select2[0].selectize.on("change", function() {
          $("#btnSearch").click();
        });

        $("#btnSearch").click(function() {
            event_name = $("#event_name").val();
            if_type = $("#if_type").val();
            drawTable();
        });

        // Loads the correct sidebar on window load,
        // collapses the sidebar on window resize.
        // Sets the min-height of #page-wrapper to window size
        $(function() {
            $(window).bind("load resize", function() {
                topOffset = 50;
                width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
                if (width < 768) {
                    $('div.navbar-collapse').addClass('collapse')
                    topOffset = 100; // 2-row-menu
                } else {
                    $('div.navbar-collapse').removeClass('collapse')
                }
        
                height = (this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height;
                height = height - topOffset;
                if (height < 1) height = 1;
                if (height > topOffset) {
                    $("#page-wrapper").css("min-height", (height) + "px");
                }
            })
        });

        $("#btnSearch").click();

		$(".search, .selectize-one").keypress(function (e) {
            if (e.which == 13) {
            	$("#btnSearch").click();
            return false;
            }
        });
	});

	function showDetails(event_name, interface_type) {
		if (interface_type.toUpperCase() == "ONLINE") {
			window.location.href = "online.php?event_name=" + event_name + "&startDate=<?php echo $start->format("Y-m-d H:i:s"); ?>&endDate=<?php echo $end->format("Y-m-d H:i:s"); ?>";
		} else if (interface_type.toUpperCase() == "BATCH") {
			window.location.href = "online.php?event_name=" + event_name + "&startDate=<?php echo $start->format("Y-m-d H:i:s"); ?>&endDate=<?php echo $end->format("Y-m-d H:i:s"); ?>";
		} else {
			messageBox("Error", "Interface Type <b>" + interface_type + "</b> is not valid.");
		}
    }

	function drawTable() {
		console.time("Table Render");
		$.fn.dataTable.moment('YYYY-MM-DD HH:mm:ss');
		$.fn.dataTable.ext.errMode = "throw";
     	var table = $('#dataTables').DataTable({
 	 		ajax: {
     			url: "page/paging/businessEventInterfacePagination.php?event_name=" + event_name + "&if_type=" + if_type
			},
			dom: '<lif<t>Bp>',
			language: {
				sLoadingRecords: '<span style="width:100%;">Loading.. <img src="images/ajaxload.gif"> Please wait....</span>'
			},
			"bAutoWidth": true,
			"bDestroy": true,
			"bServerSide": true,
			"bProcessing": true,
            "bDeferRender": true,
            "iDisplayLength": 10,
            "scrollX": true,
        	"scrollY": 500,
            "columnDefs": [
            	{
            		"className": "dt-center",
            		"targets": "_all"
            	},
                {
                    "render": function ( data, type, row ) {
                        return "<button onclick=\"showDetails('" + row[1] + "', '" + row[3] + "')\" " + "id=\"modal\" class=\"btn btn-xs btn-emp\" style=\"min-width: 0px;color:black;\">" + 
							   "<i class=\"fas fa-arrow-circle-right\" style=\"font-size: 12px; color: #6DB61A;\"></i></button>";
                    },
                    "sWidth": "5%",
                    "targets": 0
                },
                { "stype": "date", "targets": 2 }
            ],
            "buttons": [
                {
                    "extend": 'excel',
                    "text": '<button class="btn"><i class="fa fa-file-excel" style="color: green;"></i></button>',
                    "titleAttr": 'Excel',
                    "action": newexportaction
                }
            ],
			initComplete: function() {
				$('.buttons-excel').html('<i class="far fa-file-excel style="color: green;"" />');
		    },
			"order": [[ 1, "desc" ]]
		}).on( 'error.dt', function ( e, settings, techNote, message ) {
			messageBox("Failed", message);
        });
		console.timeEnd("Table Render");
 	}

	function newexportaction(e, dt, button, config) {
        var self = this;
        var oldStart = dt.settings()[0]._iDisplayStart;
        dt.one('preXhr', function (e, s, data) {
             // Just this once, load all data from the server...
             data.start = 0;
             data.length = 2147483647;
             dt.one('preDraw', function (e, settings) {
                 // Call the original action function
                 if (button[0].className.indexOf('buttons-copy') >= 0) {
                     $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-excel') >= 0) {
                     $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
                     $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-csv') >= 0) {
                     $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf('buttons-print') >= 0) {
                     $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                 }
                 dt.one('preXhr', function (e, s, data) {
                     // DataTables thinks the first item displayed is index 0, but we're not drawing that.
                     // Set the property to what it was before exporting.
                     settings._iDisplayStart = oldStart;
                     data.start = oldStart;
                 });
                 // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
                 setTimeout(dt.ajax.reload, 0);
                 // Prevent rendering of the full data to the DOM
                 return false;
             });
        });
        // Requery the server with the new one-time export settings
		dt.ajax.reload();
	}
	</script>
	<?php include ("page/modal/businessEvent/businessEventModal.php"); ?>
	<?php include ("page/modal/user/userChangePasswordModal.php"); ?>

	<?php include ("include/modal/popupModal.php"); ?>
	<?php include ("include/functions/changePassword.php"); ?>
</body>
</html>