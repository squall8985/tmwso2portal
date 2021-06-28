<?php
error_reporting(E_ALL & ~E_NOTICE);
include ("DBConn/connectionInfo.php");
require_once('functions/auth.php');
include ("include/username.php");

$startGet = $_GET['startDate'];
$endGet = $_GET['endDate'];
$status = $_GET['status'];

$tz = 'Asia/Kuala_Lumpur';
$timestamp = time();

$start = new DateTime("now", new DateTimeZone($tz));
$start->setTimestamp($timestamp);
$start->modify('-360 day');

$end = new DateTime("now", new DateTimeZone($tz));
$end->setTimestamp($timestamp);
$end->modify('+1 day');

// Use in menu.php
$MODULE = "SMS";
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
    	var search1 = '<?php if (isset($startGet)) { echo $startGet; } else { echo $start->format('Y/m/d H:i:s'); }?>';
    	var search2 = '<?php if (isset($endGet)) { echo $endGet; } else { echo $end->format('Y/m/d H:i:s'); }?>';
    </script>
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

        td.details-control {
            background: url("images/details_open.png") no-repeat 50% 50%;
            cursor: pointer;
        }

        tr.shown td.details-control {
            background: url("images/details_close.png") no-repeat 50% 50%;
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
               <h1 class="page-header">SMS</h1>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     SMS Data
                  </div>
                  <div class="panel-body">
                     <div class="row">
                        <div class="col-lg-6">
                           <div class="col-md-6">
                              <table class="center">
                                  <tr>
                                  	<td>
                                  		<div class="">
                                             <label>Date search range:</label>
                                        </div>
										<div class="bootstrap-timepicker">
                                            <input class="form-control search" name="datepicker" style="width:350px" id="datepicker" type="text" value="<?php if (isset($startGet)) { echo $startGet; } else { echo $start->format('d/m/Y H:i:s'); }?> - <?php if (isset($endGet)) { echo $endGet; } else { echo $end->format('d/m/Y H:i:s'); }?>" />
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
                                                    $sqlGetEvent = "SELECT DISTINCT(event_name) FROM sba_sms_online WHERE event_name IS NOT NULL ORDER BY event_name ASC";
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
    									<div class="">
                                             <label>Status:</label>
                                        </div>
                                        <div class="" style="width: 300px;">
                                        	<select class="search" name="req_status" id="req_status">
                                            	<option value="">All</option>
                                                <?php
                                                    $sqlGetStatus = "SELECT DISTINCT(status) FROM sba_sms_online WHERE status IS NOT NULL ORDER BY status ASC";
                                            
                                                    if ($resultStatus = $conn->query($sqlGetStatus)) {
                                                        
                                                        while($rowStatus = $resultStatus->fetch_assoc()) {
                                                            $x = $_GET['status'];
                                                            
                                                            if (isset($x) && $printed == false && strtolower($x) == strtolower($row['event_name'])) {
                                                                echo "<option selected=\"selected\" value=".$rowStatus['status'].">" . $rowStatus['status'] . "</option>";
                                                                $printed = false;
                                                            } else {
                                                                echo "<option value=".$rowStatus['status'].">" . $rowStatus['status'] . "</option>";
                                                            }
                                                        }
                                                    }
                                            
                                                    $resultStatus->close();
                                                ?>
                                         	</select>
                                    	</div>
                                  	</td>
                                  	<td>
                                  		<div class="">
                                        	<label>Record Type:</label>
                                        </div>
                                        <div style="width: 300px;">
                                        	<select class="search" name="record_type" id="record_type">
                                            	<option value="">All</option>
                                                <?php
                                                    $sqlRT = "SELECT DISTINCT(record_type) FROM sba_sms_online WHERE record_type IS NOT NULL ORDER BY record_type ASC";
                                                    $printed = false;
                                            
                                                    if ($resultRT = $conn->query($sqlRT)) {
                                                        
                                                        while($row = $resultRT->fetch_assoc()) {
                                                            $x = $_GET['record_type'];
                                                            
                                                            if (isset($x) && $printed == false && strtolower($x) == strtolower($row['record_type'])) {
                                                                echo "<option selected=\"selected\" value=".$row['record_type'].">" . $row['record_type'] . "</option>";
                                                                $printed = false;
                                                            } else {
                                                                echo "<option value=".$row['record_type'].">" . $row['record_type'] . "</option>";
                                                            }
                                                        }
                                                    }
                                            
                                                    $resultRT->close();
                                                ?>
                                         	</select>
                                        </div>
                                  	</td>
                                  </tr>
                                  <tr>
                                  	<td>
    									<div class="">
                                        	<label>Message ID:</label>
                                        </div>
                                        <div class="">
                                        	<input class="form-control search" name="messageId" id="messageId" style="width:300px" type="text" maxlength="200" />
                                         	<br />
                                        </div>
                                  	</td>
                                  	<td>
    									<div class="">
                                        	<label>Handphone No:</label>
                                        </div>
                                        <div class="">
                                        	<input class="form-control search" name="handphoneNo" id="handphoneNo" style="width:300px" type="text" maxlength="200" />
                                         	<br />
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
                                          	 <th style="font-size:12px; vertical-align:middle;"></th>
                                          	 <th style="font-size:12px; vertical-align:middle;"></th>
                                             <th style="font-size:12px; vertical-align:middle;">RECORD TYPE</th>
                                             <th style="font-size:12px; vertical-align:middle;">RECORD TIMESTAMP</th>
                                             <th style="font-size:12px; vertical-align:middle;">EVENT NAME</th>
                                             <th style="font-size:12px; vertical-align:middle;">SCODE</th>
                                             <th style="font-size:12px; vertical-align:middle;">MESSAGE ID</th>
                                             <th style="font-size:12px; vertical-align:middle;">HANDPHONE NO</th>
                                             <th style="font-size:12px; vertical-align:middle;">STATUS</th>
                                             <th style="font-size:12px; vertical-align:middle;">RS DESCRIPTION</th>
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
	var mainModalTable;

   	// Export param
   	var todayDate = new Date();
   	var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

	$(document).ready(function() {
		var $select1 = $("#event_name").selectize();
        $select1[0].selectize.on("change", function() {
          $("#btnSearch").click();
        });

		var $select2 = $("#req_status").selectize();
        $select2[0].selectize.on("change", function() {
          $("#btnSearch").click();
        });

		var $select3 = $("#record_type").selectize();
        $select3[0].selectize.on("change", function() {
          $("#btnSearch").click();
        });

        var now = new Date();

        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);

        var today = now.getFullYear()+"-"+(month)+"-"+(day) ;

        $('input[name="datepicker"]').daterangepicker({
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
            event_name = $("#event_name").val();
            req_status = $("#req_status").val();
            record_type = $("#record_type").val();
            messageId = $("#messageId").val();
            handphoneNo = $("#handphoneNo").val();
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

		// Add event listener for opening and closing details
		// Event listner for the modal datatable has to be define in document ready in order to avoid multiple binding
        $("#dataTables tbody").on("click", "td.details-control", function () {
              var tr = $(this).closest("tr");
              var row = mainModalTable.row( tr );

              if (row.child.isShown()) {
                  // This row is already open - close it
                  row.child.hide();
                  tr.removeClass("shown");
              } else {
                  // Open this row
                  row.child(formatMain(row.data())).show();
                  tr.addClass("shown");
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

        $("#btnSearch").click();

		$(".search, .selectize-one").keypress(function (e) {
            if (e.which == 13) {
            	$("#btnSearch").click();
            return false;
            }
        });
	});

	function showDetails(record_id, rq_uuid) {
		console.time("Modal Data Fetch");
		var batch = {
			"record_id": record_id
		};
		$.ajax({
			url: "page/interface/sms/smsInterface.php?record_id=" + record_id,
			type: 'GET',
			data: JSON.stringify({ paramName: batch }),
			dataType: 'json',
			contentType: "application/json; charset=utf-8",
			success: function (data, textStatus) {
    			$('#record_id_modal').text(data[0].record_id);
    			$('#message_id_modal').text(data[0].message_id);
				$('#record_type_modal').text(data[0].record_type);
				$('#record_timestamp_modal').text(data[0].record_timestamp);
				$('#event_name_modal').text(data[0].event_name);
				$('#status_modal').text(data[0].status);
				$('#scode_modal').text(data[0].scode_modal);
				$('#hand_phone_no').text(data[0].hand_phone_no);
				$('#rq_uuid_modal').text(data[0].rq_uuid);
				//jQuery.noConflict(); //  Need to define this to avoid conflict. Not sure since the library loaded order already seems correct
				drawModalTable(rq_uuid);
				$("#popupModal").modal("show");
                $("#popupModal").on("shown.bs.modal", function() { // Need to trigger this to fix header of the modal not showing correct length!!
					modalTable.columns.adjust();
				});
			},
			error: function (xhr, ajaxOptions, thrownError) {
				messageBox("Failed", "Internal system error! Please contact administrator for further assistant.");
			}
		});
		console.timeEnd("Modal Data Fetch");
	}

	function drawTable() {
		console.time("Table Render");
		$.fn.dataTable.moment('YYYY-MM-DD HH:mm:ss');
		$.fn.dataTable.ext.errMode = "throw";
     	mainModalTable = $('#dataTables').DataTable({
 	 		ajax: {
     			url: "page/paging/smsInterfacePagination.php?search1=" + search1 +"&search2="
     				+ search2 + "&event_name=" + event_name + "&req_status=" + req_status + "&record_type=" + record_type
     				+ "&messageId=" + messageId + "&handphoneNo=" + handphoneNo 
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
                    "render": function ( data, type, row ) {
                        return "<button onclick=\"showDetails('" + data + "', '" + row[10] + "')\" " + "id=\"modal\" class=\"btn btn-xs btn-emp\" style=\"min-width: 0px;color:black;\">" + 
							   "<i class=\"fas fa-bars\" style=\"font-size: 7px;\"></i></button>";
                    },
                    "sWidth": "5%",
                    "targets": 0
                },
                {
            		"className": "details-control",
                    "orderable": false,
                    "data": null,
                    "defaultContent": "",
                    "targets": 1
                },
                { "stype": "date", "targets": 3 }
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
			"order": [[ 3, "desc" ]]
		}).on( "error.dt", function ( e, settings, techNote, message ) {
			messageBox("Failed", message);
        });
		console.timeEnd("Table Render");
 	}

	function drawModalTable(rq_uuid) {
		// Modal datatable implementation
		$.fn.dataTable.ext.errMode = "throw";
		modalTable = $("#dataTablesModal").DataTable({
     		ajax: {
    			url: "page/interface/online/onlineInterfaceDataTable.php?rq_uuid=" + rq_uuid,
    		},
    		dom: "<lif<t>Bp>",
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
                    "className": "details-control",
                    "orderable": false,
                    "data": null,
                    "defaultContent": "",
                    "targets": 0
                },
                { "stype": "date", "targets": 1 },
                { "stype": "date", "targets": 2 },
                { "stype": "date", "targets": 7 }
            ],
            "buttons": [
                {
                    "extend": "excel",
                    "text": '<button class="btn"><i class="fa fa-file-excel" style="color: green;"></i></button>',
                    "titleAttr": "Excel",
                    "action": newexportaction
                }
            ],
			initComplete: function() {
				$('.buttons-excel').html('<i class="far fa-file-excel style="color: green;"" />');
		    },
			"order": [[ 2, "desc" ]]
		}).on( "error.dt", function ( e, settings, techNote, message ) {
			messageBox("Failed", message);
        });
	}

	function formatMain(d) {
   	    // `d` is the original data object for the row
   	    return	'<b>SMS Content</b><br />' + d[1];
   	}

	function format(d) {
   	    // `d` is the original data object for the row
   	    if (d[1] == "ERROR") {
			return	'<b>Error CD</b><br />' +
					d[21] + '<br /><br />' +
   	   	    		'<b>Error Message</b><br />' +
   	   	    		d[22] + '<br /><br />' +
   	   	    		'<b>Error Details</b><br />' +
   	   	    		d[23] + '<br /><br />' +
   	   	    		'<b>Error Exception</b><br />' +
   	   	    		d[24] + '<br /><br />' +
   	   	    		'<b>Error Payload</b><br />' +
   	   	    		d[25] + '<br /><br />' +
   	   	    		'<b>Error JSON Payload</b><br />' +
   	            	d[26];
   	    } else {
   	    	var temp;
   	    	
   	    	if (d[19] == null || d[19] == "NULL") {
   	    		temp = d[20];
   	    	} else {
   	    		temp = d[19];
   	    	}

   	   	    return	'<b>Payload</b><br />' +
   	            	temp;
   	    }
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
	<?php include ("page/modal/sms/smsModal.php"); ?>
	<?php include ("page/modal/user/userChangePasswordModal.php"); ?>

	<?php include ("include/modal/popupModal.php"); ?>
	<?php include ("include/functions/changePassword.php"); ?>
</body>
</html>