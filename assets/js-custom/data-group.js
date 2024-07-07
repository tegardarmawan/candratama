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
	$("[name='kodeg']").val("");
	$("[name='namag']").val("");
}

function delete_error() {
	$("#error-kodeg").hide();
	$("#error-namag").hide();
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
					{
						data: null,
						render: function (data, type, row, meta) {
							return meta.row + 1;
						},
					},
					{ data: "kodeg" },
					{ data: "namag" },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-outline-primary mb-1" data-toggle="modal" data-target=".bs-example-modal-lg" title="Edit Data" onclick="submit(' +
								row.id +
								')"><i class="ion-edit"></i></button> ' +
								'<button class="btn btn-outline-danger waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target="#modalHapus" title="Hapus Data" data-id="' +
								row.id +
								'"><i class="fas fa-trash"></i></button>'
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
			console.error("AJAX Error : " + error);
		},
	});
}

function submit(x) {
	if (x == "tambah") {
		$("#btn-insert").show();
		$("#btn-update").hide();
		$("[name='title']").text("Tambah Data Group");
	} else {
		$("#btn-insert").hide();
		$("#btn-update").show();
		$("[name='title']").text("Edit Data Group");

		$.ajax({
			type: "POST",
			data: "id=" + x,
			url: base_url + "/" + _controller + "/get_data_id",
			dataType: "json",
			success: function (hasil) {
				$("[name= 'id']").val(hasil[0].id);
				$("[name='kodeg']").val(hasil[0].kodeg);
				$("[name='namag']").val(hasil[0].namag);
			},
		});
	}
	delete_form();
	delete_error();
}

function insert_data() {
	var formData = new FormData();
	formData.append("kodeg", $("[name='kodeg']").val());
	formData.append("namag", $("[name='namag']").val());

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
				get_data();
			}
		},
		error: function (xhr, status, error) {
			console.error("AJAX Error: " + error);
		},
	});
}

function edit_data() {
	var formData = new FormData();
	formData.append("id", $("[name='id']").val());
	formData.append("kodeg", $("[name='kodeg']").val());
	formData.append("namag", $("[name='namag']").val());

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
