get_data();

// auto formatting currency
$("input[data-type='currency']").on({
	keyup: function () {
		formatCurrency($(this));
	},
	blur: function () {
		formatCurrency($(this), "blur");
	},
});
function formatNumber(n) {
	//format number 1000000 menjadi 1,000,000
	return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
function formatCurrency(input, blur) {
	//appends Rp. to value, validates decimal side and puts cursor back in right position

	//mengambil nilai input
	var input_val = input.val();
	//jangan melakukan validasi pada input yang kosong
	if (input_val === "") {
		return;
	}
	//panjang karakter dari input
	var original_len = input_val.length;

	//inisialisasi posisi kursor
	var caret_pos = input.prop("selectionStart");

	//pengecekan desimal
	if (input_val.indexOf(".") >= 0) {
		//mengambil posisi untuk desimal pertama, digunakan untuk mencegah penggunaan desimal
		var decimal_pos = input_val.indexOf(".");

		//memisah nomor dengan titik desimal
		var left_side = input_val.substring(0, decimal_pos);
		var right_side = input_val.substring(decimal_pos);

		//menambahkan koma pada sisi kiri nomor
		left_side = formatNumber(left_side);
		//validasi sisi kanan
		right_side = formatNumber(right_side);

		//on blur make sure 2 numbers after
		if (blur === "blur") {
			right_side += "00";
		}
		//batasi desimal untuk hanya dua digit
		right_side = right_side.substring(0, 2);

		//join number by
		input_val = "Rp" + left_side + "." + right_side;
	} else {
		input_val = formatNumber(input_val);
		input_val = "Rp" + input_val;

		//final formatting
		if (blur === "blur") {
			input_val += ".00";
		}
	}
	input.val(input_val);
	var updated_len = input_val.length;
	caret_pos = updated_len - original_len + caret_pos;
	input[0].setSelectionRange(caret_pos, caret_pos);
}
//end of auto formatting currency9

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
//datepicker
$(document).ready(function () {
	jQuery("#tgl").datepicker({
		autoclose: true,
		todayHighlight: true,
		format: "yyyy-mm-dd", // Menambahkan format tanggal
	});
});

function delete_form() {
	$("[name='kodec']").val("");
	$("[name='kodec1']").val("");
	$("[name='namac']").val("");
	$("[name='ktp']").val("");
	$("[name='alamat']").val("");
	$("[name='kota']").val("");
	$("[name='telp']").val("");
	$("[name='tgl']").val("");
	$("[name='pekerjaan']").val("");
	$("[name='perusahaan']").val("");
	$("[name='saldo']").val("");
	$("[name='jenis']").val("");
	$("[name='kodep']").val("");
}

function delete_error() {
	$("#error-kodec").hide();
	$("#error-kodec1").hide();
	$("#error-namac").hide();
	$("#error-ktp").hide();
	$("#error-alamat").hide();
	$("#error-kota").hide();
	$("#error-telp").hide();
	$("#error-tgl").hide();
	$("#error-pekerjaan").hide();
	$("#error-perusahaan").hide();
	$("#error-saldo").hide();
	$("#error-jenis").hide();
	$("#error-kodep").hide();
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
				scrollY: 320,
				data: data,
				responsive: true,
				columns: [
					{ data: "kodec" },
					{ data: "kodec1" },
					{ data: "namac" },
					{ data: "kota" },
					{ data: "telp" },
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
								'<button class="btn btn-outline-success" data-toggle="modal" data-target="#lihat" title="lihat" onclick="submit(' +
								row.id +
								')"><i class="ion-eye"></i></button>'
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
	if (x == "tambah") {
		$("#btn-insert").show();
		$("#btn-update").hide();
		$("[name='title']").text("Tambah Data Customer");
	} else {
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Data Customer");

		$.ajax({
			type: "POST",
			data: "id=" + x,
			url: base_url + "/" + _controller + "/get_data_id",
			dataType: "json",
			success: function (hasil) {
				$("[name= 'id']").val(hasil[0].id);
				$("[name='kodec']").val(hasil[0].kodec);
				$("[name='kodec1']").val(hasil[0].kodec1);
				$("[name='namac']").val(hasil[0].namac);
				$("[name='ktp']").val(hasil[0].ktp);
				$("[name='alamat']").val(hasil[0].alamat);
				$("[name='kota']").val(hasil[0].kota);
				$("[name='telp']").val(hasil[0].telp);
				$("[name='tgl']").val(hasil[0].tgl);
				$("[name='pekerjaan']").val(hasil[0].pekerjaan);
				$("[name='perusahaan']").val(hasil[0].perusahaan);
				$("[name='saldo']").val(hasil[0].saldo);
				$("[name='jenis']").val(hasil[0].jenis);
				$("[name='kodep']").val(hasil[0].kodep);
			},
		});
	}
	delete_form();
	delete_error();
}

function insert_data() {
	var formData = new FormData();
	formData.append("kodec", $("[name='kodec']").val());
	formData.append("kodec1", $("[name='kodec1']").val());
	formData.append("namac", $("[name='namac']").val());
	formData.append("ktp", $("[name='ktp']").val());
	formData.append("alamat", $("[name='alamat']").val());
	formData.append("kota", $("[name='kota']").val());
	formData.append("telp", $("[name='telp']").val());
	formData.append("tgl", $("[name='tgl']").val());
	formData.append("pekerjaan", $("[name='pekerjaan']").val());
	formData.append("perusahaan", $("[name='perusahaan']").val());
	formData.append("saldo", $("[name='saldo']").val());
	formData.append("jenis", $("[name='jenis']").val());
	formData.append("kodep", $("[name='kodep']").val());

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
	formData.append("kodec", $("[name='kodec']").val());
	formData.append("kodec1", $("[name='kodec1']").val());
	formData.append("namac", $("[name='namac']").val());
	formData.append("ktp", $("[name='ktp']").val());
	formData.append("alamat", $("[name='alamat']").val());
	formData.append("kota", $("[name='kota']").val());
	formData.append("telp", $("[name='telp']").val());
	formData.append("tgl", $("[name='tgl']").val());
	formData.append("pekerjaan", $("[name='pekerjaan']").val());
	formData.append("perusahaan", $("[name='perusahaan']").val());
	formData.append("saldo", $("[name='saldo']").val());
	formData.append("jenis", $("[name='jenis']").val());
	formData.append("kodep", $("[name='kodep']").val());

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
