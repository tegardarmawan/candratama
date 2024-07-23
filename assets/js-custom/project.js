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
	$("[name='nota']").val(notaproject);
	$("[name='kodec']").val("");
	$("[name='namac']").val("").prop("selectedIndex", 0).trigger("change");
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
		var selectedNamaCustomer = $(this).val();

		$.ajax({
			type: "POST",
			url: base_url + "/" + _controller + "/get_kode_customer",
			data: { nama_customer: selectedNamaCustomer },
			dataType: "json",
			success: function (response) {
				if (response.kode_customer) {
					$("#kodec").val(response.kode_customer);
				} else if (response.error) {
					console.error(response.error);
					$("#kodec").val("");
				}
			},
			error: function (xhr, status, error) {
				console.error("Error fetching customer data:", error);
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
			// Pastikan DataTable di-destroy sebelum diinisialisasi ulang
			if ($.fn.DataTable.isDataTable("#datatable-buttons")) {
				$("#datatable-buttons").DataTable().destroy();
			}

			// Inisialisasi ulang DataTable dengan data yang diurutkan
			$("#datatable-buttons").DataTable({
				data: data,
				responsive: true,
				columns: [
					{ data: "nota" },
					{ data: "namac" },
					{ data: "project" },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-outline-primary mb-1" title="Detail Data" onclick="window.location.href=\'' +
								base_url +
								"Project_detail/index/" +
								row.nota +
								'\'"><i class="ion-eye"></i></button>' +
								'<button class="btn btn-outline-danger mb-1" data-toggle="modal" data-animation="bounce" data-target="#modalHapus" title="Hapus Data" data-id="' +
								row.id +
								'"><i class="fas fa-trash"></i></button> '
							);
						},
					},
				],
				// Mengatur pengurutan default pada kolom "nota" secara descending
				order: [[0, "desc"]],
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
				$("[name='namac']").val(hasil[0].namac).trigger("change");
				$("[name= 'project']").val(hasil[0].project);
				$("[name= 'kontrak']").val(hasil[0].kontrak);
			},
		});
	}
	delete_form();
	delete_error();
}

function edit_data() {
	var formData = new FormData();
	formData.append("id", $("[name='id']").val());
	formData.append("nota", $("[name='nota']").val());
	formData.append("kodec", $("[name='kodec']").val());
	formData.append("namac", $("[name='namac']").val());
	formData.append("project", $("[name='project']").val());
	formData.append("kontrak", $("[name='kontrak']").val());

	console.log("Sending data:", formData);

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
				$("[name='nota']").val(response.notaproject);
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
				$("[name='nota']").val(response.notaproject);
				get_data();
			} else if (response.error) {
				$("#modalHapus").modal("hide");
				showAlertifyError(response.error);
				$("[name='nota']").val(response.notaproject);
				get_data();
			}
		},
	});
}
