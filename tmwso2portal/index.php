<?php
$timeout = $_GET["timeout"];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
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
        <link rel="stylesheet" type="text/css" href="js/plugins/dataTables/DataTables-1.10.18/css/dataTables.semanticui.min.css" />
        <link rel="stylesheet" type="text/css" href="js/plugins/dataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css" />
        <link rel="stylesheet" type="text/css" href="js/plugins/dataTables/datatables.min.css" />
        <link rel="stylesheet" type="text/css" href="js/plugins/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" type="text/css" href="js/plugins/selective/css/selectize.bootstrap3.css" />
        <link rel="stylesheet" type="text/css" href="css/jquery-ui.css" rel="stylesheet" />
        <script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
<body>
<div class="limiter">
    <div class="container-login100">
    	<div class="wrap-login100">
    		<div style="margin:auto" class="" align="center">
    			<img style="margin:auto;width:55%" src="images/unifi-logo-telekom.png">
    		</div>
            <span class="login100-form-title">
            	Welcome
            </span>
            <span class="login100-form-subtitle">
            	Log in to Smart Biz API Support Portal
            </span>
            <div class="login100-form validate-form">
                <div class="wrap-input100 validate-input" data-validate="Username is required">
                    <input class="input100" type="text" name="username" id="username" placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                    	<i class="fa fa-user" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="pass" id="pass" placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                    	<i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="container-login100-form-btn">
                    <font id="messagePlacer" style="color: red;"></font>
    			</div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" id="loginButton">
                    	Log in
                    </button>
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
	$("#loginButton").click(function() {
		validateFormSubmit();
	});

	<?php
	if (isset($timeout) && $timeout == "timeout") {
	   echo "$(\"#messagePlacer\").html(\"Your account is use in another browser.\");";
	} else if (isset($timeout) && $timeout == "accountDeleted") {
	    echo "$(\"#messagePlacer\").html(\"Your account has been deleted.<br />Please contact administrator.\");";
	} else if (isset($timeout) && $timeout == "disabled") {
	    echo "$(\"#messagePlacer\").html(\"Your account has been disabled.<br />Please contact administrator.\");";
	}
	?>
});

function validateFormSubmit() {
	var check = true;
	var input = $(".input100");

	for (var i = 0; i < input.length; i++) {
		if (validate(input[i]) == false) {
			showValidate(input[i]);
			check = false;
		}
	}

	if (check == true) {
		loginAjax();
	}
}

function validate(input) {
	if ($(input).attr("type") == "email" || $(input).attr("name") == "email") {
		if ($(input)
				.val()
				.trim()
				.match(
						/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
			return false;
		}
	} else {
		if ($(input).val().trim() == "") {
			return false;
		}
	}
}

function showValidate(input) {
	var thisAlert = $(input).parent();
	$(thisAlert).addClass("alert-validate");
}

function hideValidate(input) {
	var thisAlert = $(input).parent();
	$(thisAlert).removeClass('alert-validate');
}

function loginAjax() {
	console.time("Data Fetch");
	var loginData = {
		"username": $("#username").val(),
		"pass": $("#pass").val()
	};

	$.ajax({
		data : loginData,
		dataType: "json",
		type: "POST",
		url: "functions/validateUserLogin.php",
		complete: function (xhr, ajaxOptions, thrownError) {
			if (xhr.responseText == null || xhr.responseText == "") {
				// Will not happen
			} else if (xhr.responseText == "Success login") {
				window.location.href = "TMindex.php";
			} else {
				//messageBox("Failed", xhr.responseText);
				$("#messagePlacer").html(xhr.responseText);
			}
		}
	});
	console.timeEnd("Data Fetch");
}
</script>
<?php include ("include/modal/popupModal.php"); ?>
</body>
</html>