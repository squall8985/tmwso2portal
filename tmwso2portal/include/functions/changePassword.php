<script>
function changePasswordPersonal(id, name, username) {
	$("#popupModalPersonalChangePasswordMessage").html("");
	$("#popupModalPersonalChangePasswordId").val(id);

	$("#popupModalPersonalChangePasswordName").text(name);
	$("#popupModalPersonalChangePasswordUsername").text(username);

	$("#popupModalPersonalChangePasswordPassword").val("");
	$("#popupModalPersonalChangePasswordPasswordConfirm").val("");

	$("#popupModalPersonalChangePassword").modal("show");
}

function validateFormSubmit(id) {
	var check = true;
	var input = $(".input100");

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

		if ($("#popupModalPersonalChangePasswordPassword").val() != $("#popupModalPersonalChangePasswordPasswordConfirm").val()) {
			$("#popupModalPersonalChangePasswordMessage").html("<b>Password</b> and <b>Confirm Password</b> not match.");
		} else {
			if (!passwordValidation($("#popupModalPersonalChangePasswordPassword").val())) {
				$("#popupModalPersonalChangePasswordMessage").html("Password need to be <br />- minimum 8 characters<br />- combination of a-z, A-Z, 0-9 and symbol.");
			} else {
				$("#popupModalPersonalChangePasswordMessage").html("");
				changePasswordPersonalAjax(id, $("#popupModalPersonalChangePasswordPassword").val());
			}
		}
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

function changePasswordPersonalAjax(id, password) {
	console.time("Password updated");
	var changePasswordData = {
		"id": id,
		"password": password,
	};

	$.ajax({
		data : changePasswordData,
		dataType: "json",
		type: "POST",
		url: "page/interface/userManagement/userManagementInterfaceUserChangePassword.php",
		complete: function (xhr, ajaxOptions, thrownError) {
			if (xhr.responseText == null || xhr.responseText == "") {
				$("#popupModalPersonalChangePassword").modal("hide");
				messageBox("Success", "Password updated.");
			} else {
				$("#popupModalPersonalChangePassword").modal("hide");
				messageBox("Failed", xhr.responseText);
			}
		}
	});
	console.timeEnd("Password updated");
}
</script>