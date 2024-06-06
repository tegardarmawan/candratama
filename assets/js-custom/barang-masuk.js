function showAlertifySuccess(message) {
	$("body").append(alertify.success(message));
}
function showAlertifyError(message) {
	$("body").append(alertify.error(message));
}

function kembali() {
	window.location.replace(base_url + "Kelola_data_barang");
}

//fungsi untuk auto formatting currency
$(document).ready(function () {
	//membuat fungsi yang akan ditrigger ketika terjadi proses input pada field id hargabeli
	$(".harga").on("input", function () {
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
$(document).ready(function () {
	formattedinputJual = "Rp" + addCommas($("[name='hjual']").val());
	formattedinputBeli = "Rp" + addCommas($("[name='hbeli']").val());
	formattedinputPokok = "Rp" + addCommas($("[name='hpokok']").val());
	$("[name='hjual']").val(formattedInputJual);
	$("[name='hbeli']").val(formattedInputBeli);
	$("[name='hpokok']").val(formattedInputPokok);
});

function edit_data() {
	var formData = new FormData();
	formData.append("id", $("[name='id']").val());
	formData.append("kodeg", $("[name='kodeg']").val());
	formData.append("kodeb", document.getElementById("kodeb").textContent);
	formData.append("namab", $("[name='namab']").val());
	formData.append("satuan", $("[name='satuan']").val());
	//mengambil karakter angka saja pada nilai yang telah ada di field input
	var formattedInput = $("[name='hbeli']").val().replace(/\D/g, "");
	var formattedInputPokok = $("[name='hpokok']").val().replace(/\D/g, "");
	var formattedInputJual = $("[name='hjual']").val().replace(/\D/g, "");
	formData.append("hbeli", formattedInput);
	formData.append("hpokok", formattedInputPokok);
	formData.append("hjual", formattedInputJual);
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
				for (var fieldName in response.errors) {
					$("#error-" + fieldName).show();
					$("#error-" + fieldName).html(response.errors[fieldName]);
				}
			} else if (response.success) {
				$(".bs-example-modal-lg").modal("hide");
				showAlertifySuccess(response.success);
				setTimeout(function () {
					window.location.replace(base_url + "Kelola_data_barang");
				}, 1000);
			}
		},
		error: function (xhr, status, error) {
			console.error("AJAX Error: " + error);
		},
	});
}
