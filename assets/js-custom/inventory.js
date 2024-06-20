get_data_masuk();

function get_data_masuk() {
	$.ajax({
		type: "GET",
		url: base_url + _controller + "/get_data_masuk",
		dataType: "json",
		success: function (data) {
			var table = $("#datatable-buttons").DataTable({
				destroy: true,
				responsive: true,
				data: data,
				columns: [
					// nota tgl waktu ket aksi
					{ data: "nota" },
					{ data: "tgl" },
					{ data: "waktu" },
					{ data: "namab" },
					{ data: "masuk" },
					// {
					// 	data: null,
					// 	render: function (data, type, row) {
					// 		return (
					// 			'<button class="btn btn-outline-danger mb-1" data-toggle="modal" data-target="#modalHapus" title="Hapus Data" data-id="' +
					// 			row.id +
					// 			'"><i class="fas fa-trash"></i></button> ' +
					// 			'<button class="btn btn-outline-success" title="Detail Data" onclick="window.location.href=\'' +
					// 			base_url +
					// 			"Stock_masuk_detail/index/" +
					// 			row.nota +
					// 			'\'"><i class="ion-eye"></i></button>'
					// 		);
					// 	},
					// },
				],
			});
		},
		error: function (xhr, textStatus, errorThrown, error) {
			console.error("AJAX Error: " + error);
		},
	});
}
