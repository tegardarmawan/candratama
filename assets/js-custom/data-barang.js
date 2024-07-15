get_data();
get_data_low();
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
	$("[name='kodeg']").val("").prop("selectedIndex", 0).trigger("change");
	$("[name='nama']").val("");
	$("[name='stock']").val("");
	$("[name='kodest']").val("").prop("selectedIndex", 0).trigger("change");
	$("[name='hargabeli']").val("");
	$("[name='hargapokok']").val("");
	$("[name='hargajual']").val("");
	$("[name='status1']").val("");
	$("[name='stockmin']").val("");
	$("[name='namat']").val("");
	$("[name='project']").val("").prop("selectedIndex", 0).trigger("change");
}

function delete_error() {
	$("#error-kodeg").hide();
	$("#error-nama").hide();
	$("#error-stock").hide();
	$("#error-kodest").hide();
	$("#error-hargabeli").hide();
	$("#error-hargapokok").hide();
	$("#error-hargajual").hide();
	$("#error-status1").hide();
	$("#error-stockmin").hide();
	$("#error-namat").hide();
	$("#error-project").hide();
}

//fungsi untuk auto formatting currency
$(document).ready(function () {
	//membuat fungsi yang akan ditrigger ketika terjadi proses input pada field id hargabeli
	$(".harga").on("input", function () {
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
					{
						orderable: false,
						data: null,
						render: function (data, type, row) {
							return (
								'<input type="checkbox" class="select-row" value="' +
								row.id +
								'">'
							);
						},
					},
					{ data: "kodeb" },
					{ data: "namab" },
					{ data: "stock" },
					{ data: "stockmin" },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-outline-primary mb-1" title="Edit Data" onclick="window.location.href=\'' +
								base_url +
								"Data_barang_masuk/index/" +
								row.kodeb +
								'\'"><i class="ion-edit"></i></button> ' +
								'<button class="btn btn-outline-danger mb-1" data-toggle="modal" data-target="#modalHapus" title="Hapus Data" data-id="' +
								row.id +
								'"><i class="fas fa-trash"></i></button> ' +
								'<button class="btn btn-outline-success mb-1" data-toggle="modal" data-target="#detail" title="Detail Data" onclick="submit(' +
								row.id +
								')"><i class="ion-eye"></i></button>'
							);
						},
					},
				],
				createdRow: function (row, data, dataIndex) {
					if (data.stock < data.stockmin) {
						$(row).addClass("low-stock");
					}
					if (data.stock <= 0) {
						$(row).addClass("empty-stock");
					}
				},
				dom: "Bfrtip",
				buttons: [
					{
						text: "Select All",
						className: "btn btn-success",
						action: function (e, dt, node, config) {
							$(".select-row").prop("checked", true);
						},
					},
					{
						text: "Deselect All",
						className: "btn btn-warning",
						action: function (e, dt, node, config) {
							$(".select-row").prop("checked", false);
						},
					},
				],
			});
			// Handle click on "Select all" control
			$("#select-all").on("click", function () {
				$(".select-row").prop("checked", this.checked);
			});

			// Handle click on bulk delete button
			$("#bulk-delete").on("click", function () {
				var selectedIds = [];
				$(".select-row:checked").each(function () {
					selectedIds.push($(this).val());
				});

				if (selectedIds.length === 0) {
					showAlertifyError("Pilih baris untuk dihapus");
					return;
				}

				$.ajax({
					type: "POST",
					url: base_url + "/" + _controller + "/bulk_delete",
					data: { ids: selectedIds },
					dataType: "json",
					success: function (response) {
						if (response.success) {
							$(".select-row:checked").each(function () {
								table.row($(this).closest("tr")).remove().draw();
							});
							showAlertifySuccess(response.success);
							get_data();
						} else {
							showAlertifyError(response.error);
							get_data();
						}
					},
				});
			});
		},
		error: function (xhr, textStatus, errorThrown, error) {
			console.error("AJAX Error: " + error);
		},
	});
}
function get_data_low() {
	delete_error();
	$.ajax({
		url: base_url + _controller + "/get_data_low",
		method: "GET",
		dataType: "json",
		success: function (data) {
			var table = $("#datatable-buttons").DataTable({
				destroy: true,
				data: data,
				responsive: true,
				columns: [{ data: "kodeg" }, { data: "kodeb" }, { data: "namab" }],
			});
		},
		error: function (xhr, textStatus, errorThrown, error) {
			console.error("AJAX Error: " + error);
		},
	});
}
function get_data_empty() {
	delete_error();
	$.ajax({
		url: base_url + _controller + "/get_data_empty",
		method: "GET",
		dataType: "json",
		success: function (data) {
			var table = $("#datatable-buttons").DataTable({
				destroy: true,
				data: data,
				responsive: true,
				columns: [{ data: "kodeg" }, { data: "kodeb" }, { data: "namab" }],
			});
		},
		error: function (xhr, textStatus, errorThrown, error) {
			console.error("AJAX Error: " + error);
		},
	});
}
function stoking() {
	winddow.location.href = base_url + "Stock_masuk";
}

function submit(x) {
	if (x == "tambah") {
		$("#btn-insert").show();
		$("#btn-update").hide();
		$("[name='title']").text("Tambah Data Barang");
	} else {
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Data Barang");

		$.ajax({
			type: "POST",
			data: "id=" + x,
			url: base_url + "/" + _controller + "/get_data_id",
			dataType: "json",
			success: function (hasil) {
				$("[name= 'id']").val(hasil[0].id);
				$("[name='kodeg']").val(hasil[0].kodeg).trigger("change");
				$("[name='kodeb']").val(hasil[0].kodeb);
				$("[name='nama']").val(hasil[0].namab);
				$("[name='stock']").val(hasil[0].stock);
				$("[name='kodest']").val(hasil[0].namast).trigger("change");
				//memberikan format yang sama pada lihat detail dan edit seperti pada input
				var formattedInput = "Rp " + addCommas(hasil[0].hbeli);
				var formattedInputPokok = "Rp " + addCommas(hasil[0].hpokok);
				var formattedInputJual = "Rp " + addCommas(hasil[0].hjual);
				$("[name='hargabeli']").val(formattedInput);
				$("[name='hargapokok']").val(formattedInputPokok);
				$("[name='hargajual']").val(formattedInputJual);
				$("[name='stockmin']").val(hasil[0].stockmin);
				$("[name='namat']").val(hasil[0].namat);
				$("[name='project']").val(hasil[0].projectt);
			},
		});
	}
	delete_form();
	delete_error();
}

function insert_data() {
	var formData = new FormData();
	formData.append("kodeg", $("[name='kodeg']").val());
	formData.append("kodeb", $("[name='kodeb']").val());
	formData.append("nama", $("[name='nama']").val());
	formData.append("kodest", $("[name='kodest']").val());
	formData.append("stockmin", $("[name='stockmin']").val());
	formData.append("namat", $("[name='namat']").val());
	formData.append("project", $("[name='project']").val());

	$.ajax({
		type: "POST",
		url: base_url + _controller + "/insert_data",
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function (response) {
			delete_error();
			if (response.errors) {
				for (var fieldName in response.errors) {
					$("#error-" + fieldName).show();
					$("#error-" + fieldName).html(response.errors[fieldName]);
				}
			} else if (response.success) {
				$(".bs-example-modal-lg").modal("hide");
				showAlertifySuccess(response.success);
				setTimeout(function () {
					window.location.replace(
						base_url + "Data_barang_masuk/index/" + $("[name='kodeb']").val()
					);
				}, 1000);
			}
		},
		error: function (xhr, status, error) {
			console.error("AJAX Error: " + error);
		},
	});
}

function delete_data(x) {
	$.ajax({
		type: "POST",
		data: "id=" + x,
		dataType: "json",
		url: base_url + "/" + _controller + "/delete_data",
		success: function (response) {
			if (response.success) {
				$("#modalHapus").modal("hide");
				showAlertifySuccess(response.success);
				get_data();
			} else if (response.error) {
				$("#modalHapus").modal("hide");
				showAlertifyError(response.error);
				get_data();
			}
		},
	});
}
