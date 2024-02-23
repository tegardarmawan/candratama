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
	$("[name='kode']").val("");
	$("[name='induk']").val("");
	$("[name='nama']").val("");
	$("[name='tempat']").val("");
	$("[name='tanggal']").val("");
	$("[name='alamat']").val("");
	$("[name='kota']").val("");
	$("[name='telp']").val("");
	$("[name='status1']").val("");
	$("[name='jabatan']").val("");
}

function delete_error() {
	$("#error-kode").hide();
	$("#error-induk").hide();
	$("#error-tempat").hide();
	$("#error-tanggal").hide();
	$("#error-alamat").hide();
	$("#error-kota").hide();
	$("#error-telp").hide();
	$("#error-status1").hide();
	$("#error-jabatan").hide();
}

function get_data() {
	delete_error();
	$.ajax({
		url: base_url + _controller +  "/get_data",
		method: "GET",
		dataType: "json",
		success: function (data) {
			var table = $("#datatable-buttons").DataTable({
				destroy: true,
				scrollY: 400,
				scrollX: 320,
				data: data,
				responsive: true,
				columns: [
					{ data: null,
						render: function(data,type,row,meta){
							return meta.row + 1;
						},
					},
					{ data: "kodek" },
					{ data: "no_induk" },
					{ data: "namak" },
					{ data: "tempat" },
					{ data: "tgl" },
					{ data: "alamat" },
					{ data: "kota" },
					{ data: "telp" },
					{ data: "status" },
					{ data: "jabatan" },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-outline-primary" data-toggle="modal" data-target=".bs-example-modal-lg" title="Edit Data" onclick="submit(' +
								row.id +
								')"><i class="ion-edit"></i></button> ' +
								'<button class="btn btn-outline-danger waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target="#modalHapus" title="Hapus Data" data-id="' +
								row.id +
								'"><i class="ion-trash-b"></i></button> '
							);
						},
					},
				],
			});
		},
		error: function (xhr, textstatus1, errorThrown) {
			console.log(xhr.status1Text);
		},
	});
}

function submit(x) {
	if (x == "tambah") {
		$("#btn-insert").show();
		$("#btn-update").hide();
		$("[name='title']").text("Tambah Data Karyawan");
	} else {
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Edit Data Karyawan");

		$.ajax({
			type: "POST",
			data: "id=" + x,
			url: base_url + "/" + _controller +  "/get_data_id",
			dataType: "json",
			success: function (hasil) {
				$("[name= 'id']").val(hasil[0].id);
				$("[name='kode']").val(hasil[0].kodek);
				$("[name='induk']").val(hasil[0].no_induk);
				$("[name='nama']").val(hasil[0].namak);
				$("[name='tempat']").val(hasil[0].tempat);
				$("[name='tanggal']").val(hasil[0].tgl);
				$("[name='alamat']").val(hasil[0].alamat);
				$("[name='kota']").val(hasil[0].kota);
				$("[name='telp']").val(hasil[0].telp);
				$("[name='status1']").val(hasil[0].status1);
				$("[name='jabatan']").val(hasil[0].jabatan);
			},
		});
	}
	delete_form();
	delete_error();
}

function insert_data() {
	var formData = new FormData();
	formData.append('kode', $("[name='kode']").val());
	formData.append('induk', $("[name='induk']").val());
	formData.append('nama', $("[name='nama']").val());
	formData.append('tempat', $("[name='tempat']").val());
	formData.append('tanggal', $("[name='tanggal']").val());
	formData.append('alamat', $("[name='alamat']").val());
	formData.append('kota', $("[name='kota']").val());
	formData.append('telp', $("[name='telp']").val());
	formData.append('status1', $("[name='status1']").val());
	formData.append('jabatan', $("[name='jabatan']").val());

	$.ajax({
		type: "POST",
		url: base_url + _controller +"/insert_data",
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
	formData.append('kode', $("[name='kode']").val());
	formData.append('induk', $("[name='induk']").val());
	formData.append('nama', $("[name='nama']").val());
	formData.append('tempat', $("[name='tempat']").val());
	formData.append('tanggal', $("[name='tanggal']").val());
	formData.append('alamat', $("[name='alamat']").val());
	formData.append('kota', $("[name='kota']").val());
	formData.append('telp', $("[name='telp']").val());
	formData.append('status1', $("[name='status1']").val());
	formData.append('jabatan', $("[name='jabatan']").val());

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
		url: base_url  + "/" + _controller + "/delete_data",
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
