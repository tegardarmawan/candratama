function showAlertifySuccess(message) {
	$("body").append(alertify.success(message));
}
function showAlertifyError(message) {
	$("body").append(alertify.error(message));
}
function delete_form() {
	$("[name='nota']").val("");
	$("[name='project']").val("");
	$("[name='namac']").val("");
	$("[name='tgl']").val("");
}
function delete_error() {
	$("#error-nota").hide();
	$("#error-project").hide();
	$("#error-namac").hide();
	$("#error-tgl").hide();
}

$(document).ready(function () {
	// Inisialisasi select2
	$("#nota").select2({
		placeholder: "Pilih nota",
	});

	$("#nota").on("change", function () {
		var selectedNota = $(this).val();

		$.ajax({
			type: "POST",
			data: { nota: encodeURIComponent(selectedNota) },
			url: base_url + "/" + _controller + "/get_customer/" + selectedNota,
			dataType: "json",
			success: function (response) {
				console.log(response);
				var decodenota = decodeURIComponent(response.nama_customer);
				$("#namac").val(decodenota);
				var decodeproject = decodeURIComponent(response.project_customer);
				$("#project").val(decodeproject);
			},
			error: function () {
				console.error("Error fetching data");
			},
		});
	});

	// Auto trigger change untuk barang
	// Initialize select2
	$("#namab").select2({
		placeholder: "Pilih Barang",
	});

	// Handle button click
	$("#btn-insert").on("click", function () {
		// Get selected values from the select2
		var selectedValues = $("#namab").val();
		var keluar, keluar1;

		// Clear previous errors
		$("#error-namab").text("");

		// Check if there are selected values
		if (!selectedValues || selectedValues.length === 0) {
			$("#error-namab").text("Silakan pilih barang.");
			return;
		}
		function initializeTabledit() {
			$("#my-table").Tabledit({
				columns: {
					identifier: [0, "kode_barang"], // Change 'id' to the correct identifier name
					editable: [
						[4, "keluar"],
						[5, "keluar1"],
					],
				},
				onDraw: function () {
					console.log("Tabledit has been initialized or re-initialized.");
				},
				onSuccess: function (data, textStatus, jqXHR) {
					console.log("Data successfully updated:", data);

					// Mengambil nilai dari baris yang sedang diedit
					var row = $("#my-table tr.tabledit-edit-mode");
					keluar = row.find("input[name='keluar']").val();
					keluar1 = row.find("input[name='keluar1']").val();

					console.log("keluar:", keluar);
					console.log("keluar1:", keluar1);
				},
				onEdit: function (event, row) {
					// Mendapatkan nilai dari kolom "keluar" dan "stock"
					var keluarValue = row.find('input[name="keluar"]').val();
					var stockValue = row.find('td[name="stock"]').text();

					// Mengurangi nilai "stock" dengan nilai "keluar"
					var newStockValue = parseFloat(stockValue) - parseFloat(keluarValue);

					// Mengupdate nilai pada kolom "stock"
					row.find('td[name="stock"]').text(newStockValue);
				},
			});
		}
		initializeTabledit();
		// Loop through selected values and add rows to the table
		$.each(selectedValues, function (index, value) {
			// Mencari elemen <option> berdasarkan value yang dipilih
			var option = $("#namab option[value='" + value + "']");

			// Mengambil teks dari elemen <option>, yang merupakan nama barang
			var namab = option.text();

			// Mengambil nilai atribut data-satuan dari elemen <option>
			var satuan = option.data("satuan");

			// Mengambil nilai atribut data-stock dari elemen <option>
			var stock = option.data("stock");

			// Improved Row and Tabledit Initialization (moved inside success callback)
			var newRow = `
			<tr>
			<td id="value-id" name="value-name" data-value="${value}">${value}</td>
			<td id="namab-id" name="namab-name" data-namab="${namab}">${namab}</td>	
			<td id="stock" name="stock" data-stock="${stock}">${stock}</td>
			<td id="satuan" name="satuan" data-satuan"${satuan}">${satuan}</td>
			<td id="keluar" name="keluar" data-keluar="${keluar}"></td>
			<small class="text-danger pl-1" id="error-keluar[]"></small>
			<td id="keluar1" name="keluar1" data-keluar1="${keluar1}"></td>
			</tr>
			`;
			$("#my-table tbody").append(newRow);
		});
		initializeTabledit();

		// **Optional:** Destroy previous Tabledit instance if needed
		// $("#my-table").Tabledit("destroy"); // Consider removing if unnecessary

		$("#namab").val(null).trigger("change");
	});
});

function insert_data() {
	// Mengambil nilai dari elemen <td> berdasarkan id
	var formData = new FormData();
	$("#my-table tbody tr").each(function () {
		var value = $(this).find("td:eq(0)").text();
		var namab = $(this).find("td:eq(1)").text();
		var stock = $(this).find("td:eq(2)").text();
		var satuan = $(this).find("td:eq(3)").text();
		var keluar = $(this).find("td:eq(4)").text();
		var keluar1 = $(this).find("td:eq(5)").text();

		//menambahkan nilai ke formdata
		formData.append("value[]", value);
		formData.append("namab[]", namab);
		formData.append("stock[]", stock);
		formData.append("keluar[]", keluar);
		formData.append("keluar1[]", keluar1);
		formData.append("satuan[]", satuan);
	});

	// Menambahkan nilai ke FormData
	formData.append("nota", $("[name='nota']").val());
	formData.append("namac", $("[name='namac']").val());
	formData.append("project", $("[name='project']").val());
	formData.append("tgl", $("[name='tgl']").val());

	$.ajax({
		type: "POST",
		url: base_url + _controller + "/insert_data",
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function (response) {
			delete_error(); // Hapus semua error sebelumnya
			console.log("Response dari server:", response);

			// Jika ada error pada validasi
			if (response.errors) {
				delete_error();
				showAlertifyError(response.error);
			} else if (response.success) {
				showAlertifySuccess(response.success);
			}
		},
		error: function (xhr, status1, error) {
			console.error("AJAX Error: " + error);
		},
	});
}
