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
		url: base_url + _controller +  "/get_data_group",
		method: "GET",
		dataType: "json",
		success: function (data) {
			var table = $("#datatable-buttons").DataTable({
				destroy: true,
				scrollY: 320,
				data: data,
				responsive: true,
				columns: [
					{ data: null,
						render: function(data,type,row,meta){
							return meta.row + 1;
						},
					},
					{ data: "kodeg" },
					{ data: "namag" },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-outline-info" data-toggle="modal" data-target="bs-example-modal-lg" title="edit" onclick="submit(' +
								row.id +
								')"><i class="ion-edit"></i></button> ' +
								'<button class="btn btn-outline-warning waves-effect waves-light" data-toggle="modal" data-animation="bounce" data-target="#exampleModal" title="hapus" data-id="' +
								row.id +
								'"><i class="ion-trash-b"></i></button> '
							);
						},
					},
				],
			});
		},
		error: function (xhr, textStatus, errorThrown) {
			console.log(xhr.statusText);
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
			url: base_url + _controller +  "/get_data_id",
			dataType: "json",
			success: function (hasil) {
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
		url: base_url +  _controller +"/insert_data",
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
	formData.append("kodeg", $("[name='kodeg']").val());
	formData.append("namag", $("[name='namag']").val());

	$.ajax({
		type: "POST",
		url: base_url + "Data_group/edit_data",
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
				$("#modalHapus").modal("hide");
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
		url: base_url  + "Data_group/delete_data",
		success: function (response) {
			if (response.success) {
				$(".bs-example-modal-center").modal("hide");
				showAlertifySuccess(response.success);
				get_data();
			} else if (response.error) {
				$(".bs-example-modal-center").modal("hide");
				showAlertifyError(response.error);
				get_data();
			}
		},
	});
}
