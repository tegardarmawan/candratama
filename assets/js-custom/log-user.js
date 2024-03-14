get_data();

$(".bs-example-modal-center").on("show.bs.modal", function (e) {
	var button = $(e.relatedTarget);
	var id = button.data("id");

	// Mengatur data-id pada tombol hapus di dalam modal
	$("#btn-hapus").data("id", id);
});

// Menangani klik pada tombol hapus di dalam modal
$("#btn-hapus").click(function () {
	// Mengambil ID data yang akan dihapus dari atribut data-id tombol
	var id = $(this).data("id");

	// Memanggil fungsi delete_data() dengan ID data yang akan dihapus
	delete_data(id);
});

function showAlertifySuccess(message) {
	$("body").append(alertify.success(message));
}

function showAlertifyError(message) {
	$("body").append(alertify.error(message));
}
function get_data() {
	$.ajax({
		url: base_url + _controller + "/get_data",
		method: "GET",
		dataType: "json",
		success: function (data) {
			var table = $("#datatable-buttons").DataTable({
				destroy: true,
				data: data,
				scrollY: 320,
				scrollX: 320,
				responsive: true,
				columns: [
					{ data: "id" },
					{ data: "user" },
					{ data: "aksi" },
					{ data: "waktu" },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-outline-success" data-toggle="modal" data-target="#modalDetail" title="Detail" onclick="submit(' +
								row.id +
								')"><i class="ion-eye"></i></button>'
							);
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
function submit(x) {
	$.ajax({
		type: "POST",
		data: "id=" + x,
		url: base_url + "/" + _controller + "/get_data_id",
		dataType: "json",
		success: function (response) {
			$("[name='id'").val(response[0].id);
			$("[name='user'").val(response[0].user);
			$("[name='aksi'").val(response[0].aksi);
			$("[name='menu'").val(response[0].nform);
			$("[name='keterangan'").val(response[0].ket);
			$("[name='waktu'").val(response[0].waktu);
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
