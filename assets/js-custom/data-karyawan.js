get_data();

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
	$("[name='nama']").val("");
	$("[name='tempat']").val("");
	$("[name='tanggal']").val("");
	$("[name='alamat']").val("");
	$("[name='kota']").val("");
	$("[name='telp']").val("");
	$("[name='divisi']").val("").prop("selectedIndex", 0).trigger("change");
	$("[name='jabatan']").val("").prop("selectedIndex", 0).trigger("change");
}

function delete_error() {
	$("#error-kode").hide();
	$("#error-induk").hide();
	$("#error-tempat").hide();
	$("#error-tanggal").hide();
	$("#error-alamat").hide();
	$("#error-kota").hide();
	$("#error-telp").hide();
	$("#error-divisi").hide();
	$("#error-jabatan").hide();
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
				scrollY: 400,
				scrollX: 350,
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
					{ data: "kodek" },
					{ data: "no_induk" },
					{ data: "namak" },
					{ data: "tempat" },
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
					{ data: "alamat" },
					{ data: "kota" },
					{ data: "telp" },
					{ data: "nama_divisi" },
					{ data: "nama" }, //data jabatan
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-outline-primary mb-1" data-toggle="modal" data-target=".bs-example-modal-lg" title="Edit Data" onclick="submit(' +
								row.id +
								')"><i class="ion-edit"></i></button> ' +
								'<button class="btn btn-outline-danger waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target="#modalHapus" title="Hapus Data" data-id="' +
								row.id +
								'"><i class="fas fa-trash"></i></button> '
							);
						},
					},
				],
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
		error: function (xhr, textstatus1, errorThrown) {
			console.log(xhr.status1Text);
		},
	});
}
$(document).ready(function () {
	//trigger change untuk input 'select' jabatan
	$("#divisi").change(function () {
		var divisi = $(this).val();
		if (divisi != "") {
			$.ajax({
				type: "POST",
				url: base_url + _controller + "/get_jabatan_by_divisi",
				data: { divisi: divisi }, //'divisi' sebelum ':' merupakan key parameter yang ada di controller yang akan menerima nilai 'divisi' setelah ':'
				dataType: "json",
				success: function (data) {
					$("#jabatan").html('<option value="">Pilih Jabatan</option>');
					$.each(data, function (key, value) {
						$("#jabatan").append(
							'<option value="' + value.id + '">' + value.nama + "</option>"
						);
					});
					// Setelah jabatan dimuat, atur nilai jabatan jika ada
					var selectedJabatan = $("[name='jabatan']").data("selected");
					if (selectedJabatan) {
						$("[name='jabatan']").val(selectedJabatan).removeData("selected");
					}
				},
			});
		} else {
			$("#jabatan").html('<option value="">Pilih Jabatan</option>');
		}
	});

	//refresh auto generate no induk
	$("#generateNoIndukBtn").on("click", function () {
		// Panggil endpoint yang menghasilkan nomor induk baru
		$.ajax({
			type: "GET", // Gunakan metode GET
			url: base_url + _controller + "/generate_no_induk",
			success: function (response) {
				// Asumsikan response berisi nomor induk yang baru
				$("#modalBodyInduk").text(response);
				// Tampilkan modal
				$("#modalInduk").modal("show");
			},
			error: function () {
				alert("Gagal menghasilkan nomor induk. Silakan coba lagi.");
			},
		});
	});
});

function submit(x) {
	if (x == "tambah") {
		$("#btn-insert").show();
		$("#btn-update").hide();
		$("#noinduk").hide();
		$("[name='title']").text("Tambah Data Karyawan");
	} else {
		$("#noinduk").show();
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Edit Data Karyawan");

		$.ajax({
			type: "POST",
			data: "id=" + x,
			url: base_url + "/" + _controller + "/get_data_id",
			dataType: "json",
			success: function (hasil) {
				$("[name= 'id']").val(hasil[0].id);
				$("[name='induk']").val(hasil[0].no_induk);
				$("[name='nama']").val(hasil[0].namak);
				$("[name='tempat']").val(hasil[0].tempat);
				var date = new Date(hasil[0].tgl);
				var formattedDate =
					date.getDate().toString().padStart(2, "0") +
					"/" +
					(date.getMonth() + 1).toString().padStart(2, "0") +
					"/" +
					date.getFullYear();
				$("[name='tanggal']").val(formattedDate);
				$("[name='alamat']").val(hasil[0].alamat);
				$("[name='kota']").val(hasil[0].kota);
				$("[name='telp']").val(hasil[0].telp);
				$("[name='divisi']").val(hasil[0].id_divisi).trigger("change");
				$("[name='jabatan']").data("selected", hasil[0].id_jabatan);
			},
		});
	}
	delete_form();
	delete_error();
}

function insert_data() {
	var formData = new FormData();
	formData.append("kode", $("[name='kode']").val());
	formData.append("induk", $("[name='induk']").val());
	formData.append("nama", $("[name='nama']").val());
	formData.append("tempat", $("[name='tempat']").val());
	formData.append("tanggal", $("[name='tanggal']").val());
	formData.append("alamat", $("[name='alamat']").val());
	formData.append("kota", $("[name='kota']").val());
	formData.append("telp", $("[name='telp']").val());
	formData.append("divisi", $("[name='divisi']").val());
	formData.append("jabatan", $("[name='jabatan']").val());

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
				$("[name='kode']").val(response.kodekaryawan);
				get_data();
			}
		},
		error: function (xhr, status1, error) {
			console.error("AJAX Error: " + error);
		},
	});
}

function edit_data() {
	var formData = new FormData();
	formData.append("id", $("[name='id']").val());
	formData.append("induk", $("[name='induk']").val());
	formData.append("nama", $("[name='nama']").val());
	formData.append("tempat", $("[name='tempat']").val());
	formData.append("tanggal", $("[name='tanggal']").val());
	formData.append("alamat", $("[name='alamat']").val());
	formData.append("kota", $("[name='kota']").val());
	formData.append("telp", $("[name='telp']").val());
	formData.append("divisi", $("[name='divisi']").val());
	formData.append("jabatan", $("[name='jabatan']").val());

	$.ajax({
		type: "POST",
		url: base_url + _controller + "/edit_data",
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function (response) {
			if (response.errors) {
				delete_error();
				for (var fieldName in response.errors) {
					$("#error-" + fieldName).show();
					$("#error-" + fieldName).html(response.errors[fieldName]);
				}
			} else if (response.success) {
				$(".bs-example-modal-lg").modal("hide");
				showAlertifySuccess(response.success);
				get_data();
			}
		},
		error: function (xhr, status1, error) {
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
