document.onkeydown = function (e) {
	if (event.keyCode == 123) {
		return false;
	}
	if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
		return false;
	}
	if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
		return false;
	}
	if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
		return false;
	}
	if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
		return false;
	}
}

$(document).ready(function () {
	$('.select2').select2({
		placeholder: "Satuan",
		allowClear: true
	});
	$('.katagori').select2({
		placeholder: "Kategori",
		allowClear: true
	})
	$('.aktif').select2({
		placeholder: "Aktif",
		allowClear: true
	})
	$('.sup').select2({
		placeholder: "Supplier",
		allowClear: true
	})
	$('.masa').select2({
		placeholder: "Masa Aktif",
		allowClear: true
	})
	$('.meka').select2({
		placeholder: "Mekanik",
		allowClear: true
	})
	$('.pela').select2({
		placeholder: "Pelanggan"
	})
	$('.level').select2({
		placeholder: "Level",
		allowClear: true
	})
	$('.akun').select2({
		placeholder: "Level",
		allowClear: true
	})
	$('.pembayaran').select2({
		placeholder: "Pembayaran",
		allowClear: true
	})
	$('.pencarian').select2({
		placeholder: "Cari Berdasarkan"
	})
	var placeholder = $('.kategori').data('place');
	$('.kategori').select2({
		placeholder: placeholder
	})
});

$('#reservation').daterangepicker({
	opens: 'left',
	autoUpdateInput: false,
	showInputs: false,
	showMeridian: false,
	locale: {
		format: 'DD-MM-YYYY'
	}
});

$('.tanggalpicker').on('apply.daterangepicker', function (ev, picker) {
	$(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
});

$('.tanggalpicker').on('cancel.daterangepicker', function (ev, picker) {
	$(this).val('');
});


$('input[name="tglPem"]').on('apply.daterangepicker', function (ev, picker) {
	$(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
});

$('input[name="tglPem"]').on('cancel.daterangepicker', function (ev, picker) {
	$(this).val('');
});

$('input[name="tglPen"]').on('apply.daterangepicker', function (ev, picker) {
	$(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
});

$('input[name="tglPen"]').on('cancel.daterangepicker', function (ev, picker) {
	$(this).val('');
});


$('input[name="tglPembayaran"]').on('apply.daterangepicker', function (ev, picker) {
	$(this).val(picker.startDate.format('DD-MM-YYYY') + ' - ' + picker.endDate.format('DD-MM-YYYY'));
});

$('input[name="tglPembayaran"]').on('cancel.daterangepicker', function (ev, picker) {
	$(this).val('');
});

$('#txttgl_pembelian').datepicker({
	showAnim: 'blind',
	dateFormat: 'dd-mm-yy'
});

$('#tgl_penjualan').datepicker({
	showAnim: 'blind',
	dateFormat: 'dd-mm-yy'
});

$("#kode_pelanggan").on("change", function () {
	$(this).find("option:selected").each(function () {
		var optionvalue = $(this).attr("value");
		if (optionvalue == "PelangganBaru") {
			$('#pelanggan').modal('show');
		}
	});

});
$("#kode_supplier").on("change", function () {
	$(this).find("option:selected").each(function () {
		var optionvalue = $(this).attr("value");
		if (optionvalue == "SupplierBaru") {
			$('#supplier').modal('show');
		}
	});
});

$("#id_satuan").on("change", function () {
	$(this).find("option:selected").each(function () {
		var optionvalue = $(this).attr("value");
		if (optionvalue == "SatuanBaru") {
			$('#satuan').modal('show');
			$('#form-modal').modal('hide');
		}
	});

});

$("#batalsatuan").on("click", function () {
	$('#satuan').modal('hide');
	$('#form-modal').modal('show');
	$("#id_satuan")
		.val("")
		.trigger("change");
})

$("#batalkategori").on("click", function () {
	$('#kategori').modal('hide');
	$('#form-modal').modal('show');
	$("#id_kategori")
		.val("")
		.trigger("change");
})

$("#supdata").on("click", function () {
	$("#kode_supplier")
		.val("")
		.trigger("change");
})


$("#id_kategori").on("change", function () {
	$(this).find("option:selected").each(function () {
		var optionvalue = $(this).attr("value");
		if (optionvalue == "KategoriBaru") {
			$('#kategori').modal('show');
			$('#form-modal').modal('hide');
		}
	});
});


lappembelian();

function lappembelian() {
	$('#pilih').val('nama_barang')
		.trigger("change");
}

lappenjualan();

function lappenjualan() {
	$('#pilih2').val('nama_barang')
		.trigger("change");
}

lapmasaaktif();

function lapmasaaktif() {
	$('#pilih3').val('kode_produksi_pem')
		.trigger("change");
}

lapstok();

function lapstok() {
	$('#pilihan').val('kode_produksi_pem')
		.trigger("change");
}
