get_data();
function kembali() {
	window.location.replace(base_url + "Project_warehouse");
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
							// render: function (data, type, row, meta) {
							// 	var date = new Date(data);
							// 	var formattedDate =
							// 		date.getDate().toString().padStart(2, "0") +
							// 		"-" +
							// 		(date.getMonth() + 1).toString().padStart(2, "0") +
							// 		"-" +
							// 		date.getFullYear();
							// 	return formattedDate;
							// },
						},
					],
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
	var formData = new FormData();
	formData.append("nota", document.getElementById("nota").textContent);
	formData.append("namac", document.getElementById("namac").textContent);
	formData.append("project", document.getElementById("project").textContent);

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
			window.open(base_url + "Project_materials/generate_data", "_blank");
		},
		error: function (xhr, status, error) {
			console.error(xhr.responseText);
		},
	});
}
