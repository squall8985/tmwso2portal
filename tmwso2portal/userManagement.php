<?php
error_reporting(E_ALL & ~E_NOTICE);
include ("DBConn/connectionInfo.php");
require_once('functions/auth.php');
include ("include/username.php");

$startGet = $_GET["startDate"];
$endGet = $_GET["endDate"];

$tz = "Asia/Kuala_Lumpur";
$timestamp = time();

$start = new DateTime("now", new DateTimeZone($tz));
$start->setTimestamp($timestamp);
$start->modify("-360 day");

$end = new DateTime("now", new DateTimeZone($tz));
$end->setTimestamp($timestamp);
$end->modify("+1 day");

// Use in menu.php
$MODULE = "USERMANAGEMENT";
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
    	var search1 = "<?php if (isset($startGet)) { echo $startGet; } else { echo $start->format("Y-m-d H:i:s"); }?>";
    	var search2 = "<?php if (isset($endGet)) { echo $endGet; } else { echo $end->format("Y-m-d H:i:s"); }?>";
    	var search3 = "<?php if (isset($startGet)) { echo $startGet; } else { echo $start->format("Y-m-d H:i:s"); }?>";
    	var search4 = "<?php if (isset($endGet)) { echo $endGet; } else { echo $end->format("Y-m-d H:i:s"); }?>";
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
            width:800px;
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
               <h1 class="page-header">User Management</h1>
            </div>
         </div>
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     User Management Data
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
                                            <input class="form-control search" name="createdDatepicker" style="width:350px" id="createdDatepicker" type="text" value="<?php if (isset($startGet)) { echo $startGet; } else { echo $start->format("Y-m-d H:i:s"); }?> - <?php if (isset($endGet)) { echo $endGet; } else { echo $end->format("Y-m-d H:i:s"); }?>" />
                                        </div>
                                  	</td>
                                  	<td>
                                  		<div class="">
                                             <label>Last Login search range:</label>
                                        </div>
										<div class="bootstrap-timepicker">
                                            <input class="form-control search" name="lastLoginDatepicker" style="width:350px" id="lastLoginDatepicker" type="text" value="" />
                                        </div>
                                  	</td>
                                  </tr>
                                  <tr>
                                  	<td>
    									<div class="">
                                        	<label>Username:</label>
                                        </div>
                                        <div class="">
                                        	<input value="<?php if (isset($user_name_search)) { echo $user_name_search; }?>" class="form-control search" name="user_name_search" id="user_name_search" style="width:300px" type="text" maxlength="200" />
                                         	<br />
                                        </div>
                                  	</td>
                                  	<td>
    									<div class="">
                                        	<label>Name:</label>
                                        </div>
                                        <div class="">
                                        	<input value="<?php if (isset($name_search)) { echo $name_search; }?>" class="form-control search" name="name_search" id="name_search" style="width:300px" type="text" maxlength="200" />
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
                                        	<button type="submit" name="btnAddUser" id="btnAddUser" class="btn btn-primary" title="Checking" onClick="addUser();">
                                        	<i class="fa fa-users" aria-hidden="true"></i> Add User
                                        	</button>
                                        </div>
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
                                          	 <th style="font-size:12px; vertical-align:middle;">USERNAME</th>
                                             <th style="font-size:12px; vertical-align:middle;">NAME</th>
                                             <th style="font-size:12px; vertical-align:middle;">STATUS</th>
                                             <th style="font-size:12px; vertical-align:middle;">LAST LOGIN</th>
                                             <th style="font-size:12px; vertical-align:middle;">DASHBOARD</th>
                                             <th style="font-size:12px; vertical-align:middle;">BUSINESS EVENT</th>
                                             <th style="font-size:12px; vertical-align:middle;">ONLINE</th>
                                             <th style="font-size:12px; vertical-align:middle;">BATCH</th>
                                             <th style="font-size:12px; vertical-align:middle;">SMS</th>
                                             <th style="font-size:12px; vertical-align:middle;">QUERY</th>
                                             <th style="font-size:12px; vertical-align:middle;">USER MANAGEMENT</th>
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
	var mainModalTable;

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
            opens: "right",
            timePickerSeconds: true,
            autoUpdateInput: true,
            ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
        	}
        	}, function (start, end, label) {
                search1 = start.format("YYYY-MM-DD HH:mm:ss");
                search2 = end.format("YYYY-MM-DD HH:mm:ss");
        });

		$('input[name="lastLoginDatepicker"]').daterangepicker({
        	timePicker: true,
            endDate: '<?php if (isset($endGet)) { echo $endGet; } else { echo $end->format('Y-m-d H:i:s'); }?>', // This implementation to cater click event from SOQ Query module
            startDate: '<?php if (isset($startGet)) { echo $startGet; } else { echo $start->format('Y-m-d H:i:s'); }?>', // This implementation to cater click event from SOQ Query module
            locale: {
        		format: 'YYYY-MM-DD HH:mm:ss'
        	},
            opens: "right",
            timePickerSeconds: true,
            autoUpdateInput: true,
            ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
        	}
        	}, function (start, end, label) {
                search3 = start.format("YYYY-MM-DD HH:mm:ss");
                search4 = end.format("YYYY-MM-DD HH:mm:ss");
        });

        $("#btnSearch").click(function() {
            name_search = $("#name_search").val();
            user_name_search = $("#user_name_search").val();
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
                    $("div.navbar-collapse").addClass("collapse")
                    topOffset = 100; // 2-row-menu
                } else {
                    $("div.navbar-collapse").removeClass("collapse")
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

	function showDetails(id) {
		console.time("Modal Data Fetch");
		var batch = {
			"id": id
		};

		$.ajax({
			url: "page/interface/userManagement/userManagementInterface.php?id=" + id,
			type: "GET",
			data: JSON.stringify({ paramName: batch }),
			dataType: "json",
			contentType: "application/json; charset=utf-8",
			success: function (data, textStatus) {
    			$("#modalName").text(data[0].name);
    			$("#modalUsername").text(data[0].username);
    			
    			if (data[0].status == 1) {
    				$("#modalStatus").text("Enable");
    			} else {
    				$("#modalStatus").text("Disable");
    			}
    			
				$("#modalLastLogin").text(data[0].last_login_timestamp);
				$("#modalUserCreated").text(data[0].created_timestamp);
				$("#modalLastUpdated").text(data[0].updated_timestamp);
				//jQuery.noConflict(); //  Need to define this to avoid conflict. Not sure since the library loaded order already seems correct
				drawModalTable(id);
                $("#popupModal").modal("show");
                $("#popupModal").on("shown.bs.modal", function() { // Need to trigger this to fix header of the modal not showing correct length!!
					modalTable.columns.adjust();
				});
			},
			error: function (xhr, ajaxOptions, thrownError) {
				messageBox("Failed", thrownError);
			}
		});
		console.timeEnd("Modal Data Fetch");
	}

	function addUser() {
		$("#popupModalAddUserName").val("");
		$("#popupModalAddUserUsername").val("");
		$("#popupModalAddUserPassword").val("");
		$("#popupModalAddUserNameMessage").html("");
		$("#popupModalAddUserUsernameMessage").html("");
		$("#popupModalAddUserPasswordMessage").html("");

		checkboxUncheck("#popupModalAddUserDashboard");
		checkboxUncheck("#popupModalAddUserBusinessEvent");
		checkboxUncheck("#popupModalAddUserOnline");
		checkboxUncheck("#popupModalAddUserBatch");
		checkboxUncheck("#popupModalAddUserSMS");
		checkboxUncheck("#popupModalAddUserQuery");
		checkboxUncheck("#popupModalAddUserUserManagement");

		$("#popupModalAddUserDashboard").prop("checked",true);
		$("#popupModalAddUserDashboard").prop("disabled",true);

		$("#popupModalAddUser").modal("show");
		$("#popupModalAddUserName").focus();
	}

	function addUserSubmitAjax() {
		var isEmail = false;
		var isValidPassword = false;
		var isExistUsername = false;
		var check = true;
    	var input = $(".addModal.input100");
    
    	for (var i = 0; i < input.length; i++) {
    		if (validate(input[i]) == false) {
    			showValidate(input[i]);
    			check = false;
    		}
    	}
    
    	if (check == true) {
    		for (var i = 0; i < input.length; i++) {
        		hideValidate(input[i]);
        	}

			if (check == true && passwordValidation($("#popupModalAddUserPassword").val())) {
    			isValidPassword = true;

				if (check == true && isValidPassword == true) {
					if (!isThisEmail($("#popupModalAddUserUsername").val())) {
            			isEmail = false;
            			$("#popupModalAddUserMessage").html("Please use valid email");
            			$("#popupModalAddUserUsername").select();
            		} else {
            			isEmail = true;

						if (check == true && isValidPassword == true && isEmail == true) {
							if (checkIsExistUsername($("#popupModalAddUserUsername").val(), "#popupModalAddUser") == true) {
                    			isExistUsername = true;
                    			$("#popupModalAddUserMessage").html("This username is already in use.");
                    			$("#popupModalAddUserUsername").select();
                    		} else {
                    			isExistUsername = false;
                    			$("#popupModalAddUserMessage").html("");
                    		}
        				}
            		}
				}
    		} else {
    			$("#popupModalAddUserMessage").html("Password need to be minimum 8 characters and combination of a-z, A-Z, 0-9 and symbol.");
    			$("#popupModalAddUserPassword").select();
    			isValidPassword = false;
    		}
    	}

		if (check == true && isValidPassword == true && isExistUsername == false && isEmail == true) {
			console.time("Add Data User");
    		var addData = {
    			"name": $("#popupModalAddUserName").val(),
    			"username": $("#popupModalAddUserUsername").val(),
    			"password": $("#popupModalAddUserPassword").val(),
    			"role_dashboard": $("input[name=\"popupModalAddUserDashboard\"]:checked").val(),
    			"role_business": $("input[name=\"popupModalAddUserBusinessEvent\"]:checked").val(),
    			"role_online": $("input[name=\"popupModalAddUserOnline\"]:checked").val(),
    			"role_batch": $("input[name=\"popupModalAddUserBatch\"]:checked").val(),
    			"role_sms": $("input[name=\"popupModalAddUserSMS\"]:checked").val(),
    			"role_query": $("input[name=\"popupModalAddUserQuery\"]:checked").val(),
    			"role_user_management": $("input[name=\"popupModalAddtUserUserManagement\"]:checked").val()
    		};
    
    		$.ajax({
    			data : addData,
    			dataType: "json",
    			type: "POST",
    			url: "page/interface/userManagement/userManagementInterfaceUserAdd.php",
    			complete: function (xhr, ajaxOptions, thrownError) {
    				if (xhr.responseText == null || xhr.responseText == "") {
    					$("#btnSearch").click();
    					$("#popupModalAddUser").modal("hide");
    					messageBox("Success", "Record added.");
    				} else {
    					$("#popupModalAddUser").modal("hide");
    					messageBox("Failed", xhr.responseText);
    				}
    			}
    		});
    		console.timeEnd("Add Data User");
		}
	}

	function editUser(id, name, username, status, lastLogin, roleDashboard, roleBusinessEvent, roleOnline, roleBatch, roleSMS, roleQuery, roleUserManagement) {
		$("#popupModalEditUserId").val(id);
		$("#popupModalEditName").val(name);
		$("#popupModalEditUserUsername").text(username);
		$("#popupModalEditUserStatus").text(status);
		$("#popupModalEditUserLastLogin").text(lastLogin);

		formatCheck("#popupModalEditUserDashboard", roleDashboard);
		formatCheck("#popupModalEditUserBusinessEvent", roleBusinessEvent);
		formatCheck("#popupModalEditUserOnline", roleOnline);
		formatCheck("#popupModalEditUserBatch", roleBatch);
		formatCheck("#popupModalEditUserSMS", roleSMS);
		formatCheck("#popupModalEditUserQuery", roleQuery);
		formatCheck("#popupModalEditUserUserManagement", roleUserManagement);
		$("#popupModalEditUser").modal("show");
	}

	function editUserSubmitAjax() {
		$("#popupModalEditUserNameMessage").html("&nbsp;");

		if (editUserSubmitAjaxValidation($("#popupModalEditName").val())) {
			console.time("Modal Data Fetch");
    		var editData = {
    			"id": $("#popupModalEditUserId").val(),
    			"name": $("#popupModalEditName").val(),
    			"role_dashboard": $("input[name=\"popupModalEditUserDashboard\"]:checked").val(),
    			"role_business": $("input[name=\"popupModalEditUserBusinessEvent\"]:checked").val(),
    			"role_online": $("input[name=\"popupModalEditUserOnline\"]:checked").val(),
    			"role_batch": $("input[name=\"popupModalEditUserBatch\"]:checked").val(),
    			"role_sms": $("input[name=\"popupModalEditUserSMS\"]:checked").val(),
    			"role_query": $("input[name=\"popupModalEditUserQuery\"]:checked").val(),
    			"role_user_management": $("input[name=\"popupModalEditUserUserManagement\"]:checked").val()
    		};
    
    		$.ajax({
    			data : editData,
    			dataType: "json",
    			type: "POST",
    			url: "page/interface/userManagement/userManagementInterfaceUserEdit.php",
    			complete: function (xhr, ajaxOptions, thrownError) {
    				if (xhr.responseText == null || xhr.responseText == "") {
    					$("#btnSearch").click();
    					$("#popupModalEditUser").modal("hide");
    					$("#popupModalEditUserNameMessage").html("");
    					messageBox("Success", "Record updated.");
    				} else {
    					$("#popupModalEditUser").modal("hide");
    					$("#popupModalEditUserNameMessage").html("");
    					messageBox("Failed", xhr.responseText);
    				}
    			}
    		});
    		console.timeEnd("Modal Data Fetch");
		} else {
			$("#popupModalEditUserNameMessage").html("Name can't be empty");
		}
	}

	function editUserSubmitAjaxValidation(name) {
		if (name != "") {
			return true;
		} else {
			return false;
		}
	}

	function changePassword(id, name, username, status) {
		$("#popupModalChangePasswordMessage").html("");
		$("#popupModalChangePasswordId").val(id);
		$("#popupModalChangePasswordName").text(name);
		$("#popupModalChangePasswordUsername").text(username);
		$("#popupModalChangePasswordStatus").text(status);
		$("#popupModalChangePassword").modal("show");
	}

	function changePasswordAjax() {
		if (passwordValidation($("#popupModalChangePasswordPassword").val())) {
			console.time("Modal Data Fetch");
    		var changePasswordData = {
    			"id": $("#popupModalChangePasswordId").val(),
    			"password": $("#popupModalChangePasswordPassword").val(),
    		};
    
    		$.ajax({
    			data : {"id" : $("#popupModalChangePasswordId").val(), "password" : $("#popupModalChangePasswordPassword").val()},
    			dataType: "json",
    			type: "POST",
    			url: "page/interface/userManagement/userManagementInterfaceUserChangePassword.php",
    			complete: function (xhr, ajaxOptions, thrownError) {
    				if (xhr.responseText == null || xhr.responseText == "") {
    					$("#popupModalChangePassword").modal("hide");
    					$("#popupModalChangePasswordMessage").html("");
    					messageBox("Success", "Record updated.");
    				} else {
    					$("#popupModalChangePassword").modal("hide");
    					$("#popupModalChangePasswordMessage").html("");
    					messageBox("Failed", xhr.responseText);
    				}
    			}
    		});
    		console.timeEnd("Modal Data Fetch");
		} else {
			$("#popupModalChangePasswordMessage").html("Password need to be <br />- minimum 8 characters<br />- combination of a-z, A-Z, 0-9 and symbol.");
		}
	}

	function toggleUserStatus(id, status) {
		if (<?php echo $_SESSION["SESS_MEMBER_ID"];?> == id) {
			messageBox("Error", "You can't disable your own account.");
		} else {
			confirmDialog(id, status);
		}
	}
	
	function toggleUserStatusAjax(id, status) {
		$.ajax({
			data : {"record_id" : id, "status" : status},
			dataType: "json",
			type: "POST",
			url: "page/interface/userManagement/userManagementInterfaceUserDisable.php",
			complete: function (xhr, ajaxOptions, thrownError) {
				if (xhr.responseText == null || xhr.responseText == "") {
					$("#btnSearch").click();
					messageBox("Success", "Record updated.");
				} else {
					messageBox("Failed", xhr.responseText);
				}
			}
		});
	}

	function confirmDialog(id, status) {
		var message;
		
		if (status == "Enable") {
			message = "Are you sure want to disable this user?";
		} else {
			message = "Are you sure want to enable this user?";
		}

		$('<div></div>').appendTo('body')
    	.html('<div><h6>' + message + '?</h6></div>')
    	.dialog({
            modal: true,
            title: 'Delete message',
            zIndex: 10000,
            autoOpen: true,
            width: 'auto',
            resizable: false,
            buttons: {
				Yes: function() {
                    $(this).dialog("close");
                    toggleUserStatusAjax(id, status)
        		},
				No: function() {
                    $(this).dialog("close");
        		}
			},
      		close: function(event, ui) {
        		$(this).remove();
      		}
    	});
    }

	function drawTable() {
		console.time("Table Render");
		$.fn.dataTable.moment("YYYY-MM-DD HH:mm:ss");
		$.fn.dataTable.ext.errMode = "throw";
     	mainModalTable = $("#dataTables").DataTable({
 	 		ajax: {
     			url: "page/paging/userManagementInterfacePagination.php?search1=" + search1 +"&search2="
     				+ search2 + "&search3=" + search3 + "&search4=" + search4 + "&name_search=" + name_search
     				+ "&user_name_search=" + user_name_search
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
            		"className": "dt-center",
            		"targets": "_all"
            	},
            	{
            		"render": function ( data, type, row ) {
            			userStatusColor = "green";

            			if (row[3] == "Enable") {
            				userStatusColor = "red";
            			} else if (row[3] == "Disable") {
            				userStatusColor = "green";
            			}

                    	var temp = "<button onclick=\"showDetails('" + data + "')\" " + "id=\"modal\" class=\"btn btn-xs btn-emp\" style=\"min-width: 0px;color:black;\">" + 
							   	   		"<i title=\"Details\" class=\"fas fa-bars\" style=\"font-size: 11px;\"></i>" +
							   	   "</button>" +
							   	   "<button onclick=\"toggleUserStatus('" + data + "', '" + row[3] + "')\" " + "id=\"modal\" class=\"btn btn-xs btn-emp\" style=\"min-width: 0px;color:" + userStatusColor + ";\">" + 
							   	   		"<i title=\"Disable\" class=\"fas fa-power-off\" style=\"font-size: 11px;\"></i>" +
							   	   "</button>" +
							   	   "<button onclick=\"changePassword('" + row[0] + "', '" + row[2] + "', '" + row[1] + "', '" + row[3] + "')\" " + "id=\"modal\" class=\"btn btn-xs btn-emp\" style=\"min-width: 0px;color:purple;\">" + 
							   	   		"<i title=\"Disable\" class=\"fas fa-key\" style=\"font-size: 11px;\"></i>" +
							   	   "</button>" +
							   	   "<button onclick=\"editUser('" + row[0] + "','" + row[2] + "','" + row[1] + "','" + row[3] + "','" + row[4] + "','" + row[5] + "','" + row[6] + "','" + row[7] + "','" + row[8] + "','" + row[9] + "','" + row[10] + "','" + row[11] + "')\" " + "id=\"modal\" class=\"btn btn-xs btn-emp\" style=\"min-width: 0px;color:blue;\">" + 
							   	   		"<i title=\"Edit\" class=\"fas fa-edit\" style=\"font-size: 11px;\"></i>" +
							   	   "</button>";
                        return temp;
                    },
                    "targets": 0,
                    "width": "400px"
                },
            	{
                    "render": function (data, type, row) {
                    	return formatRoles(data);
                    },
                    "targets": 5
                },
                {
                    "render": function (data, type, row) {
                    	return formatRoles(data);
                    },
                    "targets": 6
                },
                {
                    "render": function (data, type, row) {
                    	return formatRoles(data);
                    },
                    "targets": 7
                },
                {
                    "render": function (data, type, row) {
                    	return formatRoles(data);
                    },
                    "targets": 8
                },
                {
                    "render": function (data, type, row) {
                    	return formatRoles(data);
                    },
                    "targets": 9
                },
                {
                    "render": function (data, type, row) {
                    	return formatRoles(data);
                    },
                    "targets": 10
                },
                {
                    "render": function (data, type, row) {
                    	return formatRoles(data);
                    },
                    "targets": 11
                }
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
				$(".buttons-excel").html('<i class="far fa-file-excel style="color: green;"" />');
		    },
			"order": [[ 4, "asc" ]]
		}).on( "error.dt", function ( e, settings, techNote, message ) {
			messageBox("Failed", message);
        });
		console.timeEnd("Table Render");
 	}

	function newexportaction(e, dt, button, config) {
        var self = this;
        var oldStart = dt.settings()[0]._iDisplayStart;
        dt.one("preXhr", function (e, s, data) {
             // Just this once, load all data from the server...
             data.start = 0;
             data.length = 2147483647;
             dt.one("preDraw", function (e, settings) {
                 // Call the original action function
                 if (button[0].className.indexOf("buttons-copy") >= 0) {
                     $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf("buttons-excel") >= 0) {
                     $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf("buttons-pdf") >= 0) {
                     $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf("buttons-csv") >= 0) {
                     $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
                         $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
                         $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
                 } else if (button[0].className.indexOf("buttons-print") >= 0) {
                     $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
                 }
                 dt.one("preXhr", function (e, s, data) {
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

	function drawModalTable(id) {
		// Modal datatable implementation
		$.fn.dataTable.ext.errMode = "throw";
		modalTable = $("#dataTablesModal").DataTable({
     		ajax: {
    			url: "page/interface/userManagement/userManagementInterfaceDataTable.php?id=" + id,
    		},
    		dom: "t",
			language: {
				sLoadingRecords: '<span style="width:100%;">Loading.. <img src="images/ajaxload.gif"> Please wait....</span>'
			},
			"bAutoWidth": true,
			"bDestroy": true,
			"bServerSide": true,
			"bProcessing": true,
            "bDeferRender": true,
            "iDisplayLength": 10,
            "columnDefs": [
            	{
            		"className": "dt-center",
            		"targets": "_all"
            	},
            	{
                    "render": function (data, type, row) {
                    	return formatRoles(data);
                    },
                    "targets": 0
                },
                {
                    "render": function (data, type, row) {
                    	return formatRoles(data);
                    },
                    "targets": 1
                },
                {
                    "render": function (data, type, row) {
                    	return formatRoles(data);
                    },
                    "targets": 2
                },
                {
                    "render": function (data, type, row) {
                    	return formatRoles(data);
                    },
                    "targets": 3
                },
                {
                    "render": function (data, type, row) {
                    	return formatRoles(data);
                    },
                    "targets": 4
                },
                {
                    "render": function (data, type, row) {
                    	return formatRoles(data);
                    },
                    "targets": 5
                },
                {
                    "render": function (data, type, row) {
                    	return formatRoles(data);
                    },
                    "targets": 6
                }
            ]
		}).on( "error.dt", function ( e, settings, techNote, message ) {
			messageBox("Failed", message);
        });
	}

	function formatRoles(data) {
   	    // `d` is the original data object for the row
   	    if (data == true) {
   	    	var temp = "<i class=\"fas fa-check\" style=\"font-size: 15px; color: green;\">";
   	    	return temp;
   	    } else {
   	    	var temp = "<i class=\"fas fa-times\" style=\"font-size: 15px; color: red;\">";
   	    	return temp;
   	    }
   	}
	</script>
	<?php include ("page/modal/userManagement/userManagementModal.php"); ?>
	<?php include ("page/modal/userManagement/userManagementChangePasswordModal.php"); ?>
	<?php include ("page/modal/userManagement/userManagementEditModal.php"); ?>
	<?php include ("page/modal/userManagement/userManagementAddModal.php"); ?>
	<?php include ("page/modal/user/userChangePasswordModal.php"); ?>
	
	<?php include ("include/modal/popupModal.php"); ?>
	<?php include ("include/functions/changePassword.php"); ?>
</body>
</html>