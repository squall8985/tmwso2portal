<?php
error_reporting(E_ALL & ~E_NOTICE);
include ("DBConn/connectionInfo.php");
require_once('functions/auth.php');
include ("include/username.php");

$startGet = $_GET["startDate"];
$endGet = $_GET["endDate"];
$status = $_GET["status"];
$rq_uuid = $_GET["rq_uuid"];

$tz = "Asia/Kuala_Lumpur";
$timestamp = time();

$start = new DateTime("now", new DateTimeZone($tz));
$start->setTimestamp($timestamp);
$start->modify("-1 day");

$end = new DateTime("now", new DateTimeZone($tz));
$end->setTimestamp($timestamp);
$end->modify("+1 day");

// Use in menu.php
$MODULE = "ONLINEQUERY";
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
    <script type="text/javascript">
    	var search1 = "<?php if (isset($startGet)) { echo $startGet; } else { echo $start->format('Y/m/d H:i:s'); }?>";
    	var search2 = "<?php if (isset($endGet)) { echo $endGet; } else { echo $end->format('Y/m/d H:i:s'); }?>";
    </script>
    <style>
        .modal {
          text-align: center;
        }

        @media screen and (min-width: 768px) { 
          .modal:before {
            display: inline-block;
            vertical-align: top;
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
            width: 900px;
        }

        table.center {
            margin-left: auto;
            margin-right: auto;
        }

        td.details-control {
            background: url("images/details_open.png") no-repeat center center;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url("images/details_close.png") no-repeat center center;
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
               <h1 class="page-header">QUERY</h1>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     Query Data
                  </div>
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="col-md-6">
                              <table class="center">
                                  <tr>
                                  	<td>
                                  		<div class="">
                                             <label>Created Date search range:</label>
                                        </div>
										<div class="bootstrap-timepicker">
                                            <input class="form-control search" name="createdDatepicker" style="width:350px" id="createdDatepicker" type="text" value="<?php if (isset($startGet)) { echo $startGet; } else { echo $start->format('d/m/Y H:i:s'); }?> - <?php if (isset($endGet)) { echo $endGet; } else { echo $end->format('d/m/Y H:i:s'); }?>" />
                                        </div>
                                  	</td>
                                  </tr>
                                  <tr>
                                  	<td>
    									<div class="">
                                         <label>Param(s):</label>
                                         <input class="form-control" name="param" id="param" style="width:300px" type="text" value="" maxlength="100" />
                                         <br />
                                        </div>
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
                                          	 <th style="font-size:12px; vertical-align:middle;"></th>
                                          	 <th style="font-size:12px; vertical-align:middle;">RQ UUID</th>
                                          	 <th style="font-size:12px; vertical-align:middle;">RQ TYPE</th>
                                          	 <th style="font-size:12px; vertical-align:middle;">RECORD TYPE</th>
                                             <th style="font-size:12px; vertical-align:middle;">RECORD CREATED</th>
                                             <th style="font-size:12px; vertical-align:middle;">RQ SERVICE NAME</th>
                                             <th style="font-size:12px; vertical-align:middle;">PNAME 1</th>
                                             <th style="font-size:12px; vertical-align:middle;">PARAM 1</th>
                                             <th style="font-size:12px; vertical-align:middle;">PNAME 2</th>
                                             <th style="font-size:12px; vertical-align:middle;">PARAM 2</th>
                                             <th style="font-size:12px; vertical-align:middle;">PNAME 3</th>
                                             <th style="font-size:12px; vertical-align:middle;">PARAM 3</th>
                                             <th style="font-size:12px; vertical-align:middle;">PNAME 4</th>
                                             <th style="font-size:12px; vertical-align:middle;">PARAM 4</th>
                                             <th style="font-size:12px; vertical-align:middle;">PNAME 5</th>
                                             <th style="font-size:12px; vertical-align:middle;">PARAM 5</th>
                                             <th style="font-size:12px; vertical-align:middle;">PNAME 6</th>
                                             <th style="font-size:12px; vertical-align:middle;">PARAM 6</th>
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
	var modalTable;

   	// Export param
   	var todayDate = new Date();
   	var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

	$(document).ready(function() {
        var now = new Date();

        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);

        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

        $('input[name="createdDatepicker"]').daterangepicker({
        	timePicker: true,
            endDate: '<?php if (isset($endGet)) { echo $endGet; } else { echo $end->format('Y-m-d H:i:s'); }?>', // This implementation to cater click event from SOQ Query module
            startDate: '<?php if (isset($startGet)) { echo $startGet; } else { echo $start->format('Y-m-d H:i:s'); }?>', // This implementation to cater click event from SOQ Query module
            locale: {
        		format: 'YYYY-MM-DD HH:mm:ss'
        	},
            opens: 'right',
            timePickerSeconds: true,
            autoUpdateInput: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        	}
        	}, function (start, end, label) {
                search1 = start.format('YYYY-MM-DD HH:mm:ss');
                search2 = end.format('YYYY-MM-DD HH:mm:ss');
        });

        $("#btnSearch").click(function() {
            param = $("#param").val();
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

		// Add event listener for opening and closing details
		// Event listner for the modal datatable has to be define in document ready in order to avoid multiple binding
        $("#dataTablesModal tbody").on("click", "td.details-control", function () {
              var tr = $(this).closest("tr");
              var row = modalTable.row( tr );

              if (row.child.isShown()) {
                  // This row is already open - close it
                  row.child.hide();
                  tr.removeClass("shown");
              } else {
                  // Open this row
                  row.child(format(row.data())).show();
                  tr.addClass("shown");
              }
		});
	});

	function showDetails(req_uuid, startDate, endDate) {
      		window.location.href = "online.php?req_uuid=" + req_uuid + "&startDate=" + startDate + "&endDate=" + endDate;
    }

	function drawTable() {
		console.time("Table Render");
		$.fn.dataTable.moment("YYYY-MM-DD HH:mm:ss");
     	var table = $('#dataTables').DataTable({
 	 		ajax: {
     			url: "page/paging/onlineQueryInterfacePagination.php?search1=" + search1 +"&search2="
     				+ search2 + "&param=" + param
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
                        return "<button onclick=\"showDetails('" + data + "', '" + search1 + "', '" + search2 + "')\" " + "id=\"modal\" class=\"btn btn-xs btn-emp\" style=\"min-width: 0px;color:black;\">" + 
							   "<i class=\"fas fa-arrow-circle-right\" style=\"font-size: 12px; color: #6DB61A;\"></i></button>";
                    },
                    "sWidth": "5%",
                    "targets": 0
                },
                { "stype": "date", "targets": 4 }
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
			"order": [[ 4, "desc" ]]
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
	<?php include ("page/modal/online/onlineModal.php"); ?>
	<?php include ("page/modal/user/userChangePasswordModal.php"); ?>

	<?php include ("include/modal/popupModal.php"); ?>
	<?php include ("include/functions/changePassword.php"); ?>
</body>
</html>