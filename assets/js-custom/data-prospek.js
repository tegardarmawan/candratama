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
	$("[name='kodep']").val("");
	$("[name='namap']").val("");
	$("[name='kota']").val("");
	$("[name='telp']").val("");
	$("[name='tglp']").val("");
	$("[name='type']").val("");
	$("[name='src']").val("");
	$("[name='jenis']").val("");
	$("[name='ket']").val("");
	$("[name='cek']").val("");
}

function delete_error() {
	$("#error-kodep").hide();
	$("#error-namap").hide();
	$("#error-kota").hide();
	$("#error-telp").hide();
	$("#error-tglp").hide();
	$("#error-type").hide();
	$("#error-src").hide();
	$("#error-jenis").hide();
	$("#error-ket").hide();
	$("#error-cek").hide();
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
					{ data: "kodep" },
					{ data: "namap" },
					{ data: "kota" },
					{ data: "telp" },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-outline-primary" data-toggle="modal" data-target=".bs-example-modal-lg" title="Edit Data" onclick="submit(' +
								row.id +
								')"><i class="ion-edit"></i></button> ' +
								'<button class="btn btn-outline-danger waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target="#modalHapus" title="Hapus Data" data-id="' +
								row.id +
								'"><i class="fas fa-trash"></i></button> ' +
								'<button class="btn btn-outline-success" data-toggle="modal" data-target="#detail" title="lihat" onclick="submit(' +
								row.id +
								')"><i class="ion-eye"></i></button>'
							);
						},
					},
				],
			});
		},
		error: function (xhr, textstatus1, errorThrown) {
			console.log(xhr.status1Text);
		},
	});
}

function submit(x) {
	if (x == "tambah") {
		$("#btn-insert").show();
		$("#btn-update").hide();
		$("[name='title']").text("Tambah Data Prospek");
	} else {
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Data Prospek");

		$.ajax({
			type: "POST",
			data: "id=" + x,
			url: base_url + "/" + _controller + "/get_data_id",
			dataType: "json",
			success: function (hasil) {
				$("[name= 'id']").val(hasil[0].id);
				$("[name='kodep']").val(hasil[0].kodep);
				$("[name='namap']").val(hasil[0].namap);
				$("[name='kota']").val(hasil[0].kota);
				$("[name='telp']").val(hasil[0].telp);
				var date = new Date(hasil[0].tglp);
				var formattedDate =
					(date.getDate() + 1).toString().padStart(2, "0") +
					"/" +
					date.getMonth().toString().padStart(2, "0") +
					"/" +
					date.getFullYear();
				$("[name='tglp']").val(formattedDate);
				$("[name='type']").val(hasil[0].type);
				$("[name='src']").val(hasil[0].src);
				$("[name='jenis']").val(hasil[0].jenis);
				$("[name='ket']").val(hasil[0].ket);
				$("[name='cek']").val(hasil[0].cek);
			},
		});
	}
	delete_form();
	delete_error();
}

function insert_data() {
	var formData = new FormData();
	formData.append("kodep", $("[name='kodep']").val());
	formData.append("namap", $("[name='namap']").val());
	formData.append("kota", $("[name='kota']").val());
	formData.append("telp", $("[name='telp']").val());
	formData.append("tglp", $("[name='tglp']").val());
	formData.append("type", $("[name='type']").val());
	formData.append("src", $("[name='src']").val());
	formData.append("jenis", $("[name='jenis']").val());
	formData.append("ket", $("[name='ket']").val());
	formData.append("cek", $("[name='cek']").val());

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
	formData.append("kodep", $("[name='kodep']").val());
	formData.append("namap", $("[name='namap']").val());
	formData.append("kota", $("[name='kota']").val());
	formData.append("telp", $("[name='telp']").val());
	formData.append("tglp", $("[name='tglp']").val());
	formData.append("type", $("[name='type']").val());
	formData.append("src", $("[name='src']").val());
	formData.append("jenis", $("[name='jenis']").val());
	formData.append("ket", $("[name='ket']").val());
	formData.append("cek", $("[name='cek']").val());

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
		error: function (xhr, status1, error) {
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
