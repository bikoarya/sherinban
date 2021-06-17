$("#datatambah").load(base_url + "Transaksi/Penjualan/viewP");
$(".subtotal").load(base_url + 'Transaksi/Penjualan/subtotal');
// tombol pembelian disable start
$("#tambahpenjualan").attr("disabled", true);
$("#nm_brg").attr("disabled", true);
$("#hrg_jual").attr("disabled", true);
$("#txtjumlah").attr("disabled", true);
// end tombol disable

kunci();
function kunci() {
	$.ajax({
		url: base_url + 'Transaksi/Penjualan/cartisi',
		method: "POST",
		dataType: "json",
		success: function (data) {
			if (data.lock != 'buka') {
				$('#no_polisi').attr('readonly', false);
				$('#kode_pelanggan').attr('disabled', false);
				$('#txtmekanik').attr('disabled', false);
			} else {
				$('#no_polisi').attr('readonly', true);
				$('#kode_pelanggan').attr('disabled', true);
				$('#txtmekanik').attr('disabled', true);
			}
		}
	});
}

//alert jika stok kososng
$(document).on('click', '.stokkososng', function () {
	Swal.mixin({
		toast: true,
		position: "top-end",
		showConfirmButton: false,
		timer: 10000
	});
	toastr.error('Mohon Maaf Stok Barang Sudah Habis');
})
// end alert

// stok kurang dari batas minimal 
$(document).on("click", ".stkkurang", function () {
	var kode_barang = $(this).data("kode_brg");
	var nama_barang = $(this).data("nama_barang");
	var harga_jual = $(this).data("harga_jual");
	var kode_produksi = $(this).data("kode_produksi");
	var nama_satuan = $(this).data("satuan");
	var nama_kategori = $(this).data("kategori");
	var stokmin = $(this).data("stokmin");
	var nofaktur = $(this).data("nofaktur");
	var qty = $(this).data("qty");

	Swal.fire({
		title: "Peringatan Stok",
		text: "Stok Kurang Dari " + qty + " Apakah Anda Ingin Melanjutkan?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Tambah",
		cancelButtonText: "Batal"
	}).then(result => {
		if (result.value) {
			$("#tambahpenjualan").attr("disabled", false);
			$("#txtnama_barang").attr("disabled", true);
			$("#hrg_jual").attr("disabled", true);
			$("#txtjumlah").attr("disabled", false);
			$("#txtkode_barang").val(kode_barang);
			$("#nm_brg").val(nama_barang);
			$("#hrg_jual").val(harga_jual);
			$("[name='satuan']").val(nama_satuan);
			$("[name='kode_produksi']").val(kode_produksi);
			$("[name='kategori']").val(nama_kategori);
			$("[name='no_faktur']").val(nofaktur);
			$("#txtqty").val(qty);
			$("#v-caribarang").modal("hide");
			const Toast = Swal.mixin({
				toast: true,
				position: "top-end",
				showConfirmButton: false,
				timer: 3000
			});
			toastr.success("Data Barang Berhasil Diakses");
		}
	});
});
// end batas minimal stok 


$(document).on("click", ".caripenjualan", function () {
	var kode_barang = $(this).data("kode_brg");
	var nama_barang = $(this).data("nama_barang");
	var harga_jual = $(this).data("harga_jual");
	var kode_produksi = $(this).data("kode_produksi");
	var nama_satuan = $(this).data("satuan");
	var nama_kategori = $(this).data("kategori");
	var nofaktur = $(this).data("nofaktur");
	var qty = $(this).data("qty");
	var qty1 = $(this).data("qty1");
	var qty2 = $(this).data("qty2");
	var pot2 = $(this).data("pot2");
	var pot1 = $(this).data("pot1");

	$("#tambahpenjualan").attr("disabled", false);
	$("#txtnama_barang").attr("disabled", true);
	$("#hrg_jual").attr("disabled", true);
	$("#txtjumlah").attr("disabled", false);
	$("#txtkode_barang").val(kode_barang);
	$("#nm_brg").val(nama_barang);
	$("#hrg_jual").val(harga_jual);
	$("[name='satuan']").val(nama_satuan);
	$("[name='kode_produksi']").val(kode_produksi);
	$("[name='kategori']").val(nama_kategori);
	$("[name='no_faktur']").val(nofaktur);
	$("#txtqty").val(qty);
	$("#txtjumlah").val('1');

	$("#txtpot1").val(pot1);
	$("#txtpot2").val(pot2);
	$("#txtqty1").val(qty1);
	$("#txtqty2").val(qty2);

	$("#v-caribarang").modal("hide");
	const Toast = Swal.mixin({
		toast: true,
		position: "top-end",
		showConfirmButton: false,
		timer: 3000
	});
	toastr.success("Data Barang Berhasil Diakses");
});

function datapenjualan() {
	var kode_barang = $(this).data('kode_barang');
	var nama_barang = $(this).data('nama_barang');
	var harga_jual = $(this).data('harga_jual');
	var kode_produksi = $(this).data('kode_produksi');
	var nama_satuan = $(this).data('nama_satuan');
	var nama_katagori = $(this).data('nama_katagori');

	$("[name='txtkode_barang']").val(kode_barang);
	$("[name='nm_brg']").val(nama_barang);
	$("[name='hrg_jual']").val(harga_jual);
	$("[name='satuan']").val(nama_satuan);
	$("[name='kode_produksi']").val(kode_produksi);
	$("[name='katagori']").val(nama_katagori);
	$("form").modal('hide');
}


$("#tambahpenjualan").click(function () {
	$("#penjualanvalid").validate({
		rules: {
			kode_pelanggan: {
				required: true
			},
			txtmekanik: {
				required: true
			},
			no_polisi: {
				required: true
			},
			txtjumlah: {
				required: true,
				number: true,
				min: '1',
				max: function () {
					return parseInt($("#txtqty").val());
				}
			}
		},
		messages: {
			kode_pelanggan: {
				required: "Mohon Pilih Pelanggan"
			},
			txtmekanik: {
				required: "Mohon Pilih Nama Mekanik"
			},
			no_polisi: {
				required: "Mohon Masukan No Polisi"
			},
			txtjumlah: {
				required: "Masukan Qty",
				number: "Mohon Isi dengan Angka",
				max: jQuery.validator.format("Mohon Maaf Stok Anda Sisa {0}")
			}
		},
		errorElement: "span",
		errorPlacement: function (error, element) {
			error.addClass("invalid-feedback");
			element.closest(".form-group").append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass("is-invalid");
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass("is-invalid");
		},
		submitHandler: function () {
			$("#loading").show();
			$("#tambahpenjualan").attr("disabled", "disabled");
			var kode_barang = $("#txtkode_barang").val();
			var nm_brg = $("#nm_brg").val();
			var hrg_jual = $("#hrg_jual").val();
			var jumlah = $("#txtjumlah").val();
			var satuan = $("#satuan").val();
			var kategori = $("#kategori").val();
			var kode_produksi = $("#kode_produksi").val();

			var nofaktur = $("#no_faktur").val();
			var kode_pelanggan = $("#kode_pelanggan").val();
			var kode_pelanggan1 = $("#kode_pelanggan1").val();
			var txtmekanik = $("#txtmekanik").val();
			var txtmekanik1 = $("#txtmekanik1").val();
			var no_polisi = $("#no_polisi").val();
			var qtymax = parseInt($("#txtqty").val());
			
			var qty1 = parseInt($("#txtqty1").val());
			var qty2 = parseInt($("#txtqty2").val());
			var pot1 = parseInt($("#txtpot1").val());
			var pot2 = parseInt($("#txtpot2").val());

			var txtidjasa = $('#txtidjasa').val();

			var link = $("#tambahpenjualan").data("link");

			$.ajax({
				url: link,
				method: "POST",
				data: {
					txtidjasa:txtidjasa,
					kode_barang: kode_barang,
					nm_brg: nm_brg,
					hrg_jual: hrg_jual,
					jumlah: jumlah,
					satuan: satuan,
					kategori: kategori,
					kode_produksi: kode_produksi,
					kode_pelanggan: kode_pelanggan,
					kode_pelanggan1: kode_pelanggan1,
					txtmekanik: txtmekanik,
					txtmekanik1: txtmekanik1,
					no_polisi: no_polisi,
					nofaktur: nofaktur,
					qty1:qty1,
					qty2:qty2,
					pot1:pot1,
					pot2:pot2,
				},
				// dataType: "json",
				success: function (data) {
					table.ajax.reload(function (json) {
						json.response;
					  });
					$("#datatambah").html(data);
					$("#txtkode_barang").val("");
					$("#nm_brg").val("");
					$("#hrg_jual").val("");
					$("#txtjumlah").val("");
					$("#satuan").val("");
					$("#kategori").val("");
					$("#kode_produksi").val("");
					$("#no_faktur").val("");
					$("#txtqty1").val("");
					$("#txtqty2").val("");
					$("#txtpot1").val("");
					$("#txtpot2").val("");
					$("#txtidjasa").val("");

					$("#tambahpenjualan").attr("disabled", true);
					$("#hrg_jual").attr("disabled", true);
					$("#txtjumlah").attr("disabled", true);
					$("#loading").hide();
					$(".hidde").hide();
					$(".subtotal").load(base_url + 'Transaksi/Penjualan/subtotal');
					$('.kodejasa').hide();
					$('.kodebrghide').show();
					kunci();
					penjualanedt();
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 2000
					});
					toastr.success("Items Berhasil Di Tambah");
				}
			});

		}
	});
});

$(document).on('click', '.hapuscart', function () {
	var id = $(this).data("id"); //mengambil row_id dari artibut id
	var kdprd = $(this).data("prds");
	Swal.fire({
		title: 'Apakah Yakin?',
		text: "Menghapus Data Ini?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Hapus',
		cancelButtonText: 'Batal'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url: base_url + 'Transaksi/Penjualan/hapuscart',
				method: 'POST',
				data: {
					id: id,
					kdprd: kdprd
				},
				success: function (data) {
					window.location.reload(true)
					const Toast = Swal.mixin({
						toast: true,
						position: 'top-end',
						showConfirmButton: false,
						timer: 3000
					});
					toastr.success('Data Cart Berhahsil Di Hapus');
					$('#datatambah').html(data);
				}
			});
		}
	});
});

$("#simpan_pel").click(function () {
	$("#pelangganvalid").validate({
		rules: {
			nma_pelanggan: {
				required: true
			},
			alamat_pel: {
				required: true
			},
			no_tlp: {
				required: true,
				number: true,
				maxlength: 14,
				minlength: 9
			}
		},
		messages: {
			nma_pelanggan: {
				required: "Mohon Masukan Nama Pelanggan"
			},
			alamat_pel: {
				required: "Mohon Masukan Alamat"
			},
			no_tlp: {
				required: "Mohon Masukan Telepon",
				number: "Mohon Maaf Nomor Telepon Hanya Berisi Angka",
				maxlength: "Maksimal Nomer Yang Di Masukan 14 Karakter",
				minlength: "Minimal Nomer Yang Di Masukan 9 Karakter"
			}
		},
		errorElement: "span",
		errorPlacement: function (error, element) {
			error.addClass("invalid-feedback");
			element.closest(".form-group").append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass("is-invalid");
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass("is-invalid");
		},
		submitHandler: function (form) {
			var nma_pelanggan = $("#nma_pelanggan").val();
			var alamat_pel = $("#alamat_pel").val();
			var no_tlp = $("#no_tlp").val();
			$.ajax({
				type: "POST",
				url: base_url + "Transaksi/Penjualan/insertPelanggan",
				data: {
					nma_pelanggan: nma_pelanggan,
					alamat_pel: alamat_pel,
					no_tlp: no_tlp
				},
				success: function (data) {
					$("#nma_pelanggan").val("");
					$("#alamat_pel").val("");
					$("#no_tlp").val("");
					// $("#kode_pelanggan").modal("hide");
					$("#pelanggan").modal('hide');
					selectpelanggan();
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000
					});
					toastr.success("Data Berhasil Di Simpan");
				}
			});
		}
	});
});

$('#btlpelanggan').on('click', function () {
	$('#kode_pelanggan').val('PEL0001')
		.trigger("change");
});
pelanggan();

function pelanggan() {
	$('#kode_pelanggan').val('PEL0001')
		.trigger("change");
}

$('#vstandart').on('click', function () {
	$('#v-standart').modal('show');
	$('#standartv-title').text('Standart Ban');
	pageVstandart();
	$(document).on('keyup', "#cari_key1", function () { //mencari nama Barang Dari Text Pencarian
		pageVstandart(page_url = false);
		return false;
	});

	$(document).on('click', ".pagination li a", function () {
		var page_url = $(this).attr('href');
		pageVstandart(page_url);
		return false;
	});

	function pageVstandart(page_url) {
		$('.bg-load').show();
		$('#loading').show();
		var cari = $('#cari_key1').val();
		var link = base_url + 'Master/Standart/vstandart/';

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
				$('.vstandartBan').html(response);
			}
		});
	}
});



vjasa(page_url = false); // mereload Page View

$(document).on('click', '.vjasa', function () {
	$('#v-jasa').modal('show')
	$('#jasa-title').html('Data List Jasa');
	var link = $(this).attr('data-link');
	$.ajax({
		type: "POST",
		url: link,
		dataType: "JSON",
		success: function (data) {
			$('.list-tables').html(data.table);
			$('.pagelinks').html(data.pagelinks);
		}
	});
});

$(document).on('keyup', "#vjasac", function () { //mencari nama Barang Dari Text Pencarian
	vjasa(page_url = false);
	return false;
});

$(document).on('click', ".pagination li a", function () {
	var page_url = $(this).attr('href');
	vjasa(page_url);
	return false;
});

function vjasa(page_url) {
	$('.bg-load').show();
	$('#loading').show();
	var cari = $('#vjasac').val();
	var link = base_url + 'Master/Jasa/listjasa/';
	if (page_url) {
		link = page_url;
	}
	$.ajax({
		type: "POST",
		url: link,
		data: {
			cari: cari
		},
		dataType: "JSON",
		success: function (output) {
			$('.bg-load').hide();
			$('#loading').hide();
			$('.list-tables').html(output.table);
			$('.pagelinks').html(output.pagelinks);
		}
	});
}

$(document).on('click', '.jasapilih', function () {
	var id = $(this).attr('data-id')
	var jasa = $(this).attr('data-jasa')
	var harga = $(this).attr('data-harga')
	var qtypot = $(this).data('qty');
	var pot = $(this).data('pot');
	var qty2 = $(this).data('qty2');
	var pot2 = $(this).data('pot2');
	
	var nofaktur = $("#no_faktur").val();
	var kode_pelanggan = $("#kode_pelanggan").val();
	var txtmekanik = $("#txtmekanik").val();
	var no_polisi = $("#no_polisi").val();

	$('#txtidjasa').val(id);
	$('#nm_brg').val(jasa);
	$('#hrg_jual').val(harga);
	$("#tambahpenjualan").attr("disabled", false);
	$("#v-jasa").modal('hide');
	$('#txtjumlah').val('1');
	$('#txtjumlah').attr('disabled', false);
	$('#txtqty').val('99999999999999999999999999999999999999999999');
	$('.kodejasa').show();
	$('.kodebrghide').hide();
	$('#txtqty1').val(qtypot);
	$('#txtpot1').val(pot);
	$('#txtqty2').val(qty2);
	$('#txtpot2').val(pot2);
})

pagependding(page_url = false); // mereload Page View

$(document).on('keyup', "#cari_key", function () { //mencari nama Barang Dari Text Pencarian
	pagependding(page_url = false);
	return false;
});

$(document).on('click', ".pagination li a", function () {
	var page_url = $(this).attr('href');
	pagependding(page_url);
	return false;
});

function pagependding(page_url) {
	$('.bg-load').show();
	$('#loading').show();
	var cari = $('#cari_key').val();
	var link = $('.tabelview').attr('data-link');
	if (page_url) {
		link = page_url;
	}

	$.ajax({
		type: "POST",
		url: link,
		data: {
			cari: cari
		},
		dataType: "JSON",
		success: function (output) {

			$('.bg-load').hide();
			$('#loading').hide();
			$('.tabelview').html(output.table);
			$('.pagelink').html(output.pagelinks);
		}
	});
}
$(".tabelview").on("click", ".hpsjual", function () {
	var no_nota = $(this).data("no_nota");
	var link = $(this).data("link");

	Swal.fire({
		title: "Apakah Yakin?",
		text: "Menghapus Data Ini?",
		type: "warning",
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal"
	}).then(result => {
		if (result.value) {
			$.ajax({
				type: "POST",
				url: link,
				data: {
					no_nota: no_nota
				},
				success: function (data) {
					pagependding(page_url = false);
					$(function () {
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000
						});
						toastr.success("Data Berhasil Di Hapus");
					});
				}
			});
		}
	});
});
$(document).on("click", ".aksestolak", function () {
	var ket = $(this).data("ket");
	var title = $(this).data("title");
	Swal.fire({
		title: title,
		text: ket,
		type: "error",
		showCancelButton: false,
		allowOutsideClick: false,
		confirmButtonColor: "#3085d6",
		confirmButtonText: "Ok"
	}).then(result => {});
});

penjualanedt();

function penjualanedt() {
	var link = $(".tabelv").data("link");
	$.ajax({
		type: "GET",
		url: link,
		dataType: "JSON",
		success: function (output) {
			$(".tabelv").html(output.tabel);
		}
	});
}

$(document).on("click", ".hpsedt", function () {
	var link = $(this).data("link");
	var id = $(this).data("id");
	var kdbrg = $(this).data("kdbrg");
	var kdprd = $(this).data("kdprd");
	var id_jasa = $(this).data("id_jasa");
	var no_nota = $(this).data("no_nota");
	Swal.fire({
		title: "Apakah Yakin?",
		text: "Menghapus Data Ini?",
		type: "warning",
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal"
	}).then(result => {
		if (result.value) {
			$.ajax({
				type: "POST",
				url: link,
				data: {
					id: id,
					kdbrg: kdbrg,
					kdprd: kdprd,
					id_jasa: id_jasa,
					no_nota: no_nota
				},
				dataType: "JSON",
				success: function (data) {
					penjualanedt();
					pagependding(page_url = false);
					window.location.href = window.location.href;
					$(function () {
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000
						});
						toastr.success("Data Berhasil Di Hapus");
					});
				}
			});
		}
	});
})
