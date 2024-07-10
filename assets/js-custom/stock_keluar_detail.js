get_data();
function get_data() {
	$("#my-table").DataTable({
		ajax: {
			url: base_url + _controller + "/get_data/" + nota,
			method: "GET",
			dataType: "json",
			dataSrc: function (json) {
				if (json.error) {
					console.error(json.error);
					alert("Error: " + json.error);
					return [];
				}
				return json;
			},
			success: function (data) {
				$("#my-table").DataTable({
					destroy: true,
					data: data,
					responsive: true,
					columns: [
						{ data: "kodeb" },
						{ data: "namab" },
						{ data: "waktu" },
						{ data: "keluar" },
					],
				});
			},
			error: function (jqXHR, textStatus, errorThrown) {
				console.error("AJAX error: " + textStatus + " - " + errorThrown);
				alert("An error occurred while fetching data.");
			},
		},
	});
}
