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
		},
		columns: [{ data: "project" }],
		responsive: true,
	});
}

function insert_data() {
	const notaElement = document.getElementById("nota");
	// Mengambil nilai dari elemen nota
	const notaValue = notaElement.textContent || notaElement.innerText;
	var formData = new FormData();
	$("#my-table tbody tr").each(function () {
		var project = $(this).find("td:eq(0)").text();

		formData.append("project[]", project);
	});
	formData.append("nota", notaValue);
	formData.append("kodec", $("[name='kodec']").val());
	formData.append("namac", $("[name='namac']").val());
	formData.append("tgl", $("[name='tgl']").val());

	$.ajax({
		type: "POST",
		url: base_url + _controller + "/insert_data",
		data: formData,
		dataType: "json",
		processData: false,
		contentType: false,
		success: function (response) {
			if (response.errors) {
				for (var fieldName in response.errors) {
					$("#error-" + fieldName).show();
					$("#error-" + fieldName).html(response.errors[fieldName]);
				}
			} else if (response.success) {
				showAlertifySuccess(response.success);
				setTimeout(function () {
					window.location.replace(base_url + "Project");
				}, 1000);
				get_data();
			}
		},
		error: function (xhr, status, error) {
			console.error("AJAX Error: " + error);
		},
	});
}

function removeProduk(button) {
	const row = button.parentElement.parentElement;
	row.remove();
}

function initializeCustomerSelect() {
	$("#namac").select2({
		placeholder: "Pilih nama customer",
	});

	// Event change pada select2
	$("#namac").on("change", function () {
		fetchKodeCustomer($(this).val());
	});

	// Trigger saat halaman dimuat
	var initialValue = $("#namac").val();
	if (initialValue) {
		fetchKodeCustomer(initialValue);
	}
}

function fetchKodeCustomer(selectedNamaCustomer) {
	$.ajax({
		type: "POST",
		url: base_url + "/" + _controller + "/get_kode_customer",
		data: { nama_customer: selectedNamaCustomer },
		dataType: "json",
		success: function (response) {
			if (response.kode_customer) {
				$("#kodec").val(response.kode_customer);
			} else if (response.error) {
				console.error(response.error);
				$("#kodec").val("Error");
			}
		},
		error: function (xhr, status, error) {
			console.error("Error fetching customer data:", error);
		},
	});
}

// Panggil fungsi inisialisasi saat dokumen siap
$(document).ready(function () {
	initializeCustomerSelect();
});
//function untuk melakukan editable table
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
				if (active.length && active.index() === 0) {
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
