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
	$("[name='kodec']").val("");
	$("[name='namac']").val("");
	$("[name='kota']").val("");
	$("[name='telp']").val("");
}

function delete_error() {
	$("#error-kodec").hide();
	$("#error-namac").hide();
	$("#error-kota").hide();
	$("#error-telp").hide();
}

//function auto formatting currency
$(document).ready(function () {
	$("#saldo").on("input", function () {
		var input = $(this).val(); //mengambil nilai yang diinput pada field id saldo
		var numericInput = input.replace(/\D/g, ""); //menghapus karakter selain digit/angka pada value yang diinput pada field id saldo
		var formattedInput = addCommas(numericInput);
		formattedInput = "Rp " + formattedInput;
		$(this).val(formattedInput);
	});
});
//function addCommas, untuk menambahkan koma setiap tiga digit angka
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
					{ data: "kodec" },
					{ data: "namac" },
					{ data: "kota" },
					{ data: "telp" },
					{
						data: null,
						render: function (data, type, row) {
							return (
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
	$("[name='title']").text("Data Customer RO");

	$.ajax({
		type: "POST",
		data: "id=" + x,
		url: base_url + "/" + _controller + "/get_data_id",
		dataType: "json",
		success: function (hasil) {
			$("[name= 'id']").val(hasil[0].id);
			$("[name='kodec']").val(hasil[0].kodec);
			$("[name='namac']").val(hasil[0].namac);
			$("[name='kota']").val(hasil[0].kota);
			$("[name='telp']").val(hasil[0].telp);
			$("[name='project']").val(hasil[0].project);
		},
	});
	delete_form();
	delete_error();
}
