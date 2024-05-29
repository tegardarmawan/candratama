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
	var date = moment();

	var currentDate = date.format("D/MM/YYYY");
	$("#tgl").val(currentDate);
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
		// Clear previous errors
		$("#error-namab").text("");

		// Check if there are selected values
		if (!selectedValues || selectedValues.length === 0) {
			$("#error-namab").text("Silakan pilih barang.");
			return;
		}

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
					<td id="value-id" name="value" data-value="${value}">${value}</td>
					<td id="namab-id" name="namab-name" data-namab="${namab}">${namab}</td>
					<td id="stock" name="stock" data-stock="${stock}">${stock}</td>
					<td id="satuan" name="satuan" data-satuan="${satuan}">${satuan}</td>
					<td id="keluar" name="keluar" data-keluar=""></td>
					<td id="keluar1" name="keluar1" data-keluar1=""></td>
					<td><button class="btn btn-danger waves-effect waves-light btn-delete">Delete</button></td>
				</tr>
			`;
			$("#my-table tbody").append(newRow);
		});
		$("#my-table").on("click", ".btn-delete", function () {
			$(this).closest("tr").remove();
		});
		$("#namab").val(null).trigger("change");
		$("#my-table")
			.editableTableWidget()
			.numericInputExample()
			.find("td:first")
			.focus();
	});
});
$.fn.numericInputExample = function () {
	"use strict";
	var element = $(this);

	var updateStock = function () {
		var stockColumnIndex = 2; // Index of 'stock' column

		element.on("change", 'td[name="keluar"]', function () {
			var cell = $(this);
			var row = cell.closest("tr");
			var stockCell = row.find('td[name="stock"]');
			var keluar = parseFloat(cell.text()) || 0;

			var option = $(
				"#namab option[value='" + row.find('td[name="value"]').text() + "']"
			);
			var stockawal = parseFloat(option.data("stock"));

			stockCell.text(stockawal - keluar); // Update stock value
			stockCell.data("stock", stockawal - keluar);
		});
	};

	updateStock(); // Call the function to initialize the event listener
};

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
				showAlertifySuccess(response.success); // Tampilkan pesan sukses
				setTimeout(function () {
					window.location.replace(base_url + "Project_warehouse"); // Redirect setelah menampilkan pesan sukses
				}, 1000); // 1.5 detik (1500 milidetik) delay sebelum redirect
			}
		},
		error: function (xhr, status1, error) {
			console.error("AJAX Error: " + error);
		},
	});
}
