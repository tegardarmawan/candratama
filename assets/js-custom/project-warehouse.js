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
			$("[name='kodec']").val(hasil[0].kodec);
			$("[name= 'namac']").val(hasil[0].namac).trigger("change");
			$("[name= 'project']").val(hasil[0].project);
			$("[name= 'kontrak']").val(hasil[0].kontrak);
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
					{ data: "nota" },
					{ data: "namac" },
					{ data: "project" },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-outline-primary" title="Edit Data" onclick="window.location.href=\'' +
								base_url +
								"Project_warehouse_new/index/" +
								row.nota +
								'\'"><i class="ion-edit"></i></button> ' +
								'<button class="btn btn-outline-success" data-toggle="modal" data-target="#lihat" title="detail" onclick="submit(' +
								row.id +
								')"><i class="ion-eye"></i></button>'
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
