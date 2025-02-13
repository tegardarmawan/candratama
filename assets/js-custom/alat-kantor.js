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
	$("[name='no']").val("");
	$("[name='kodeal']").val("");
	$("[name='namaal']").val("");
	$("[name='merk']").val("");
	$("[name='stock']").val("");
	$("[name='satuan']").val("");
	$("[name='tglbeli']").val("");
	$("[name='hbeli']").val("");
	$("[name='ket']").val("");
	$("[name='kodek']").val("");
	$("[name='namak']").val("");
}

function delete_error() {
	$("#error-no").hide();
	$("#error-kodeal").hide();
	$("#error-namaal").hide();
	$("#error-merk").hide();
	$("#error-stock").hide();
	$("#error-satuan").hide();
	$("#error-tglbeli").hide();
	$("#error-hbeli").hide();
	$("#error-ket").hide();
	$("#error-kodek").hide();
	$("#error-namak").hide();
}

//auto formatting currency
$(document).ready(function () {
	$("#hbeli").on("input", function () {
		var input = $(this).val();
		var numericInput = input.replace(/\D/g, ""); //digunakan untuk menghilangkan seluruh karakter selain digit/angka
		//menambahkan tanda koma pada setiap tiga digit
		var formattedInput = addCommas(numericInput);
		formattedInput = "Rp " + formattedInput; //digunakan untuk menambahkan "Rp" di awal
		//menetapkan nilai yang sudah diformat ke input
		$(this).val(formattedInput);
	});
});
//function untuk menambahkan koma tiap tiga digit
function addCommas(input) {
	return input.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

$(document).ready(function () {
	$("#namak").select2({
		placeholder: "Pilih Nama Karyawan",
	});
	$("#namak").on("change", function () {
		var selectedNamaKaryawan = $(this).val(); //mengambil nilai nama karyawan yang dipilih pada field

		//melakukan request ajax untuk mendapatkan data kode karyawan dari controller fungsi get_kode_karyawan
		$.ajax({
			type: "POST",
			data: { nama_karyawan: encodeURIComponent(selectedNamaKaryawan) }, // mengirim nama_karyawan sebagai parameter
			url:
				base_url +
				"/" +
				_controller +
				"/get_kode_karyawan/" +
				selectedNamaKaryawan,
			dataType: "json",
			success: function (response) {
				//set nilai form kode karyawan sesuai dengan data yang diperoleh dari ajax
				var decodedKode = decodeURIComponent(response.kode_karyawan);
				$("#kodek").val(decodedKode);
				// $("#kodek").val(response.kode_karyawan);
			},
			error: function () {
				//handle untuk error
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
					{ data: "kodeal" },
					{ data: "namaal" },
					{ data: "merk" },
					{ data: "stock" },
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
								'<button class="btn btn-outline-success" data-toggle="modal" data-target="#detail" title="detail" onclick="submit(' +
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
		$("[name='title']").text("Tambah Alat Kantor");
	} else {
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Alat Kantor");

		$.ajax({
			type: "POST",
			data: "id=" + x,
			url: base_url + "/" + _controller + "/get_data_id",
			dataType: "json",
			success: function (hasil) {
				$("[name= 'id']").val(hasil[0].id);
				$("[name= 'no']").val(hasil[0].no);
				$("[name='kodeal']").val(hasil[0].kodeal);
				$("[name='namaal']").val(hasil[0].namaal);
				$("[name='merk']").val(hasil[0].merk);
				$("[name='stock']").val(hasil[0].stock);
				$("[name='satuan']").val(hasil[0].namast).trigger("change");
				var formattedHbeli = "Rp " + addCommas(hasil[0].hbeli);
				$("[name='hbeli']").val(formattedHbeli);
				var date = new Date(hasil[0].tglbeli);
				var formattedDate =
					date.getDate().toString().padStart(2, "0") +
					"/" +
					(date.getMonth() + 1).toString().padStart(2, "0") +
					"/" +
					date.getFullYear();
				$("[name='tglbeli']").val(formattedDate);
				$("[name='ket']").val(hasil[0].ket);
				$("[name='namak']").val(hasil[0].namak).trigger("change");
				$("[name='kodek']").val(hasil[0].kodek);
			},
		});
	}
	delete_form();
	delete_error();
}

function insert_data() {
	var formData = new FormData();
	formData.append("no", $("[name='no']").val());
	formData.append("kodeal", $("[name='kodeal']").val());
	formData.append("namaal", $("[name='namaal']").val());
	formData.append("merk", $("[name='merk']").val());
	formData.append("stock", $("[name='stock']").val());
	formData.append("satuan", $("[name='satuan']").val());
	formData.append("tglbeli", $("[name='tglbeli']").val());
	var hbeli = $("[name='hbeli']").val().replace(/\D/g, "");
	formData.append("hbeli", hbeli);
	formData.append("ket", $("[name='ket']").val());
	formData.append("kodek", $("[name='kodek']").val());
	formData.append("namak", $("[name='namak']").val());

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
	formData.append("no", $("[name='no']").val());
	formData.append("kodeal", $("[name='kodeal']").val());
	formData.append("namaal", $("[name='namaal']").val());
	formData.append("merk", $("[name='merk']").val());
	formData.append("stock", $("[name='stock']").val());
	formData.append("satuan", $("[name='satuan']").val());
	formData.append("tglbeli", $("[name='tglbeli']").val());
	var hbeli = $("[name='hbeli']").val().replace(/\D/g, "");
	formData.append("hbeli", hbeli);
	formData.append("ket", $("[name='ket']").val());
	formData.append("kodek", $("[name='kodek']").val());
	formData.append("namak", $("[name='namak']").val());

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
