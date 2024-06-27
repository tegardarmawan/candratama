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
//id kodef namaf satuan ket hjual => database
function delete_form() {
	$("[name='kode']").val("");
	$("[name='nama']").val("");
	$("[name='satuan']").val("");
	$("[name='ket']").val("");
	$("[name='hjual']").val("");
}
function delete_error() {
	$("#error-kode").hide();
	$("#error-nama").hide();
	$("#error-satuan").hide();
	$("#error-ket").hide();
	$("#error-hjual").hide();
}

//fungsi untuk auto formatting currency
$(document).ready(function () {
	//membuat fungsi yang akan ditrigger ketika terjadi proses input pada field id hargabeli
	$("#hjual").on("input", function () {
		//mengambil nilai dari karakter yang diinput pada field
		var input = $(this).val();
		//menghapus karakter selain digit pada nilai input
		var numericInput = input.replace(/\D/g, "");
		//menambahkan fungsi addCommas pada angka
		var formattedInput = addCommas(numericInput);
		//menambah awalan Rp untuk angka yang sudah diformat dengan koma
		formattedInput = "Rp " + formattedInput;

		//menetapkan nilai input menjadi formattedInput
		$(this).val(formattedInput);
	});
});
//function untuk menambahkan koma tiap tiga digit angka
function addCommas(input) {
	return input.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
						data: null,
						render: function (data, type, row, meta) {
							return meta.row + 1;
						},
					},
					{ data: "kodef" },
					{ data: "namaf" },
					{ data: "namast" },
					{ data: "ket" },
					{
						data: "hjual",
						render: function (data, type, row, meta) {
							return "Rp " + addCommas(data.toString());
						},
					},
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-outline-primary mb-1" data-toggle="modal" data-target=".bs-example-modal-lg" title="Edit Data" onclick="submit(' +
								row.id +
								')"><i class="ion-edit"></i></button> ' +
								'<button class="btn btn-outline-danger waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target="#modalHapus" title="Hapus Data" data-id="' +
								row.id +
								'"><i class="fas fa-trash"></i></button> '
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
		$("[name='title']").text("Tambah Data Group");
	} else {
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Edit Data Group");
		//id kodef namaf satuan ket hjual => database
		$.ajax({
			type: "POST",
			data: "id=" + x,
			url: base_url + "/" + _controller + "/get_data_id",
			dataType: "json",
			success: function (hasil) {
				$("[name= 'id']").val(hasil[0].id);
				$("[name= 'kode']").val(hasil[0].kodef);
				$("[name= 'nama']").val(hasil[0].namaf);
				$("[name= 'satuan']").val(hasil[0].namast).trigger("change");
				$("[name= 'ket']").val(hasil[0].ket);
				var formattedInput = "Rp " + addCommas(hasil[0].hjual);
				$("[name= 'hjual']").val(formattedInput);
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
	formData.append("satuan", $("[name='satuan']").val());
	formData.append("ket", $("[name='ket']").val());
	var formattedInput = $("[name = 'hjual']").val().replace(/\D/g, "");
	formData.append("hjual", formattedInput);

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
	formData.append("kode", $("[name='kode']").val());
	formData.append("nama", $("[name='nama']").val());
	formData.append("satuan", $("[name='satuan']").val());
	formData.append("ket", $("[name='ket']").val());
	var formattedInput = $("[name = 'hjual']").val().replace(/\D/g, "");
	formData.append("hjual", formattedInput);

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
