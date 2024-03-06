get_data();

$(".bs-example-modal-center").on("show.bs.modal", function (e) {
	var button = $(e.relatedTarget);
	var id = button.data("id");
	var modalButton = $(this).find("#btn-hapus");
	modalButton.attr("onclick", "delete_data(" + id + ")");
});

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
	$("[name='kode']").val("");
	$("[name='nama']").val("");
	$("[name='credential']").val("");
	$("[name='username']").val("");
	$("[name='password']").val("");
	$("[name='password1']").val("");
}

function delete_error() {
	$("#error-kode").hide();
	$("#error-nama").hide();
	$("#error-credential").hide();
	$("#error-username").hide();
	$("#error-password").hide();
	$("#error-password1").hide();
}

// hak akses superadmin

function get_data() {
	delete_error();
	$.ajax({
		url: base_url + _controller + "/get_data",
		method: "GET",
		dataType: "json",
		scrollY: 320,
		scrollX: true,
		responsive: true,
		success: function (data) {
			var table = $("#datatable-buttons").DataTable({
				destroy: true,
				scrollY: 400,
				data: data,
				responsive: true,
				columns: [
					{ data: "kode" },
					{ data: "nama" },
					{ data: "username" },
					{ data: "credential" },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-outline-primary" data-toggle="modal" data-target=".bs-example-modal-lg" title="Edit Data" onclick="submit(' +
								row.id +
								')"><i class="ion-edit"></i></button> ' +
								'<button class="btn btn-outline-danger waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target="#modalHapus" title="Hapus Data" data-id="' +
								row.id +
								'"><i class="ion-trash-b"></i></button> '
							);
						},
					},
				],
			});
		},
		error: function (xhr, textStatus, errorThrown) {
			console.log(xhr.statusText);
		},
	});
}

function submit(x) {
	var label = document.getElementById("passwordLabel");
	var label1 = document.getElementById("passwordLabel1");
	var input = document.getElementById("password");
	var input1 = document.getElementById("password1");

	if (x == "tambah") {
		$("#btn-insert").show();
		$("#btn-update").hide();
		$("[name='title']").text("Tambah data user");
		input.readOnly = false;
		label.textContent = "Password";
		label1.textContent = "Ulangi";
		input1.placeholder = "Ulangi Password";
	} else {
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Ubah data user");
		input.readOnly = true;
		label.textContent = "Password Hash";
		label1.textContent = "Password Baru";
		input1.placeholder = "Masukkan Password Baru";

		$.ajax({
			type: "POST",
			data: "id=" + x,
			url: base_url + "/" + _controller + "/get_data_id",
			dataType: "json",
			success: function (hasil) {
				$("[name='id']").val(hasil[0].id);
				$("[name='kode']").val(hasil[0].kode);
				$("[name='credential']").val(hasil[0].id_credential);
				$("[name='nama']").val(hasil[0].nama);
				$("[name='username']").val(hasil[0].username);
				$("[name='password']").val(hasil[0].password);
			},
		});
	}
	delete_form();
	delete_error();
}

function insert_data() {
	var formData = new FormData();
	formData.append("kode", $("[name='kode']").val());
	formData.append("nama", $("[name='nama']").val());
	formData.append("credential", $("[name='credential']").val());
	formData.append("username", $("[name='username']").val());
	formData.append("password", $("[name='password']").val());
	formData.append("password1", $("[name='password1']").val());

	$.ajax({
		type: "POST",
		url: base_url + "/" + _controller + "/insert_data",
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function (response) {
			delete_error();
			if (response.errors) {
				for (var fieldName in response.errors) {
					$("#error-" + fieldName).show();
					$("#error-" + fieldName).html(response.errors[fieldName]);
				}
			} else if (response.success) {
				$(".bs-example-modal-lg").modal("hide");
				showAlertifySuccess(response.success);
				get_data();
			}
		},
		error: function (xhr, status, error) {
			console.error("AJAX Error: " + error);
		},
	});
}

function edit_data() {
	var formData = new FormData();
	formData.append("id", $("[name='id']").val());
	formData.append("kode", $("[name='kode']").val());
	formData.append("credential", $("[name='credential']").val());
	formData.append("nama", $("[name='nama']").val());
	formData.append("username", $("[name='username']").val());
	formData.append("password1", $("[name='password1']").val());

	$.ajax({
		type: "POST",
		url: base_url + "/" + _controller + "/edit_data",
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function (response) {
			delete_error();
			if (response.errors) {
				for (var fieldName in response.errors) {
					$("#error-" + fieldName).show();
					$("#error-" + fieldName).html(response.errors[fieldName]);
				}
			} else if (response.success) {
				$(".bs-example-modal-lg").modal("hide");
				showAlertifySuccess(response.success);
				get_data();
			}
		},
		error: function (xhr, status, error) {
			console.error("AJAX Error: " + error);
		},
	});
}

function delete_data(x) {
	$.ajax({
		type: "POST",
		data: "id=" + x,
		dataType: "json",
		url: base_url + "/" + _controller + "/delete_data",
		success: function (response) {
			if (response.success) {
				$("#modalHapus").modal("hide");
				showAlertifySuccess(response.success);
				get_data();
			} else if (response.error) {
				$("#modalHapus").modal("hide");
				showAlertifyError(response.error);
				get_data();
			}
		},
	});
}

// hak akses admin
// get_profil();

// function get_profil() {
// 	$.ajax({
// 		url: base_url + "/" + _controller + "/get_profil",
// 		method: "GET",
// 		dataType: "json",
// 		success: function (data) {
// 			$("[name='id']").val(data[0].id);
// 			$("[name='nama']").val(data[0].name);
// 			$("[name='email']").val(data[0].email);
// 			$("[name='telepon']").val(data[0].phone_number);
// 			$("[name='akses']").val(data[0].akses);
// 			$("[name='alamat']").val(data[0].address);
// 			var nama = data[0].image;
// 			imagePreview.innerHTML = `<img src="${base_url}assets/image/admin/${nama}" class="img-thumbnail" alt="Preview Image" style="width: 100px; height: auto;">`;
// 			$("[name='username']").val(data[0].username);
// 			$("[name='password']").val(data[0].password);
// 		},
// 		error: function (xhr, textStatus, errorThrown) {
// 			console.log(xhr.statusText);
// 		},
// 	});
// }

// function edit_profil() {
// 	var formData = new FormData();
// 	formData.append("id", $("[name='id']").val());
// 	formData.append("nama", $("[name='nama']").val());
// 	formData.append("email", $("[name='email']").val());
// 	formData.append("telepon", $("[name='telepon']").val());
// 	formData.append("alamat", $("[name='alamat']").val());
// 	formData.append("username", $("[name='username']").val());
// 	formData.append("password1", $("[name='password1']").val());

// 	var imageInput = $("[name='image']")[0];
// 	if (imageInput.files.length > 0) {
// 		formData.append("image", imageInput.files[0]);
// 	}

// 	$.ajax({
// 		type: "POST",
// 		url: base_url + "/" + _controller + "/edit_profil",
// 		data: formData,
// 		dataType: "json",
// 		processData: false,
// 		contentType: false,
// 		success: function (response) {
// 			if (response.errors) {
// 				delete_error();
// 				for (var fieldName in response.errors) {
// 					$("#error-" + fieldName).html(response.errors[fieldName]);
// 				}
// 			} else if (response.success) {
// 				delete_error();
// 				delete_form();
// 				if (response.alert) {
// 					$("body").append(response.alert);
// 				}
// 				get_profil();
// 			}
// 		},
// 		error: function (xhr, status, error) {
// 			console.error("AJAX Error: " + error);
// 		},
// 	});
// }
