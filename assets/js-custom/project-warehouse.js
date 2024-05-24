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
function tambah_project() {
	window.location.href = "<?= base_url('Project_warehouse_new/index')?>";
}

function submit(x) {
	$("[name='title']").text("Detail Data Stock");

	$.ajax({
		type: "POST",
		data: "id=" + x,
		url: base_url + "/" + _controller + "/get_data_id",
		dataType: "json",
		success: function (hasil) {
			$("[name= 'id']").val(hasil[0].id);
			$("[name= 'nota']").val(hasil[0].nota);
			$("[name='tgl']").val(hasil[0].tgl);
			$("[name= 'kodeb']").val(hasil[0].kodeb);
			$("[name= 'namab']").val(hasil[0].namab);
			$("[name= 'keluar']").val(hasil[0].keluar);
			$("[name= 'satuan']").val(hasil[0].satuan);
			$("[name= 'keluar1']").val(hasil[0].keluar1);
			$("[name= 'no']").val(hasil[0].no);
		},
	});
}

function get_data() {
	// delete_error();
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
					{ data: "nota" },
					{ data: "namab" },
					{ data: "satuan" },
					{ data: "keluar" },
					{ data: "keluar1" },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-outline-danger mb-1" data-toggle="modal" data-animation="bounce" data-target="#modalHapus" title="Hapus Data" data-id="' +
								row.id +
								'"><i class="fas fa-trash"></i></button> ' +
								'<button class="btn btn-outline-success mb-1" data-toggle="modal" data-target="#lihat" title="detail" onclick="submit(' +
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
