get_data();
get_project();
function kembali() {
	window.location.replace(base_url + "Project_warehouse");
}
function get_project() {
	$("#tablepro").DataTable({
		ajax: {
			url: base_url + _controller + "/get_project/" + nota,
			method: "GET",
			dataType: "json",
			dataSrc: function (json) {
				if (json.error) {
					console.error(json.error);
					alert("Error: " + json.error);
					return [];
				}
				return json;
			},
		},
		columns: [{ data: "project" }],
		responsive: true,
	});
}
function get_data() {
	let minDate, maxDate;

	$.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
		let min = minDate.val() ? new Date(minDate.val()) : null;
		let max = maxDate.val() ? new Date(maxDate.val()) : null;
		let date = new Date(data[5]);

		if (
			(min === null && max === null) ||
			(min === null && date <= max) ||
			(min <= date && max === null) ||
			(min <= date && date <= max)
		) {
			return true;
		}
		return false;
	});

	// Create date inputs
	minDate = new DateTime($("#min"), { format: "DD-MM-YYYY" });
	maxDate = new DateTime($("#max"), { format: "DD-MM-YYYY" });

	let table = $("#my-table").DataTable({
		ajax: {
			url: base_url + _controller + "/get_data/" + nota,
			method: "GET",
			dataType: "json",
			data: function (d) {
				d.start_date = formatDate(minDate.val());
				d.end_date = formatDate(maxDate.val());
			},
			dataSrc: function (json) {
				if (json.error) {
					console.error(json.error);
					alert("Error: " + json.error);
					return [];
				}
				return json;
			},
			success: function (data) {
				$("#my-table").DataTable({
					destroy: true,
					data: data,
					responsive: true,
					columns: [
						{ data: "kodeb" },
						{ data: "namab" },
						{ data: "keluar" },
						{ data: "satuan" },
						{ data: "keluar1" },
						{
							data: "tgl",
						},
					],
				});
				var formData = new FormData();

				// Periksa keberadaan elemen sebelum mengakses textContent
				var notaElement = document.getElementById("nota");
				var namacElement = document.getElementById("namac");
				var projectElement = document.getElementById("project");

				if (notaElement) {
					formData.append("nota", notaElement.textContent);
				} else {
					console.error("Elemen dengan id 'nota' tidak ditemukan");
				}

				if (namacElement) {
					formData.append("namac", namacElement.textContent);
				} else {
					console.error("Elemen dengan id 'namac' tidak ditemukan");
				}

				var dataTable = $("#my-table").DataTable();
				var tableData = dataTable.rows().data();
				var dataToSend = [];

				$.each(tableData, function (index, rowData) {
					var date = new Date(rowData.tgl);
					var formattedDate =
						date.getDate().toString().padStart(2, "0") +
						"/" +
						(date.getMonth() + 1).toString().padStart(2, "0") +
						"/" +
						date.getFullYear();
					var rowDataObject = {
						kodeBarang: rowData.kodeb,
						namaBarang: rowData.namab,
						keluar: rowData.keluar,
						satuan: rowData.satuan,
						keterangan: rowData.keluar1,
						tanggal: formattedDate,
					};
					dataToSend.push(rowDataObject);
				});

				formData.append("tableData", JSON.stringify(dataToSend));

				$.ajax({
					type: "POST",
					url: base_url + _controller + "/save_session_data",
					data: formData,
					dataType: "json",
					contentType: false,
					processData: false,
					success: function (response) {
						console.log(response);
					},
					error: function (xhr, status, error) {
						console.error(xhr.responseText);
					},
				});
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.error("AJAX error: " + textStatus + " - " + errorThrown);
				alert("An error occurred while fetching data.");
			},
		},
	});

	$("#min, #max").on("change", function () {
		table.ajax.reload();
	});

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
}

function generate() {
	$(document).ready(function () {
		window.open(base_url + "Project_materials/generate_data", "_blank");
	});
}
