get_data_keluar();

function get_data_keluar() {
	$.ajax({
		type: "GET",
		url: base_url + _controller + "/get_data_keluar",
		dataType: "json",
		success: function (data) {
			var table = $("#datatable-buttons").DataTable({
				destroy: true,
				responsive: true,
				data: data,
				columns: [
					// nota tgl waktu ket aksi
					{ data: "nota" },
					{ data: "ket" },
					// {
					// 	data: "hbeli",
					// 	render: function (data, type, row) {
					// 		return "Rp " + addCommas(data.toString());
					// 	},
					// },
					// {
					// 	data: null,
					// 	render: function (data, type, row, meta) {
					// 		var total = row.hbeli * row.masuk;
					// 		return "Rp " + addCommas(total.toString());
					// 	},
					// },
					{
						data: null,
						render: function (data, type, row) {
							return (
								'<button class="btn btn-outline-success" title="Detail Data" onclick="window.location.href=\'' +
								base_url +
								"Stock_keluar_detail/index/" +
								row.nota +
								'\'"><i class="ion-eye"></i></button>'
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
