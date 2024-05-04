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
	$("[name='kodeg']").val("");
	$("[name='kodeb']").val("");
	$("[name='nama']").val("");
	$("[name='stock']").val("");
	$("[name='kodest']").val("");
	$("[name='hargabeli']").val("");
	$("[name='hargapokok']").val("");
	$("[name='hargajual']").val("");
	$("[name='status1']").val("");
	$("[name='stockmin']").val("");
	$("[name='namat']").val("");
	$("[name='project']").val("");
}

function delete_error() {
	$("#error-kodeg").hide();
	$("#error-kodeb").hide();
	$("#error-nama").hide();
	$("#error-stock").hide();
	$("#error-kodest").hide();
	$("#error-hargabeli").hide();
	$("#error-hargapokok").hide();
	$("#error-hargajual").hide();
	$("#error-status1").hide();
	$("#error-stockmin").hide();
	$("#error-namat").hide();
	$("#error-project").hide();
}

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
					{
						data: "id",
					},
					{ data: "kodeb" },
					{ data: "namab" },
					{ data: "stock" },
					{ data: "status" },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-outline-primary mb-1" data-toggle="modal" data-target="#modalinup" title="Edit Data" onclick="submit(' +
								row.id +
								')"><i class="ion-edit"></i></button> ' +
								'<button class="btn btn-outline-danger mb-1" data-toggle="modal" data-target="#modalHapus" title="Hapus Data" data-id="' +
								row.id +
								'"><i class="fas fa-trash"></i></button> ' +
								'<button class="btn btn-outline-success mb-1" data-toggle="modal" data-target="#detail" title="Detail Data" onclick="submit(' +
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
		$("[name='title']").text("Tambah Data Barang");
	} else {
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Data Barang");

		$.ajax({
			type: "POST",
			data: "id=" + x,
			url: base_url + "/" + _controller + "/get_data_id",
			dataType: "json",
			success: function (hasil) {
				$("[name= 'id']").val(hasil[0].id);
				$("[name='kodeg']").val(hasil[0].kodeg).trigger("change");
				$("[name='kodeb']").val(hasil[0].kodeb);
				$("[name='nama']").val(hasil[0].namab);
				$("[name='stock']").val(hasil[0].stock);
				$("[name='kodest']").val(hasil[0].namast).trigger("change");
				$("[name='hargabeli']").val(hasil[0].hbeli);
				$("[name='hargapokok']").val(hasil[0].hpokok);
				$("[name='hargajual']").val(hasil[0].hjual);
				$("[name='status1']").val(hasil[0].status);
				$("[name='stockmin']").val(hasil[0].stockmin);
				$("[name='namat']").val(hasil[0].namat);
				$("[name='project']").val(hasil[0].projectt);
			},
		});
	}
	delete_form();
	delete_error();
}

function insert_data() {
	var formData = new FormData();
	formData.append("kodeg", $("[name='kodeg']").val());
	formData.append("kodeb", $("[name='kodeb']").val());
	formData.append("nama", $("[name='nama']").val());
	formData.append("stock", $("[name='stock']").val());
	formData.append("kodest", $("[name='kodest']").val());
	formData.append("hargabeli", $("[name='hargabeli']").val());
	formData.append("hargapokok", $("[name='hargapokok']").val());
	formData.append("hargajual", $("[name='hargajual']").val());
	formData.append("status1", $("[name='status1']").val());
	formData.append("stockmin", $("[name='stockmin']").val());
	formData.append("namat", $("[name='namat']").val());
	formData.append("project", $("[name='project']").val());

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
	formData.append("kodeg", $("[name='kodeg']").val());
	formData.append("kodeb", $("[name='kodeb']").val());
	formData.append("nama", $("[name='nama']").val());
	formData.append("stock", $("[name='stock']").val());
	formData.append("kodest", $("[name='kodest']").val());
	formData.append("hargabeli", $("[name='hargabeli']").val());
	formData.append("hargapokok", $("[name='hargapokok']").val());
	formData.append("hargajual", $("[name='hargajual']").val());
	formData.append("status1", $("[name='status1']").val());
	formData.append("stockmin", $("[name='stockmin']").val());
	formData.append("namat", $("[name='namat']").val());
	formData.append("project", $("[name='project']").val());

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
