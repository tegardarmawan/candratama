get_data_masuk();

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

function get_data_masuk() {
	$.ajax({
		type: "GET",
		url: base_url + _controller + "/get_data_masuk",
		dataType: "json",
		success: function (data) {
			var table = $("#datatable-buttons").DataTable({
				destroy: true,
				responsive: true,
				data: data,
				columns: [
					// nota tgl waktu ket aksi
					{ data: "nota" },
					{ data: "tgl" },
					{ data: "waktu" },
					{ data: "namab" },
					{ data: "masuk" },
					{
						data: "hbeli",
						render: function (data, type, row) {
							return "Rp " + addCommas(data.toString());
						},
					},
					{
						data: null,
						render: function (data, type, row, meta) {
							var total = row.hbeli * row.masuk;
							return "Rp " + addCommas(total.toString());
						},
					},
					// {
					// 	data: null,
					// 	render: function (data, type, row) {
					// 		return (
					// 			'<button class="btn btn-outline-danger mb-1" data-toggle="modal" data-target="#modalHapus" title="Hapus Data" data-id="' +
					// 			row.id +
					// 			'"><i class="fas fa-trash"></i></button> ' +
					// 			'<button class="btn btn-outline-success" title="Detail Data" onclick="window.location.href=\'' +
					// 			base_url +
					// 			"Stock_masuk_detail/index/" +
					// 			row.nota +
					// 			'\'"><i class="ion-eye"></i></button>'
					// 		);
					// 	},
					// },
				],
			});
		},
		error: function (xhr, textStatus, errorThrown, error) {
			console.error("AJAX Error: " + error);
		},
	});
}
