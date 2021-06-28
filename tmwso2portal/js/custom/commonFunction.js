function passwordValidation(validate) {
	var res;

	if (validate.match(/[a-z]/g) && validate.match(/[A-Z]/g) && validate.match(/[0-9]/g) && validate.match(/[^a-zA-Z\d]/g) && validate.length >= 8)
    	res = true
	else
    	res = false;

	return res;
}

function formatCheck(element, data) {
    // `d` is the original data object for the row
    if (data == "true") {
    	$(element).prop("checked", true);
    } else {
    	$(element).prop("checked", false);
    }
}

function checkboxUncheck(element) {
    // `d` is the original data object for the row
    $(element).prop("checked", false);
}

function checkUsernameExist(data, modalId) {
	var isExist = "false";
    var datas = {
			"username": data
	};

	return $.ajax({
		data : {"username" : data},
		dataType: "json",
		type: "POST",
		async: false,
		url: "functions/checkUsernameExist.php?username=",
		complete: function (xhr, ajaxOptions, thrownError) {
			if (ajaxOptions == "success") {
				if (xhr.responseText == "true") {
					isExist = "true";
				} else if (xhr.responseText == "false") {
					isExist = "false";
				}
			} else {
				$(modalId).modal("hide");
				messageBox("Failed", xhr.responseText);
			}
		}
	});
}

function checkIsExistUsername(data, modalId) {
	var temp;

	var promise = checkUsernameExist(data, modalId);
	promise.done(function(result) {
		temp = result;
	});
	
	return temp;
}

function isThisEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}