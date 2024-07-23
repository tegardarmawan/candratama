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
	function formatDate(dateStr) {
		if (!dateStr) return "";
		let date = new Date(dateStr);
		return (
			date.getDate().toString().padStart(2, "0") +
			"-" +
			(date.getMonth() + 1).toString().padStart(2, "0") +
			"-" +
			date.getFullYear()
		);
	}

	$("#min, #max").datepicker({
		format: "dd-mm-yyyy",
		autoclose: true,
	});

	let table;

	function loadData() {
		$.ajax({
			type: "GET",
			url: base_url + _controller + "/get_data_masuk",
			dataType: "json",
			data: {
				start_date: $("#min").val(),
				end_date: $("#max").val(),
			},
			success: function (data) {
				if ($.fn.DataTable.isDataTable("#datatable-buttons")) {
					$("#datatable-buttons").DataTable().clear().destroy();
				}
				table = $("#datatable-buttons").DataTable({
					responsive: true,
					scrollY: 450,
					scrollX: 450,
					data: data,
					columns: [
						{ data: "nota" },
						{ data: "ket" },
						{ data: "waktu" },
						{ data: "kodeb" },
						{ data: "namab" },
						{ data: "masuk" },
						{ data: "namat" },
						{ data: "projectt" },
					],
					order: [[2, "desc"]],
				});

				savePdfData();
			},
			error: function (xhr, textStatus, errorThrown) {
				console.error("AJAX Error: " + textStatus, errorThrown);
			},
		});
	}

	function savePdfData() {
		var dataTable = $("#datatable-buttons").DataTable();
		var tableData = dataTable.rows().data().toArray();

		var formData = new FormData();
		formData.append("tableData", JSON.stringify(tableData));
		formData.append("min", $("#min").val());
		formData.append("max", $("#max").val());

		$.ajax({
			type: "POST",
			url: base_url + _controller + "/save_session_data",
			data: formData,
			dataType: "json",
			contentType: false,
			processData: false,
			success: function (response) {
				if (response.status === "success") {
					console.log("Data saved successfully");
				} else {
					console.error("Error saving data:", response.message);
				}
			},
			error: function (xhr, status, error) {
				console.error("AJAX Error:", xhr.responseText);
			},
		});
	}

	loadData();

	$("#min, #max").on("change", loadData);

	// Tambahkan fungsi untuk generate PDF
	$("#generatePdf").on("click", function () {
		window.open(base_url + "inventory/generate_data");
	});
}

// Panggil fungsi saat dokumen siap
$(document).ready(get_data_masuk);

// $.ajax({
// 	type: "GET",
// 	url: base_url + _controller + "/get_data_masuk",
// 	dataType: "json",
// 	success: function (data) {
// 		$("#datatable-buttons").DataTable({
// 			destroy: true,
// 			responsive: true,
// 			data: data,
// 			columns: [
// 				// nota tgl waktu ket aksi
// 				{ data: "nota" },
// 				{ data: "ket" },
// 				{ data: "tgl" },
// 				{
// 					data: null,
// 					render: function (data, type, row) {
// 						return (
// 							'<button class="btn btn-outline-success" title="Detail Data" onclick="window.location.href=\'' +
// 							base_url +
// 							"Stock_masuk_detail/index/" +
// 							row.nota +
// 							'\'"><i class="ion-eye"></i></button>'
// 						);
// 					},
// 				},
// 			],
// 			order: [[2, "desc"]],
// 		});
// 	},
// 	error: function (xhr, textStatus, errorThrown, error) {
// 		console.error("AJAX Error: " + error);
// 	},
// });
