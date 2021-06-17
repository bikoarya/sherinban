// $('.datatables').datatable();

// Start Barang Master
pageBarangMaster(page_url = false); // mereload Page View

$(document).on('keyup', "#cari_key", function () { //mencari nama Barang Dari Text Pencarian
	pageBarangMaster(page_url = false);
	return false;
});

$(document).on('click', ".pagination li a", function () {
	var page_url = $(this).attr('href');
	pageBarangMaster(page_url);
	return false;
});

function pageBarangMaster(page_url) {
	$('.bg-load').show();
	$('#loading').show();
	var cari = $('#cari_key').val();
	var link = base_url + 'Master/Barang/index_ajax/';

	if (page_url) {
		link = page_url;
	}

	$.ajax({
		type: "POST",
		url: link,
		data: {
			cari: cari
		},
		success: function (response) {
			$('.bg-load').hide();
			$('#loading').hide();
			$('.tmpilbarang').html(response);
		}
	});
}
// End Barang Master


// start kategori master
pageKategoriMaster(page_url = false); // mereload Page View

$(document).on('keyup', "#cari_key", function () { //mencari nama Barang Dari Text Pencarian
	pageKategoriMaster(page_url = false);
	return false;
});

$(document).on('click', ".pagination li a", function () {
	var page_url = $(this).attr('href');
	pageKategoriMaster(page_url);
	return false;
});

function pageKategoriMaster(page_url) {
	$('.bg-load').show();
	$('#loading').show();
	var cari = $('#cari_key').val();
	var link = base_url + 'Master/Kategori/index_ajax/';

	if (page_url) {
		link = page_url;
	}

	$.ajax({
		type: "POST",
		url: link,
		data: {
			cari: cari
		},
		success: function (response) {
			$('.bg-load').hide();
			$('#loading').hide();
			$('.tmpkategori').html(response);
		}
	});
}
// end kategori master


// start satuan Master 
pageSatuanMaster(page_url = false); // mereload Page View

$(document).on('keyup', "#cari_key", function () { //mencari nama Barang Dari Text Pencarian
	pageSatuanMaster(page_url = false);
	return false;
});

$(document).on('click', ".pagination li a", function () {
	var page_url = $(this).attr('href');
	pageSatuanMaster(page_url);
	return false;
});

function pageSatuanMaster(page_url) {
	$('.bg-load').show();
	$('#loading').show();
	var cari = $('#cari_key').val();
	var link = base_url + 'Master/Satuan/index_ajax/';

	if (page_url) {
		link = page_url;
	}

	$.ajax({
		type: "POST",
		url: link,
		data: {
			cari: cari
		},
		success: function (response) {
			$('.bg-load').hide();
			$('#loading').hide();
			$('.tmplSatuan').html(response);
		}
	});
}

// End Satuan Master 


// Start Supplier Master
pageSupplierMaster(page_url = false); // mereload Page View

$(document).on('keyup', "#cari_key", function () { //mencari nama Barang Dari Text Pencarian
	pageSupplierMaster(page_url = false);
	return false;
});

$(document).on('click', ".pagination li a", function () {
	var page_url = $(this).attr('href');
	pageSupplierMaster(page_url);
	return false;
});

function pageSupplierMaster(page_url) {
	$('.bg-load').show();
	$('#loading').show();
	var cari = $('#cari_key').val();
	var link = base_url + 'Master/Supplier/index_ajax/';

	if (page_url) {
		link = page_url;
	}

	$.ajax({
		type: "POST",
		url: link,
		data: {
			cari: cari
		},
		success: function (response) {
			$('.bg-load').hide();
			$('#loading').hide();
			$('.tmplsupplier').html(response);
		}
	});
}
// End Supplier Master

// Start Pelanggan Master

pagePelangganMaster(page_url = false); // mereload Page View

$(document).on('keyup', "#cari_key", function () { //mencari nama Barang Dari Text Pencarian
	pagePelangganMaster(page_url = false);
	return false;
});

$(document).on('click', ".pagination li a", function () {
	var page_url = $(this).attr('href');
	pagePelangganMaster(page_url);
	return false;
});

function pagePelangganMaster(page_url) {
	$('.bg-load').show();
	$('#loading').show();
	var cari = $('#cari_key').val();
	var link = base_url + 'Master/Pelanggan/index_ajax/';

	if (page_url) {
		link = page_url;
	}

	$.ajax({
		type: "POST",
		url: link,
		data: {
			cari: cari
		},
		success: function (response) {
			$('.bg-load').hide();
			$('#loading').hide();
			$('#vpelanggan').html(response);
		}
	});
}
// End Pelanggan Master


// Start Mekanik Master
pageMekanikMaster(page_url = false); // mereload Page View

$(document).on('keyup', "#cari_key", function () { //mencari nama Barang Dari Text Pencarian
	pageMekanikMaster(page_url = false);
	return false;
});

$(document).on('click', ".pagination li a", function () {
	var page_url = $(this).attr('href');
	pageMekanikMaster(page_url);
	return false;
});

function pageMekanikMaster(page_url) {
	$('.bg-load').show();
	$('#loading').show();
	var cari = $('#cari_key').val();
	var link = base_url + 'Master/Mekanik/index_ajax/';

	if (page_url) {
		link = page_url;
	}

	$.ajax({
		type: "POST",
		url: link,
		data: {
			cari: cari
		},
		success: function (response) {
			$('.bg-load').hide();
			$('#loading').hide();
			$('#viewmekanik').html(response);
		}
	});
}
// End Mekanik Master

// Start Standart Master

pageStandMaster(page_url = false); // mereload Page View

$(document).on('keyup', "#cari_key", function () { //mencari nama Barang Dari Text Pencarian
	pageStandMaster(page_url = false);
	return false;
});

$(document).on('click', ".pagination li a", function () {
	var page_url = $(this).attr('href');
	pageStandMaster(page_url);
	return false;
});

function pageStandMaster(page_url) {
	$('.bg-load').show();
	$('#loading').show();
	var cari = $('#cari_key').val();
	var link = base_url + 'Master/Standart/index_ajax/';

	if (page_url) {
		link = page_url;
	}

	$.ajax({
		type: "POST",
		url: link,
		data: {
			cari: cari
		},
		success: function (response) {
			$('.bg-load').hide();
			$('#loading').hide();

			$('#viewstandart').html(response);
		}
	});
}
// End Standart Master

// Start Penjualan Cari
// pagecriBrgPen(page_url = false); // mereload Page View

// $(document).on('keyup', "#cari_key", function () { //mencari nama Barang Dari Text Pencarian
// 	pagecriBrgPen(page_url = false);
// 	return false;
// });

// $(document).on('click', ".pagination li a", function () {
// 	var page_url = $(this).attr('href');
// 	pagecriBrgPen(page_url);
// 	return false;
// });

// function pagecriBrgPen(page_url) {
// 	$('.bg-load').show();
// 	$('#loading').show();
// 	var cari = $('#cari_key').val();
// 	var link = base_url + 'Transaksi/Penjualan/vcribrng';

// 	if (page_url) {
// 		link = page_url;
// 	}

// 	$.ajax({
// 		type: "POST",
// 		url: link,
// 		data: {
// 			cari: cari
// 		},
// 		success: function (response) {
// 			$('.bg-load').hide();
// 			$('#loading').hide();
// 			$("#vcaribarang").html(response);
// 		}
// 	});
// }
// End Penjualan Cari


// Start Penjualan Cari
pagecriCribrgg(page_url = false); // mereload Page View

$(document).on('keyup', "#cari_key", function () { //mencari nama Barang Dari Text Pencarian
	pagecriCribrgg(page_url = false);
	return false;
});

$(document).on('click', ".pagination li a", function () {
	var page_url = $(this).attr('href');
	pagecriCribrgg(page_url);
	return false;
});

function pagecriCribrgg(page_url) {
	$('.bg-load').show();
	$('#loading').show();
	var cari = $('#cari_key').val();
	var link = base_url + 'Gudang/Pembelian/cribrng';

	if (page_url) {
		link = page_url;
	}

	$.ajax({
		type: "POST",
		url: link,
		data: {
			cari: cari
		},
		success: function (response) {
			$('.bg-load').hide();
			$('#loading').hide();
			$("#vvcribrng").html(response);
		}
	});
}
// End Penjualan Cari


// Start Jasa Master

pageJasaMaster(page_url = false); // mereload Page View

$(document).on('keyup', "#vjasac", function () { //mencari nama Barang Dari Text Pencarian
	pageJasaMaster(page_url = false);
	return false;
});

$(document).on('click', ".pagination li a", function () {
	var page_url = $(this).attr('href');
	pageJasaMaster(page_url);
	return false;
});

function pageJasaMaster(page_url) {
	$('.bg-load').show();
	$('#loading').show();
	var cari = $('#vjasac').val();
	var link = base_url + 'Master/Jasa/index_ajax/';

	if (page_url) {
		link = page_url;
	}

	$.ajax({
		type: "POST",
		url: link,
		data: {
			cari: cari
		},
		success: function (response) {
			$('.bg-load').hide();
			$('#loading').hide();

			$('#tmpJasa').html(response);
		}
	});
}
// End Jasa Master


// Start akun
pageakun(page_url = false); // mereload Page View

$(document).on('keyup', "#cari_key", function () { //mencari nama Barang Dari Text Pencarian
	pageakun(page_url = false);
	return false;
});

$(document).on('click', ".pagination li a", function () {
	var page_url = $(this).attr('href');
	pageakun(page_url);
	return false;
});

function pageakun(page_url) {
	$('.bg-load').show();
	$('#loading').show();
	var cari = $('#cari_key').val();
	var link = base_url + 'Auth/index_ajax/';

	if (page_url) {
		link = page_url;
	}

	$.ajax({
		type: "POST",
		url: link,
		data: {
			cari: cari
		},
		success: function (response) {
			$('.bg-load').hide();
			$('#loading').hide();

			$('.viewakun').html(response);
		}
	});
}
// End Akun
