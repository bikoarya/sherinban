// start pembelian
$('#caridata').on('click',function() {
	laporantable.ajax.reload(function (json) {
		json.response;
	  });
})
// End Pem

// start Pembayaran
pageLapPembayaran(page_url = false); // mereload Page View

$('#caripembayaran').click(function () {
	var tglPembayaran = $('[name=tglPembayaran]').val();
	pageLapPembayaran(page_url = false);
});

$(document).on('click', ".pagination li a", function () {
	var page_url = $(this).attr('href');
	pageLapPembayaran(page_url);
	return false;
});

function pageLapPembayaran(page_url) {
	$('.bg-load').show();
	$('#loading').show();
	// var cariBarang = $('#cariBarang').val();
	var tglPembayaran = $('[name=tglPembayaran]').val();
	var link = base_url + 'Laporan/LapPembayaran/index_ajax';
	if (page_url) {
		link = page_url;
	}
	$.ajax({
		type: "POST",
		url: link,
		data: {
			tglPembayaran: tglPembayaran
		},
		success: function (response) {
			$('.bg-load').hide();
			$('#loading').hide();
			$("#Vpembayaran").html(response);
		}
	});
}
// End Pembayaran


// start Masaaktif
pageLapMasaaktif(page_url = false); // mereload Page View

$('#carimasaaktif').click(function () {
	var cariBarang = $('#cariBarang').val();
	pageLapMasaaktif(page_url = false);
});

$(document).on('click', ".pagination li a", function () {
	var page_url = $(this).attr('href');
	pageLapMasaaktif(page_url);
	return false;
});

function pageLapMasaaktif(page_url) {
	$('.bg-load').show();
	$('#loading').show();
	var cariBarang = $('#cariBarang').val();
	var keys = $('#pilih3').val();
	var link = base_url + 'Laporan/LapMasaAktif/index_ajax';
	if (page_url) {
		link = page_url;
	}
	$.ajax({
		type: "POST",
		url: link,
		data: {
			cariBarang: cariBarang,
			keys: keys
		},
		success: function (response) {
			$('.bg-load').hide();
			$('#loading').hide();
			$("#vlapmasaaktif").html(response);
		}
	});
}
// End Penjualan
