function showAlertifySuccess(message) {
	$("body").append(alertify.success(message));
}
function showAlertifyError(message) {
	$("body").append(alertify.error(message));
}
$(document).ready(function () {
	var date = moment();

	var currentDate = date.format("D/MM/YYYY");
	$("#tgl").val(currentDate);
});
function kembali() {
	window.location.replace(base_url + "Inventory/stock_masuk");
}
$("#btn-insert").on("click", function () {
	// Get selected values from the select2
	var selectedValues = $("#namab").val();
	// Clear previous errors
	$("#error-namab").text("");

	// Check if there are selected values
	if (!selectedValues || selectedValues.length === 0) {
		$("#error-namab").text("Silakan pilih barang.");
		return;
	}

	// Loop through selected values and add rows to the table
	$.each(selectedValues, function (index, value) {
		// Mencari elemen <option> berdasarkan value yang dipilih
		var option = $("#namab option[value='" + value + "']");
		// Mengambil teks dari elemen <option>, yang merupakan nama barang
		var namab = option.text();
		// Improved Row and Tabledit Initialization (moved inside success callback)
		var newRow = `
            <tr>
                <td id="value-id" name="value" data-value="${value}">${value}</td>
                <td id="namab-id" name="namab-name" data-namab="${namab}">${namab}</td>
                <td id="masuk" name="masuk" data-masuk=""><td>
                <td><button class="btn btn-danger waves-effect waves-light btn-delete">Delete</button></td>
            </tr>
        `;
		$("#my-table tbody").append(newRow);
	});
	$("#my-table").on("click", ".btn-delete", function () {
		$(this).closest("tr").remove();
	});
	$("#namab").val(null).trigger("change");
	$("#my-table")
		.editableTableWidget()
		.numericInputExample()
		.find("td:first")
		.focus();
});

function insert_data() {
	var formData = new FormData();
	$("#my-table tbody tr").each(function () {
		var value = $(this).find("td:eq(0)").text();
		var namab = $(this).find("td:eq(1)").text();
		var masuk = $(this).find("td:eq(2)").text();

		formData.append("value[]", value);
		formData.append("namab[]", namab);
		formData.append("masuk[]", masuk);
	});
	formData.append("nota", $("[name='nota']").val());
	formData.append("tgl", $("[name='tgl']").val());
	formData.append("namat", $("[name='namat']").val());
	formData.append("ket", $("[name='ket']").val());

	$.ajax({
		type: "POST",
		url: base_url + _controller + "/insert_data",
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function (response) {
			if (response.error) {
				showAlertifyError(response.error);
			} else if (response.success) {
				showAlertifySuccess(response.success);
				setTimeout(function () {
					window.location.replace(base_url + "Inventory/stock_masuk");
				}, 1000);
			}
		},
		error: function (xhr, textStatus, error) {
			console.error("AJAX Error : " + error);
		},
	});
}

$.fn.numericInputExample = function () {
	"use strict";
	var element = $(this);

	var updateStock = function () {
		var stockColumnIndex = 2; // Index of 'stock' column

		element.on("change", 'td[name="keluar"]', function () {
			var cell = $(this);
			var row = cell.closest("tr");
			var stockCell = row.find('td[name="stock"]');
			var keluar = parseFloat(cell.text()) || 0;

			var option = $(
				"#namab option[value='" + row.find('td[name="value"]').text() + "']"
			);
			var stockawal = parseFloat(option.data("stock"));

			stockCell.text(stockawal - keluar); // Update stock value
			stockCell.data("stock", stockawal - keluar);
		});
	};

	updateStock(); // Call the function to initialize the event listener
};
$.fn.editableTableWidget = function (options) {
	"use strict";
	return $(this).each(function () {
		var buildDefaultOptions = function () {
				var opts = $.extend({}, $.fn.editableTableWidget.defaultOptions);
				opts.editor = opts.editor.clone();
				return opts;
			},
			activeOptions = $.extend(buildDefaultOptions(), options),
			ARROW_LEFT = 37,
			ARROW_UP = 38,
			ARROW_RIGHT = 39,
			ARROW_DOWN = 40,
			ENTER = 13,
			ESC = 27,
			TAB = 9,
			element = $(this),
			editor = activeOptions.editor
				.css("position", "absolute")
				.hide()
				.appendTo(element.parent()),
			active,
			showEditor = function (select) {
				active = element.find("td:focus");
				if (active.length && active.index() === 2) {
					editor
						.val(active.text())
						.removeClass("error")
						.show()
						.offset(active.offset())
						.css(active.css(activeOptions.cloneProperties))
						.width(active.width())
						.height(active.height())
						.focus();
					if (select) {
						editor.select();
					}
				}
			},
			setActiveText = function () {
				var text = editor.val(),
					evt = $.Event("change"),
					originalContent;
				if (active.text() === text || editor.hasClass("error")) {
					return true;
				}
				originalContent = active.html();
				active.text(text).trigger(evt, text);
				if (evt.result === false) {
					active.html(originalContent);
				}
			},
			movement = function (element, keycode) {
				if (keycode === ARROW_RIGHT) {
					return element.next("td");
				} else if (keycode === ARROW_LEFT) {
					return element.prev("td");
				} else if (keycode === ARROW_UP) {
					return element.parent().prev().children().eq(element.index());
				} else if (keycode === ARROW_DOWN) {
					return element.parent().next().children().eq(element.index());
				}
				return [];
			};
		editor
			.blur(function () {
				setActiveText();
				editor.hide();
			})
			.keydown(function (e) {
				if (e.which === ENTER) {
					setActiveText();
					editor.hide();
					active.focus();
					e.preventDefault();
					e.stopPropagation();
				} else if (e.which === ESC) {
					editor.val(active.text());
					e.preventDefault();
					e.stopPropagation();
					editor.hide();
					active.focus();
				} else if (e.which === TAB) {
					active.focus();
				} else if (
					this.selectionEnd - this.selectionStart ===
					this.value.length
				) {
					var possibleMove = movement(active, e.which);
					if (possibleMove.length > 0) {
						possibleMove.focus();
						e.preventDefault();
						e.stopPropagation();
					}
				}
			})
			.on("input paste", function () {
				var evt = $.Event("validate");
				active.trigger(evt, editor.val());
				if (evt.result === false) {
					editor.addClass("error");
				} else {
					editor.removeClass("error");
				}
			});
		element
			.on("click keypress dblclick", showEditor)
			.css("cursor", "pointer")
			.keydown(function (e) {
				var prevent = true,
					possibleMove = movement($(e.target), e.which);
				if (possibleMove.length > 0) {
					possibleMove.focus();
				} else if (e.which === ENTER) {
					showEditor(false);
				} else if (e.which === 17 || e.which === 91 || e.which === 93) {
					showEditor(true);
					prevent = false;
				} else {
					prevent = false;
				}
				if (prevent) {
					e.stopPropagation();
					e.preventDefault();
				}
			});

		element.find("td").prop("tabindex", 1);

		$(window).on("resize", function () {
			if (editor.is(":visible")) {
				editor
					.offset(active.offset())
					.width(active.width())
					.height(active.height());
			}
		});
	});
};
$.fn.editableTableWidget.defaultOptions = {
	cloneProperties: [
		"padding",
		"padding-top",
		"padding-bottom",
		"padding-left",
		"padding-right",
		"text-align",
		"font",
		"font-size",
		"font-family",
		"font-weight",
		"border",
		"border-top",
		"border-bottom",
		"border-left",
		"border-right",
	],
	editor: $("<input>"),
};
