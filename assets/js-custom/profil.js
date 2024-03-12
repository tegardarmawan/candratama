get_profil();

document.addEventListener("DOMContentLoaded", function () {
	var showPasswordCheckbox = document.getElementById("showPasswordCheckbox");
	var passwordInput = document.getElementById("password");
	var passwordInput1 = document.getElementById("password1");

	showPasswordCheckbox.addEventListener("change", function () {
		if (showPasswordCheckbox.checked) {
			passwordInput.type = "text";
			passwordInput1.type = "text";
		} else {
			passwordInput.type = "password";
			passwordInput1.type = "password";
		}
	});
});

function showAlertifySuccess(message) {
	$("body").append(alertify.success(message));
}

function showAlertifyError(message) {
	$("body").append(alertify.error(message));
}

function delete_form() {
	$("[name='nama']").val("");
	$("[name='credential']").val("");
	$("[name='username']").val("");
	$("[name='password']").val("");
	$("[name='password1']").val("");
}

function delete_error() {
	$("#error-nama").hide();
	$("#error-credential").hide();
	$("#error-username").hide();
	$("#error-password").hide();
	$("#error-password1").hide();
}

get_profil();

function get_profil() {
	$.ajax({
		url: base_url + "/" + _controller + "/get_profil",
		method: "GET",
		dataType: "json",
		success: function (data) {
			$("[name='id']").val(data[0].id);
			$("[name='nama']").val(data[0].nama);
			$("[name='username']").val(data[0].username);
			$("[name='password']").val(data[0].password);
		},
		error: function (xhr, textStatus, errorThrown) {
			console.log(xhr.statusText);
		},
	});
}
// ajax edit_profil
function edit_profil() {
	var formData = new FormData();
	formData.append("id", $("[name='id']").val());
	formData.append("nama", $("[name='nama']").val());
	formData.append("username", $("[name='username']").val());
	formData.append("password1", $("[name='password1']").val());

	$.ajax({
		type: "POST",
		url: base_url + "/" + _controller + "/edit_profil",
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function (response) {
			if (response.errors) {
				delete_error();
				for (var fieldName in response.errors) {
					$("#error-" + fieldName).show();
					$("#error-" + fieldName).html(response.errors[fieldName]);
				}
			} else if (response.success) {
				delete_error();
				delete_form();
				showAlertifySuccess(response.success);
				get_profil();
			}
		},
		error: function (xhr, status, error) {
			console.error("AJAX Error: " + error);
		},
	});
}
