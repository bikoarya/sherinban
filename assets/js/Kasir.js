$("#cariKasir").load(base_url + "Transaksi/Kasir/cariVKasir");
$("#cariJasa").load(base_url + "Master/Jasa/cariVJasa");
$("#cartKasir").load(base_url + "Transaksi/Kasir/viewP");
$("#total_pembayaran").load(base_url + "Transaksi/Kasir/total");
$("#ttlbyr").load(base_url + "Transaksi/Kasir/hidetotal");
$("#byrr").attr("disabled", "disabled");
$("#byrr1").attr("disabled", "disabled");
$("#hitungjs").attr("disabled", "disabled");

$("#tanggal").attr("disabled", "disabled");
$("#nama_pelanggan").attr("disabled", "disabled");
$("#nama_mekanik").attr("disabled", "disabled");

lock();

function lock() {
	$.ajax({
		url: base_url + "Transaksi/Kasir/lock",
		type: "POST",
		dataType: "JSON",
		success: function (response) {
			if (response.code == 200) {
				$(".cripnjualan").attr("disabled", true);
			} else {
				$(".cripnjualan").attr("disabled", false);
			}
		},
	});
}

$("#hitungjs").on("click", function () {
	var hitung = $("#total_tunai1").val();
	var ttl = $("#total_pembayaranjs").val();
	var hsl = $("#kembalian1").val();

	kmbl = hitung - ttl;
	$("#kembalian1").val(kmbl);
	if (kmbl > -1) {
		$("#byrr1").attr("disabled", false);
	} else {
	}
});

$("#cariJasa").on("click", ".carijs", function () {
	var no_nota = $(this).data("nonota");
	var tanggal = $(this).data("tgl");
	var Jasa = $(this).data("jasa");
	var Harga_jasa = $(this).data("harga_jasa");

	$(".jasamode").attr("disabled", true);
	$("#hitungjs").attr("disabled", false);
	$(".cripnjualan").attr("disabled", true);
	$("#tanggal").attr("disabled", false);
	$("#nama_pelanggan").attr("disabled", false);
	$("#nama_mekanik").attr("disabled", false);
	$("#cariJasa1").modal("hide");
	$("#no_nota1").val(no_nota);
	$("#tanggal1").val(tanggal);
	$("#Jasa").val(Jasa);
	$("#Harga_jasa").val(Harga_jasa);
	$("#total_pembayaranjs").val(Harga_jasa);
	$("#totaltunai1").val(Harga_jasa);
	$("#ttlbyr1").val(Harga_jasa);
	const Toast = Swal.mixin({
		toast: true,
		position: "top-end",
		showConfirmButton: false,
		timer: 3000,
	});
	toastr.success("Data Berhasil Di Akses");
});

$("#cariKasir").on("click", ".cariksr", function () {
	var no_nota = $(this).data("no_nota");
	var tanggal = $(this).data("tanggal");
	var nama_pelanggan = $(this).data("nama_pelanggan");
	var nama_mekanik = $(this).data("nama_mekanik");
	var kode_pelanggan = $(this).data("kode_pelanggan");

	$("#tanggal").attr("disabled", false);
	$("#nama_pelanggan").attr("disabled", false);
	$("#nama_mekanik").attr("disabled", false);
	$("#cariPenjualan").modal("hide");
	$('#kode_pelanggan').val(kode_pelanggan);
	$(".cripnjualan").attr("disabled", true);
	$(".jasamode").attr("disabled", true);

	$.ajax({
		url: base_url + "Transaksi/Kasir/add_cart",
		method: "POST",
		data: {
			no_nota: no_nota,
			tanggal: tanggal,
			nama_pelanggan: nama_pelanggan,
			nama_mekanik: nama_mekanik,
			kode_pelanggan: kode_pelanggan
		},
		success: function (response) {
			$("#byrr").attr("disabled", false);
			$("#cartKasir").load(base_url + "Transaksi/Kasir/viewP");
			$("#total_pembayaran").load(base_url + "Transaksi/Kasir/total");
			$("#ttlbyr").load(base_url + "Transaksi/Kasir/hidetotal");
			$("#no_nota").val(no_nota);
			$("#tanggal").val(tanggal);
			$("#nama_pelanggan").val(nama_pelanggan);
			$("#nama_mekanik").val(nama_mekanik);
			$(".cripnjualan").attr("disabled", true);
			const Toast = Swal.mixin({
				toast: true,
				position: "top-end",
				showConfirmButton: false,
				timer: 3000,
			});
			toastr.success("Data Berhasil Di Akses");
		},
	});
});

$("#byrr1").on("click", function () {
	var no_nota = $("#no_nota1").val();
	var tanggal = $("#tanggal1").val();
	var Jasa = $("#Jasa").val();
	var Hjasa = $("#Harga_jasa").val();
	var total_tunai = $("#total_tunai1").val();
	var kembalian = $("#kembalian1").val();
	var hslbyr = $("#total_pembayaranjs").val();
	

	$.ajax({
		url: base_url + "Transaksi/Kasir/printer",
		method: "POST",
		dataType: "JSON",
		success: function (con) {
			var printer = new Recta(con.api[0][0], con.api[0][1]);
			printer
				.open()
				.then(() => {
					$.ajax({
						url: base_url + "Transaksi/Kasir/simkasirjasa",
						method: "POST",
						data: {
							no_nota: no_nota,
							tanggal: tanggal,
							Jasa: Jasa,
							Hjasa: Hjasa,
							total_tunai: total_tunai,
							kembalian: kembalian,
							hslbyr: hslbyr,
						},
						dataType: "JSON",
						success: function (response) {
							var tt = response.hslbyr;
							var tn = response.total_tunai;
							var km = response.kembalian;
							var tgl = response.tanggal;

							if (tt.length == 10) {
								var total = "          " + tt;
							} else if (tt.length == 9) {
								var total = "           " + tt;
							} else if (tt.length == 8) {
								var total = "            " + tt;
							} else if (tt.length == 7) {
								var total = "             " + tt;
							} else if (tt.length == 6) {
								var total = "              " + tt;
							} else if (tt.length == 5) {
								var total = "               " + tt;
							}

							if (tn.length == 10) {
								var tunai = "          " + tn;
							} else if (tn.length == 9) {
								var tunai = "           " + tn;
							} else if (tn.length == 8) {
								var tunai = "            " + tn;
							} else if (tn.length == 7) {
								var tunai = "             " + tn;
							} else if (tn.length == 6) {
								var tunai = "              " + tn;
							} else if (tn.length == 5) {
								var tunai = "               " + tn;
							}

							if (km.length == 10) {
								var kembali = "          " + km;
							} else if (km.length == 9) {
								var kembali = "           " + km;
							} else if (km.length == 8) {
								var kembali = "            " + km;
							} else if (km.length == 7) {
								var kembali = "             " + km;
							} else if (km.length == 6) {
								var kembali = "              " + km;
							} else if (km.length == 5) {
								var kembali = "               " + km;
							} else if (km.length == 4) {
								var kembali = "                " + km;
							} else if (km.length == 3) {
								var kembali = "                 " + km;
							} else if (km.length == 2) {
								var kembali = "                  " + km;
							} else if (km.length == 1) {
								var kembali = "                   " + km;
							}

							var Jasa = response.Jasa;
							printer
								.align("center")
								.text(response.tnota[0][0])
								.text(response.tnota[0][1])
								.text(response.tnota[0][2])
								.bold(true)
								.underline(false);
							printer
								.align("left")
								.bold(false)
								.text("================================")
								.text("Tanggal   : " + tgl)
								.text("No Nota   : " + no_nota)
								.text("Jasa : " + Jasa)
								.text("--------------------------------");

							var harga = response.hslbyr;

							if (harga.length == 10) {
								var hrg = "            " + harga;
							} else if (harga.length == 9) {
								var hrg = "             " + harga;
							} else if (harga.length == 8) {
								var hrg = "              " + harga;
							} else if (harga.length == 7) {
								var hrg = "               " + harga;
							} else if (harga.length == 6) {
								var hrg = "                " + harga;
							} else if (harga.length == 5) {
								var hrg = "                 " + harga;
							}
							printer.align("left").text(Jasa + hrg);

							printer
								.align("left")
								.text("--------------------------------")
								.text("Total     : " + total)
								.text("Tunai     : " + tunai)
								.text("Kembalian : " + kembali)
								.text("--------------------------------");
							printer.align("center").text("**** TERIMA KASIH ****").print();
							window.location.href = base_url + "Transaksi/Kasir";
						},
					});
				})
				.catch((e) => {
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
					toastr.error("Printer Tidak Terhubung");
				});
		},
	});
});

$("#byrr").on("click", function () {
	var no_nota = $("#no_nota").val();
	var tanggal = $("#tanggal").val();
	var nama_pelanggan = $("#nama_pelanggan").val();
	var total_tunai = $("#total_tunai").val();
	var kembalian = $("#kembalian").val();
	var hslbyr = $("#hslbyr").val();
	var kode_pelanggan = $("#kode_pelanggan").val(); 
	$("#byrr").attr("disabled", "disabled");
					$.ajax({
						url: base_url + "Transaksi/Kasir/simkasir",
						method: "POST",
						data: {
							no_nota: no_nota,
							tanggal: tanggal,
							nama_pelanggan: nama_pelanggan,
							total_tunai: total_tunai,
							kembalian: kembalian,
							hslbyr: hslbyr,
							kode_pelanggan:kode_pelanggan
						},
						dataType: "JSON",
						success: function (response) {
							window.location.href = base_url + "Transaksi/Kasir/notacetakulg/" + no_nota;
							
						},
					});
});

$(document).on('submit','.form-cari',function(event) {
	event.preventDefault();
	table.ajax.reload(function (json) {
		json.response;
	});
})

function wordWrap(str, maxWidth) {
	var newLineStr = "\n";
	done = false;
	res = "";
	while (str.length > maxWidth) {
		found = false;
		// Inserts new line at first whitespace of the line
		for (i = maxWidth - 1; i >= 0; i--) {
			if (testWhite(str.charAt(i))) {
				res = res + [str.slice(0, i), newLineStr].join("");
				str = str.slice(i + 1);
				found = true;
				break;
			}
		}
		// Inserts new line at maxWidth position, the word is too long to wrap
		if (!found) {
			res += [str.slice(0, maxWidth), newLineStr].join("");
			str = str.slice(maxWidth);
		}
	}

	return res + str;
}

function testWhite(x) {
	var white = new RegExp(/^\s$/);
	return white.test(x.charAt(0));
}

$(document).on("click", ".cetakulang", function () {
	const link = $(this).data("link");
	const nonota = $(this).data("nonota");
	window.location.href=link+nonota;
});

$("#total_tunai").on("input", function () {
	var hslbyr = $("#hslbyr").val();
	var total_tunai = $("#total_tunai").val();
	var hsl = total_tunai.replace(/[^\d]/g, "");

	var kmbli = hsl - hslbyr;
	$("#kembalian2").val(kmbli);
	$("#kembalian").val(kmbli);
	if (kmbli <= -1) {
		$("#byrr").attr("disabled", "disabled");
	} else {
		$("#byrr").attr("disabled", false);
	}
	$("#total_tunai").priceFormat({
		prefix: "",
		centsLimit: 0,
		thousandsSeparator: ".",
	});
	$("#kembalian").priceFormat({
		prefix: "",
		centsLimit: 0,
		thousandsSeparator: ".",
	});
});

$(document).on("click", "#beliJasa", function () {
	$(".hidde").show();
	$(".real").hide();
});


$(document).ready(function () {
	setInterval(function(){ 
		notifikasi();
	}, 3000);
	function notifikasi()
	{
		var notif = '<i class="fas fa-envelope mr-2"></i> 0 Pesan Baru';
		var countnotif = '0';
		$('.notif').html(notif);
		$('.countnotif').html(countnotif);
		$.ajax({
			url:base_url+'Transaksi/kasir/notif_service',
			method: "GET",
			dataType: 'JSON',
			success: function(data) {
				if (data.bacanotif == '0') {	
					if (data.pesanshownotif != '0') {
						$('.notif').html(data.notif);
						$('.countnotif').html(data.countnotif);
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.success("Service Pengecekan");
					}
				}
			}
		})
	}
	
})