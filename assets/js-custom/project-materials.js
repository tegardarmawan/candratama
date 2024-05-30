get_data();
function kembali() {
	window.location.replace(base_url + "Project_warehouse");
}
function get_data() {
	$.ajax({
		type: "GET",
		url: base_url + _controller + "/get_data/" + nota,
		dataType: "json",
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
						render: function (data, type, row, meta) {
							var date = new Date(data);
							var formattedDate =
								date.getDate().toString().padStart(2, "0") +
								"/" +
								(date.getMonth() + 1).toString().padStart(2, "0") +
								"/" +
								date.getFullYear();
							return formattedDate;
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
