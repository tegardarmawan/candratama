get_data_keluar();

function get_data_keluar() {
	function formatDate(dateTimeStr) {
		if (!dateTimeStr) return "";

		let date = new Date(dateTimeStr);

		// Format tanggal
		let formattedDate =
			date.getDate().toString().padStart(2, "0") +
			"-" +
			(date.getMonth() + 1).toString().padStart(2, "0") +
			"-" +
			date.getFullYear();

		// Format waktu
		let hours = date.getHours().toString().padStart(2, "0");
		let minutes = date.getMinutes().toString().padStart(2, "0");
		let formattedTime = hours + ":" + minutes;

		// Gabungkan tanggal dan waktu
		return formattedDate + " " + formattedTime;
	}

	$("#min, #max").datepicker({
		format: "dd-mm-yyyy",
		autoclose: true,
	});

	let table;

	function loadData() {
		$.ajax({
			type: "GET",
			url: base_url + _controller + "/get_data_keluar",
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
						{ data: "keluar" },
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
		window.open(base_url + "Stock_keluar/generate_data");
	});
}

// Panggil fungsi saat dokumen siap
$(document).ready(get_data_keluar);
