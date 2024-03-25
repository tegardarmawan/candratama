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
	$("[name='kodeh']").val("");
	$("[name='namah']").val("");
	$("[name='stock']").val("");
	$("[name='satuan']").val("");
	$("[name='ket']").val("");
	$("[name='hbeli']").val("");
	$("[name='hpokok']").val("");
	$("[name='hjual']").val("");
	$("[name='status']").val("");
	$("[name='stockmin']").val("");
	$("[name='namat']").val("");
	$("[name='projectt']").val("");
}
function delete_error() {
	$("#error-kodeh").hide();
	$("#error-kodeg").hide();
	$("#error-namah").hide();
	$("#error-stock").hide();
	$("#error-satuan").hide();
	$("#error-ket").hide();
	$("#error-hbeli").hide();
	$("#error-hpokok").hide();
	$("#error-hjual").hide();
	$("#error-status1").hide();
	$("#error-stockmin").hide();
	$("#error-namat").hide();
	$("#error-projectt").hide();
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
				scrollY: 320,
				scrollX: 320,
				responsive: true,
				columns: [
					{ data: "kodeh" },
					{ data: "namah" },
					{ data: "stock" },
					{ data: "status" },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-outline-primary mb-1" data-toggle="modal" data-target=".bs-example-modal-lg" title="Edit Data" onclick="submit(' +
								row.id +
								')"><i class="ion-edit"></i></button> ' +
								'<button class="btn btn-outline-danger mb-1" data-toggle="modal" data-animation="bounce" data-target="#modalHapus" title="Hapus Data" data-id="' +
								row.id +
								'"><i class="fas fa-trash"></i></button> ' +
								'<button class="btn btn-outline-success mb-1" data-toggle="modal" data-target="#lihat" title="lihat" onclick="submit(' +
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
		$("[name='title']").text("Tambah Data Granite&HPL");
	} else {
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Edit Data Granit&HPL");
		//id kodef namaf satuan ket hjual => database
		$.ajax({
			type: "POST",
			data: "id=" + x,
			url: base_url + "/" + _controller + "/get_data_id",
			dataType: "json",
			success: function (hasil) {
				$("[name= 'id']").val(hasil[0].id);
				$("[name= 'kodeg']").val(hasil[0].kodeg);
				$("[name= 'kodeh']").val(hasil[0].kodeh);
				$("[name= 'namah']").val(hasil[0].namah);
				$("[name= 'stock']").val(hasil[0].stock);
				$("[name= 'satuan']").val(hasil[0].namast);
				$("[name= 'ket']").val(hasil[0].ket);
				$("[name= 'hbeli']").val(hasil[0].hbeli);
				$("[name= 'hpokok']").val(hasil[0].hpokok);
				$("[name= 'hjual']").val(hasil[0].hjual);
				$("[name= 'status1']").val(hasil[0].status);
				$("[name= 'stockmin']").val(hasil[0].stockmin);
				$("[name= 'namat']").val(hasil[0].namat);
				$("[name= 'projectt']").val(hasil[0].projectt);
			},
		});
	}
	delete_form();
	delete_error();
}

function insert_data() {
	var formData = new FormData();
	formData.append("kodeg", $("[name='kodeg']").val());
	formData.append("kodeh", $("[name='kodeh']").val());
	formData.append("namah", $("[name='namah']").val());
	formData.append("stock", $("[name='stock']").val());
	formData.append("satuan", $("[name='satuan']").val());
	formData.append("ket", $("[name='ket']").val());
	formData.append("hbeli", $("[name='hbeli']").val());
	formData.append("hpokok", $("[name='hpokok']").val());
	formData.append("hjual", $("[name='hjual']").val());
	formData.append("status1", $("[name='status1']").val());
	formData.append("stockmin", $("[name='stockmin']").val());
	formData.append("namat", $("[name='namat']").val());
	formData.append("projectt", $("[name='projectt']").val());

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
	formData.append("kodeh", $("[name='kodeh']").val());
	formData.append("namah", $("[name='namah']").val());
	formData.append("stock", $("[name='stock']").val());
	formData.append("satuan", $("[name='satuan']").val());
	formData.append("ket", $("[name='ket']").val());
	formData.append("hbeli", $("[name='hbeli']").val());
	formData.append("hpokok", $("[name='hpokok']").val());
	formData.append("hjual", $("[name='hjual']").val());
	formData.append("status1", $("[name='status1']").val());
	formData.append("stockmin", $("[name='stockmin']").val());
	formData.append("namat", $("[name='namat']").val());
	formData.append("projectt", $("[name='projectt']").val());

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
