get_data();

$(".bs-example-modal-center").on("show.bs.modal", function (e) {
	var button = $(e.relatedTarget);
	var id = button.data("id");
	var modalButton = $(this).find("#btn-hapus");
	modalButton.attr("onclick", "delete_data(" + id + ")");
});

function showAlertifySuccess(message) {
	$("body").append(alertify.success(message));
}

function showAlertifyError(message) {
	$("body").append(alertify.error(message));
}

function delete_form() {
	$("[name='nota']").val("");
	$("[name='kodec']").val("");
	$("[name='namac']").val("");
	$("[name='project']").val("");
	$("[name='kontrak']").val("");
	$("[name='user']").val("");
}

function delete_error() {
	$("#error-nota").hide();
	$("#error-kodec").hide();
	$("#error-namac").hide();
	$("#error-project").hide();
	$("#error-kontrak").hide();
	$("#error-user").hide();
}
//select 2
$(document).ready(function () {
	// Inisialisasi select2
	$("#namac").select2({
		placeholder: "Pilih nama customer",
	});

	// Event change pada select2
	$("#namac").on("change", function () {
		var selectedNamaCustomer = $(this).val(); // Ambil nilai nama customer yang dipilih

		// Lakukan request AJAX untuk mendapatkan data nama customer
		$.ajax({
			type: "POST",
			data: { nama_customer: selectedNamaCustomer }, // Mengirim nama_customer sebagai parameter
			url:
				base_url +
				"/" +
				_controller +
				"/get_kode_customer/" +
				selectedNamaCustomer, // Menambahkan kode_customer ke URL
			dataType: "json",
			success: function (response) {
				// Set nilai form nama customer sesuai dengan data yang diperoleh dari AJAX
				$("#kodec").val(response.kode_customer);
			},
			error: function () {
				// Handle error jika terjadi
				console.error("Error fetching customer data");
			},
		});
	});
});

function get_data() {
	delete_error();
	$.ajax({
		url: base_url + _controller + "/get_data",
		method: "GET",
		dataType: "json",
		success: function (data) {
			var table = $("#datatable-buttons").DataTable({
				destroy: true,
				data: data,
				responsive: true,
				columns: [
					{ data: "id" },
					{ data: "namac" },
					{ data: "project" },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-outline-primary" data-toggle="modal" data-target=".bs-example-modal-lg" title="Edit Data" onclick="submit(' +
								row.id +
								')"><i class="ion-edit"></i></button> ' +
								'<button class="btn btn-outline-danger" data-toggle="modal" data-animation="bounce" data-target="#modalHapus" title="Hapus Data" data-id="' +
								row.id +
								'"><i class="fas fa-trash"></i></button> ' +
								'<button class="btn btn-outline-success" data-toggle="modal" data-target="#lihat" title="detail" onclick="submit(' +
								row.id +
								')"><i class="ion-eye"></i></button>'
							);
						},
					},
				],
			});
		},
		error: function (xhr, textStatus, errorThrown, error) {
			console.error("AJAX Error: " + error);
		},
	});
}

function submit(x) {
	if (x == "tambah") {
		$("#btn-insert").show();
		$("#btn-update").hide();
		$("[name='title']").text("Tambah Data Project");
	} else {
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Edit Data Project");

		$.ajax({
			type: "POST",
			data: "id=" + x,
			url: base_url + "/" + _controller + "/get_data_id",
			dataType: "json",
			success: function (hasil) {
				$("[name= 'id']").val(hasil[0].id);
				$("[name= 'nota']").val(hasil[0].nota);
				$("[name='kodec']").val(hasil[0].kodec);
				$("[name= 'namac']").val(hasil[0].namac).trigger("change");
				$("[name= 'project']").val(hasil[0].project);
				$("[name= 'kontrak']").val(hasil[0].kontrak);
			},
		});
	}
	delete_form();
	delete_error();
}

function insert_data() {
	var formData = new FormData();
	formData.append("nota", $("[name='nota']").val());
	formData.append("kodec", $("[name='kodec']").val());
	formData.append("namac", $("[name='namac']").val());
	formData.append("project", $("[name='project']").val());
	formData.append("kontrak", $("[name='kontrak']").val());

	$.ajax({
		type: "POST",
		url: base_url + _controller + "/insert_data",
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
	formData.append("nota", $("[name='nota']").val());
	formData.append("kodec", $("[name='kodec']").val());
	formData.append("namac", $("[name='namac']").val());
	formData.append("project", $("[name='project']").val());
	formData.append("kontrak", $("[name='kontrak']").val());

	$.ajax({
		type: "POST",
		url: base_url + _controller + "/edit_data",
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
