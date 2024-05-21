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
		placeholder: "Pilih nama customer",
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

					// value = row.find("#value-id").data("value");
					// namab = row.find("#namab-id").data("namab");
					// satuan = row.find("#satuan").data("satuan");
					// stock = row.find("#stock").data("stock");
					keluar = row.find("input[name='keluar']").val();
					keluar1 = row.find("input[name='keluar1']").val();

					// console.log("value:", value);
					// console.log("namab:", namab);
					// console.log("satuan:", satuan);
					// console.log("stock:", stock);
					console.log("keluar:", keluar);
					console.log("keluar1:", keluar1);
				},
			});
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
	<td id="value-id" name="value-name" data-value="${value}">${value}</td>
	<td id="namab-id" name="namab-name" data-namab="${namab}">${namab}</td>	
	<td id="stock" name="stock" data-stock="${stock}">${stock}</td>
	<td id="satuan" name="satuan" data-satuan"${satuan}">${satuan}</td>
	<td id="keluar" name="keluar" data-keluar="${keluar}"></td>
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
	var value = $("#value-id").data("value");
	var namab = $("#namab-id").data("namab");
	var keluar = $("#keluar").data("keluar");
	var keluar1 = $("#keluar1").data("keluar1");
	var satuan = $("#satuan").data("satuan");
	var formData = new FormData();

	// Menambahkan nilai ke FormData
	formData.append("value", value);
	formData.append("namab", namab);
	formData.append("keluar", keluar);
	formData.append("keluar1", keluar1);
	formData.append("satuan", satuan);
	formData.append("nota", $("[name='nota']").val());
	formData.append("namac", $("[name='namac']").val());
	formData.append("project", $("[name='project']").val());
	formData.append("tgl", $("[name='tgl']").val());
	formData.append("stock", $("[name='stock']").val());

	$.ajax({
		type: "POST",
		url: base_url + _controller + "/insert_data",
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function (response) {
			delete_error();
			if (response.error) {
				for (var fieldName in response.errors) {
					$("#error-" + fieldName).show();
					$("#error-" + fieldName).html(response.errors[fieldName]);
				}
			} else if (response.success) {
				showAlertifySuccess(response.success);
			}
		},
		error: function (xhr, status, error) {
			console.error("AJAX Error" + error);
		},
	});
}
