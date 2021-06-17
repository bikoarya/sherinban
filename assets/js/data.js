var linktable = $('.datatable2').attr("data-link");
var linktablelap = $('.laporantable').attr("data-link");
var laporantable;
var tablee;

function addCommas(nStr)
	{
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + '.' + '$2');
		}
		return x1 + x2;
	}

$(document).ready(function() {

	table = $(".datatable2").DataTable({
		"dom": 'Bfrtip',
        "buttons": [
            'colvis'
		],
		"language": {
			"search": "Pencarian:",
			"lengthMenu": "Tampilkan _MENU_ baris",
			"zeroRecords": "Data tidak ada",
			"info": "Halaman _PAGE_ dari _PAGES_",
			"infoEmpty": "Tidak ada data",
			"infoFiltered": "(pencarian dari _MAX_ data)"
		},
		"responsive": true,
		"stateSave": true,
		"ordering": false,
		"order": [],
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": linktable,
			"type": "POST",
			"data": function ( d ) {
				var tglawal = $('.tglawal').val();
                if(tglawal != '' ){
				  d.tglawal = tglawal;
				}
            }
		},
		"columnDefs": [{
			"targets": [0],
		  "orderable": false,
		}, ]
	});
	var rowtotal = $(".laporantable").data('total');
	var aktif = $(".laporantable").data('aktif');
	laporantable = $(".laporantable").DataTable({
		"dom": 'Bfrtip',
        "buttons": [
            'colvis'
		],
		"language": {
			"search": "Pencarian:",
			"lengthMenu": "Tampilkan _MENU_ baris",
			"zeroRecords": "Data tidak ada",
			"info": "Halaman _PAGE_ dari _PAGES_",
			"infoEmpty": "Tidak ada data",
			"infoFiltered": "(pencarian dari _MAX_ data)"
		},
		"responsive": true,
		"stateSave": true,
		"ordering": false,
		"order": [],
		"searching": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": linktablelap,
			"type": "POST",
			"data": function ( d ) {
				var tgllap = $('.tgllap').val();
				var kategori = $('.kategori').val();
				var pencarian = $('#textpencarian').val();
                if(tgllap != '' && kategori != '' && pencarian != ''){
				  d.tgllap 		= tgllap;
				  d.kategori 	= kategori;
				  d.pencarian 	= pencarian;
				}else if(kategori != '' && pencarian != ''){
					d.kategori 	= kategori;
					d.pencarian 	= pencarian;
				}else if(tgllap != ''){
					d.tgllap 		= tgllap;
				}
			},
			"dataSrc": function ( data ) {
				footer_total = data.footerTotal;
				return data.data;
			  } 
		},
		"columnDefs": [{
			"targets": [0],
		  "orderable": false,
		}, ],
		"drawCallback" : function(settings) {
			var api = this.api();
			$( api.column( rowtotal ).footer() ).html(addCommas(footer_total));
		}
	});

	var linktablee = $('#datatable3').attr("data-link");
	
	tablee = $("#datatable3").DataTable({
		"dom": 'Bfrtip',
        "buttons": [
            'colvis'
        ],
		"processing": true,
		"serverSide": true,
		"order": [],
	
		"ajax": {
			"url": linktablee,
			"type": "POST"
		},
	
		"columnDefs": [{
			"targets": [0],
		  "orderable": false,
		}, ]
	});

	$(document).on('click', '.searchdatatables', function() {
		var title = $("#searchdatatables").data('title');
		$('#searchdatatables').modal('show');
		$('#modal-title2').html(title);
	})
})
	  
// Master Barang
selectdata();

function selectdata() {
	var link = $(".selectdata").data("link");
	$.ajax({
		type: "GET",
		url: link,
		dataType: "json",
		success: function (data) {
			$(".selectdata").html(data.satuan);
			$(".ktgdata").html(data.kategori);
		},
	});
}

selectdataedt();

function selectdataedt() {
	var link = $("#txtid_satuan").data("link");
	$.ajax({
		type: "GET",
		url: link,
		dataType: "json",
		success: function (data) {
			$("#txtid_satuan").html(data.satuan);
			$("#txtid_kategori").html(data.kategori);
		},
	});
}

supplierselect();

function supplierselect() {
	var link = $(".supplierselect").data("link");
	$.ajax({
		type: "GET",
		url: link,
		dataType: "json",
		success: function (data) {
			$(".supplierselect").html(data);
		},
	});
}

selectpelanggan();

function selectpelanggan() {
	var link = $(".selectpelanggan").data("link");
	$.ajax({
		type: "GET",
		url: link,
		dataType: "json",
		success: function (data) {
			$(".selectpelanggan").html(data);
		},
	});
}

$("#btn-simpan").click(function () {
	$("#quickForm").validate({
		rules: {
			nama_barang: {
				required: true,
			},
			id_satuan: {
				required: true,
			},
			id_kategori: {
				required: true,
			},
			spek: {
				required: true,
			},
			harga_jual: {
				required: true,
			},
			harga_beli: {
				required: true,
			},
			stok_min: {
				required: true,
			},
			aktif: {
				required: true,
			},
			qty1: {
				number: true
			},
			pot1: {
				number: true
			},
			qty2: {
				number: true
			},
			pot2: {
				number: true
			},
		},
		messages: {
			// kode_barang: {
			// 	required: "Masukan Kode Barang"
			// },
			nama_barang: {
				required: "Nama Barang Tidak Boleh Kosong",
			},
			id_satuan: {
				required: "Mohon Pilih Satuan Barang",
			},
			id_kategori: {
				required: "Mohon Pilih Kategori Barang",
			},
			spek: {
				required: "Spesifikasi Barang Tidak Boleh Kosong",
			},
			harga_jual: {
				required: "Harga Jual Barang Tidak Boleh Kosong",
			},
			harga_beli: {
				required: "Harga Beli Barang Tidak Boleh Kosong",
			},
			stok_min: {
				required: "Stok Minimum Barang Tidak Boleh Kosong",
			},
			aktif: {
				required: "Mohon Pilih Aktif Barang",
			},
			qty1: {
				number: "Qty 1 Harus angka",
			},
			pot1: {
				number: "Pot 1 Harus angka",
			},
			qty2: {
				number: "Qty 2 Harus angka",
			},
			pot2: {
				number: "Pot 2 Harus angka",
			},
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
			Swal.fire({
				title: "Simpan Data",
				text: "Apakah Data Yang Anda Input Sudah Benar?",
				type: "question",
				showCancelButton: true,
				allowOutsideClick: false,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Ya",
				cancelButtonText: "Tidak",
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "POST",
						url: base_url + "Master/Barang/insert",
						data: $("#form-modal form").serialize(),
						success: function (data) {
							$(".tmpilbarang").html(data);
							$("#nama_barang").val("");
							$("#spek").val("");
							$("#harga_jual").val("");
							$("#harga_beli").val("");
							$("#stok_min").val("");
							$("#aktif").val("Y").trigger("change");
							$("#id_satuan").val("").trigger("change");
							$("#id_kategori").val("").trigger("change");
							$("[name='type_exp']").prop("checked", true);
							const Toast = Swal.mixin({
								toast: true,
								position: "top-end",
								showConfirmButton: false,
								timer: 3000,
							});
							toastr.success("Data Berhasil Di Simpan");
							$("#btn-simpan").attr("disabled", true);
							Swal.fire({
								title: "Input Data",
								text: "Apakah Anda Ingin Menginputkan Data Barang Lagi?",
								type: "question",
								showCancelButton: true,
								allowOutsideClick: false,
								confirmButtonColor: "#3085d6",
								cancelButtonColor: "#d33",
								confirmButtonText: "Ya",
								cancelButtonText: "Tidak",
							}).then((result) => {
								if (result.value) {
									$("#form-modal").modal("show");
									$("#btn-simpan").attr("disabled", false);
								} else {
									$("#form-modal").modal("hide");
									$("#btn-simpan").attr("disabled", false);
								}
							});
						},
					});
				}
			});
		},
	});
});

$("#editbarang").click(function () {
	$("#qeditbarang").validate({
		rules: {
			nama_barang: {
				required: true,
			},
			id_satuan: {
				required: true,
			},
			id_kategori: {
				required: true,
			},
			spek: {
				required: true,
			},
			harga_jual: {
				required: true,
			},
			harga_beli: {
				required: true,
			},
			stok_min: {
				required: true,
			},
			aktif: {
				required: true,
			},
			qty1: {
				number: "Qty 1 Harus angka",
			},
			pot1: {
				number: "Pot 1 Harus angka",
			},
			qty2: {
				number: "Qty 2 Harus angka",
			},
			pot2: {
				number: "Pot 2 Harus angka",
			},
		},
		messages: {
			nama_barang: {
				required: "Nama Barang Tidak Boleh Kosong",
			},
			id_satuan: {
				required: "Mohon Pilih Satuan Barang",
			},
			id_kategori: {
				required: "Mohon Pilih Katagori Barang",
			},
			spek: {
				required: "Spesifikasi Barang Tidak Boleh Kosong",
			},
			harga_jual: {
				required: "Harga Jual Barang Tidak Boleh Kosong",
			},
			harga_beli: {
				required: "Harga Beli Barang Tidak Boleh Kosong",
			},
			stok_min: {
				required: "Stok Minimum Barang Tidak Boleh Kosong",
			},
			aktif: {
				required: "Mohon Pilih Aktif Barang",
			},
			qty1: {
				number: "Qty 1 Harus angka",
			},
			pot1: {
				number: "Pot 1 Harus angka",
			},
			qty2: {
				number: "Qty 2 Harus angka",
			},
			pot2: {
				number: "Pot 2 Harus angka",
			},
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
			Swal.fire({
				title: "Simpan Perubahan",
				text: "Apakah Anda Yakin Ingin Mengubah Data Ini?",
				type: "question",
				showCancelButton: true,
				allowOutsideClick: false,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Ya",
				cancelButtonText: "Tidak",
			}).then((result) => {
				if (result.value) {
					var txtkode_barang = $("#txtkode_barang").val();
					var txtnama_barang = $("#txtnama_barang").val();
					var txtspek = $("#txtspek").val();
					var txtharga_jual = $("#txtharga_jual").val();
					var txtharga_beli = $("#txtharga_beli").val();
					var txtstok_min = $("#txtstok_min").val();
					var txtaktif = $("#txtaktif").val();
					var txtid_satuan = $("#txtid_satuan").val();
					var txtid_kategori = $("#txtid_kategori").val();
					var txtqty1 = $("#txtqty1").val();
					var txtpot1 = $("#txtpot1").val();
					var txtqty2 = $("#txtqty2").val();
					var txtpot2 = $("#txtpot2").val();

					if ($("#ceklis").prop("checked")) {
						var type_exp = "1";
					} else {
						var type_exp = "";
					}

					$.ajax({
						type: "POST",
						url: base_url + "Master/Barang/update",
						data: {
							txtkode_barang: txtkode_barang,
							txtnama_barang: txtnama_barang,
							txtspek: txtspek,
							txtharga_jual: txtharga_jual,
							txtharga_beli: txtharga_beli,
							txtstok_min: txtstok_min,
							txtaktif: txtaktif,
							txtid_satuan: txtid_satuan,
							txtid_kategori: txtid_kategori,
							type_exp: type_exp,
							txtqty1:txtqty1,
							txtpot1:txtpot1,
							txtqty2:txtqty2,
							txtpot2:txtpot2
						},
						success: function (data) {
							$(".tmpilbarang").html(data);
							$("#txtnama_barang").val("");
							$("#txtspek").val("");
							$("#txtharga_jual").val("");
							$("#txtharga_beli").val("");
							$("#txtstok_min").val("");
							$("#txtaktif").val("").trigger("change");
							$("#txtid_satuan").val("").trigger("change");
							$("#txtid_kategori").val("").trigger("change");
							$("#form-edit").modal("hide");
							const Toast = Swal.mixin({
								toast: true,
								position: "top-end",
								showConfirmButton: false,
								timer: 3000,
							});
							toastr.success("Data Berhasil Di Ubah");
						},
					});
				}
			});
		},
	});
});

$("#btn-tambah").click(function () {
	$("#harga_jual").attr("disabled", false);
	$("#harga_beli").attr("disabled", false);
	// $('#kode_barang').val('');
	$("#nama_barang").val("");
	$("#spek").val("");
	$("#harga_jual").val("");
	$("#harga_beli").val("");
	$("#stok_min").val("");
	$("[name='type_exp']").prop("checked", true);
	$("#aktif").val("Y").trigger("change");
	$("#id_satuan").val("").trigger("change");
	$("#id_kategori").val("").trigger("change");
	$("#modal-title").html("Tambah Data Barang");
});

// ubah akun
// $(".viewakun").on('click', '.ubahakun', function () {
// 	var nama_lengkap = $(this).data('nama_lengkap');
// 	var username = $(this).data('username');
// 	var password = $(this).data('password');
// 	var level = $(this).data('level');
// 	console.log('tampil');

// 	$('#formEdit').modal('show');
// 	$("#judulEdit").html("Ubah Data Akun");

// 	$("#nm_lengkap").val(nama_lengkap);
// 	$("#usrnm").val(username);
// 	$("#level2").val(level).trigger("change");
// })
// end ubah akun

$(".tmpilbarang").on("click", ".ubahbarang", function () {
	var kode_barang = $(this).data("kode_barang");
	var nama_barang = $(this).data("nama_barang");
	var spek = $(this).data("spek");
	var harga_jual = $(this).data("harga_jual");
	var harga_beli = $(this).data("harga_beli");
	var stok_min = $(this).data("stok_min");
	var aktif = $(this).data("aktif");
	var id_satuan = $(this).data("id_satuan");
	var id_kategori = $(this).data("id_kategori");
	var type_exp = $(this).data("typeexp");

	var qty1 = $(this).data("qty1");
	var qty2 = $(this).data("qty2");
	var pot1 = $(this).data("pot1");
	var pot2 = $(this).data("pot2");

	$("#form-edit").modal("show");
	$("#edit-title").html("Ubah Data Barang");
	$("#txtkode_barang").val(kode_barang);
	$("#txtnama_barang").val(nama_barang);
	$("#txtspek").val(spek);
	$("#txtharga_jual").val(harga_jual);
	$("#txtharga_beli").val(harga_beli);
	$("#txtstok_min").val(stok_min);
	$("#txtaktif").val(aktif).trigger("change");
	$("#txtid_satuan").val(id_satuan).trigger("change");
	$("#txtid_kategori").val(id_kategori).trigger("change");
	
	$("#txtqty1").val(qty1);
	$("#txtqty2").val(qty2);
	$("#txtpot1").val(pot1);
	$("#txtpot2").val(pot2);
	if (type_exp == "1") {
		$("#ceklis").prop("checked", true);
		$("#ceklis").val("");
	} else {
		$("#ceklis").prop("checked", false);
	}

	$("#txtnama_barang").attr("disabled", false);
});

//
$(document).on("click", ".terpkai", function () {
	var kode_barang = $(this).data("kode_barang");
	Swal.fire({
		title: "Data Terpakai",
		text: "Data Terpakai!!!!!!",
		type: "error",
		showCancelButton: false,
		allowOutsideClick: false,
		confirmButtonColor: "#3085d6",
		confirmButtonText: "Ok",
	}).then((result) => {});
});

// hpussbarang
$(".tmpilbarang").on("click", ".hapusbarang", function () {
	var kode_barang = $(this).data("kode_barang");
	Swal.fire({
		title: "Apakah Yakin?",
		text: "Menghapus Data Ini?",
		type: "warning",
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type: "POST",
				url: base_url + "Master/Barang/hapusbarang",
				data: {
					kode_barang: kode_barang,
				},
				success: function (data) {
					$(".tmpilbarang").html(data);
					$(function () {
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.success("Data Berhasil Di Hapus");
					});
				},
			});
		}
	});
});
// endMasterBarang

// start master satuan

$("#simpansatuan").click(function () {
	$("#qsatuantambah").validate({
		rules: {
			nama_satuan: {
				required: true,
			},
		},
		messages: {
			nama_satuan: {
				required: "Nama Satuan Tidak Boleh Kosong",
			},
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
			var nama_satuan = $("#nama_satuan").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Satuan/insert",
				data: {
					nama_satuan: nama_satuan,
				},
				dataType: "json",
				success: function (response) {
					if (response.code == "200") {
						$("#form-satuan").modal("hide");
						$("#nama_satuan").val("");
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.success("Data Berhasil Di Simpan");
					} else {
						$(".errors").html(response.val);
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.error("Data Sudah Ada");
					}
					$(".tmplSatuan").load(base_url + "Master/Satuan/viewSatuan");
				},
			});
		},
	});
});
$("#satuan-tambah").click(function () {
	$("#nama_satuan").val("");
	$("#simpansatuan").show();
	$("#satuan-title").html("Tambah Data Satuan");
});

$(document).on("click", ".hapussatuan", function () {
	var id_satuan = $(this).data("id_satuan");
	Swal.fire({
		title: "Apakah Yakin?",
		text: "Menghapus Data Ini?",
		type: "warning",
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type: "POST",
				url: base_url + "Master/Satuan/hapussatuan",
				data: {
					id_satuan: id_satuan,
				},
				success: function (data) {
					$(".tmplSatuan").html(data);
					$(function () {
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.success("Data Berhasil Di Hapus");
					});
				},
			});
		}
	});
});

$(document).on("click", ".ubahsatuan", function () {
	var id_satuan = $(this).data("id_satuan");
	var nama_satuan = $(this).data("nama_satuan");

	$("#form-satuanedit").modal("show");
	$("#edtid_satuan").val(id_satuan);
	$("#edtnama_satuan").val(nama_satuan);
});

$("#ubahsatauan").click(function () {
	$("#qsatuanedit").validate({
		rules: {
			edtnama_satuan: {
				required: true,
			},
		},
		messages: {
			edtnama_satuan: {
				required: "Nama Satuan Tidak Boleh Kosong",
			},
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
			var edtnama_satuan = $("#edtnama_satuan").val();
			var edtid_satuan = $("#edtid_satuan").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Satuan/update",
				data: {
					edtnama_satuan: edtnama_satuan,
					edtid_satuan: edtid_satuan,
				},
				success: function (data) {
					$(".tmplSatuan").html(data);
					$("#edtnama_satuan").val("");
					$("#form-satuanedit").modal("hide");
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
					toastr.success("Data Berhasil Di Ubah");
				},
			});
		},
	});
});

// end satuan

// start kategori

$("#simpankatagori").click(function () {
	$("#qkatagoritambah").validate({
		rules: {
			nama_katagori: {
				required: true,
			},
		},
		messages: {
			nama_katagori: {
				required: "Nama Katagori Tidak Boleh Kosong",
			},
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
			var nama_katagori = $("#nama_katagori").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Kategori/insert",
				data: {
					nama_katagori: nama_katagori,
				},
				dataType: "json",
				success: function (response) {
					if (response.code == "200") {
						$("#form-katagori").modal("hide");
						$("#nama_katagori").val("");
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.success("Data Berhasil Di Simpan");
					} else {
						$(".errors").html(response.val);
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.error("Data Sudah Ada");
					}
					$(".tmpkategori").load(base_url + "Master/Kategori/viewKatagori");
				},
			});
		},
	});
});

$("#katagori-tambah").click(function () {
	$("#nama_katagori").val("");
	$("#simpankatagori").show();
	$("#katagori-title").html("Tambah Data Kategori");
});

$(document).on("click", ".hapuskatagori", function () {
	var id_katagori = $(this).data("id_katagori");
	Swal.fire({
		title: "Apakah Yakin?",
		text: "Menghapus Data Ini?",
		type: "warning",
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type: "POST",
				url: base_url + "Master/Kategori/hapus",
				data: {
					id_katagori: id_katagori,
				},
				success: function (data) {
					$(".tmpkategori").html(data);
					$(function () {
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.success("Data Berhasil Di Hapus");
					});
				},
			});
		}
	});
});

$(document).on("click", ".ubahkatagorii", function () {
	var id_katagori = $(this).data("id_katagori");
	var nama_katagori = $(this).data("nama_katagori");

	$("#form-katagoriedit").modal("show");
	$("#edtid_katagori").val(id_katagori);
	$("#edtnama_katagori").val(nama_katagori);
});

$("#ubahkatagori").click(function () {
	$("#qkatagoriedit").validate({
		rules: {
			edtnama_katagori: {
				required: true,
			},
		},
		messages: {
			edtnama_katagori: {
				required: "Nama Katagori Tidak Boleh Kosong",
			},
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
			var edtnama_katagori = $("#edtnama_katagori").val();
			var edtid_katagori = $("#edtid_katagori").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Kategori/update",
				data: {
					edtnama_katagori: edtnama_katagori,
					edtid_katagori: edtid_katagori,
				},
				success: function (data) {
					$(".tmpkategori").html(data);
					$("#edtid_katagori").val("");
					$("#form-katagoriedit").modal("hide");
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
					toastr.success("Data Berhasil Di Ubah");
				},
			});
		},
	});
});
// end katagori

// start supplier

$("#simpansupplier").click(function () {
	$("#qsuppliertambah").validate({
		rules: {
			nama_supplier: {
				required: true,
			},
			alamat_sup: {
				required: true,
			},
			telpon_sup: {
				required: true,
				number: true,
				maxlength: 14,
				minlength: 9,
			},
		},
		messages: {
			nama_supplier: {
				required: "Nama Supplier Tidak Boleh Kosong",
			},
			alamat_sup: {
				required: "Alamat Supplier Tidak Boleh Kosong",
			},
			telpon_sup: {
				required: "Telepon Tidak Boleh Kosong",
				number: "Mohon Maaf Nomor Telepon Hanya Berisi Angka",
				maxlength: "Maksimal Nomer Yang Di Masukan 14 Karakter",
				minlength: "Minimal Nomer Yang Di Masukan 9 Karakter",
			},
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
			var nama_supplier = $("#nama_supplier").val();
			var alamat_sup = $("#alamat_sup").val();
			var telpon_sup = $("#telpon_sup").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Supplier/insert",
				data: {
					nama_supplier: nama_supplier,
					alamat_sup: alamat_sup,
					telpon_sup: telpon_sup,
				},
				success: function (data) {
					$(".tmplsupplier").html(data);
					$("#nama_supplier").val("");
					$("#alamat_sup").val("");
					$("#telpon_sup").val("");
					$("#form-supplier").modal("hide");

					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
					toastr.success("Data Berhasil Di Simpan");
				},
			});
		},
	});
});

$("#supplier-tambah").click(function () {
	$("#nama_katagori").val("");
	$("#simpankatagori").show();
	$("#supplier-title").html("Tambah Data Supplier");
});

$(".tmplsupplier").on("click", ".hapussup", function () {
	var kode_supplier = $(this).data("kode_supplier");
	Swal.fire({
		title: "Apakah Yakin?",
		text: "Menghapus Data Ini?",
		type: "warning",
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type: "POST",
				url: base_url + "Master/Supplier/hapus",
				data: {
					kode_supplier: kode_supplier,
				},
				success: function (data) {
					$(".tmplsupplier").html(data);
					$(function () {
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.success("Data Berhasil Di Hapus");
					});
				},
			});
		}
	});
});

$(".tmplsupplier").on("click", ".ubahsup", function () {
	var kode_supplier = $(this).data("kode_supplier");
	var nama_supplier = $(this).data("nama_supplier");
	var alamat_supplier = $(this).data("alamat_supplier");
	var telepon = $(this).data("telepon");

	$("#form-supplieredit").modal("show");
	$("#edtkode_supplier").val(kode_supplier);
	$("#edtnama_supplier").val(nama_supplier);
	$("#edtalamat_supplier").val(alamat_supplier);
	$("#edttlp_supplier").val(telepon);
});

$("#ubahsupplier").click(function () {
	$("#qsupplieredit").validate({
		rules: {
			edtnama_supplier: {
				required: true,
			},
			edtalamat_supplier: {
				required: true,
			},
			edttlp_supplier: {
				required: true,
				number: true,
				maxlength: 14,
				minlength: 9,
			},
		},
		messages: {
			edtnama_supplier: {
				required: "Nama Supplier Tidak Boleh Kosong",
			},
			edtalamat_supplier: {
				required: "Alamat Supplier Tidak Boleh Kosong",
			},
			edttlp_supplier: {
				required: "Telepon Tidak Boleh Kosong",
				number: "Mohon Maaf Nomor Telepon Hanya Berisi Angka",
				maxlength: "Maksimal Nomer Yang Di Masukan 14 Karakter",
				minlength: "Minimal Nomer Yang Di Masukan 9 Karakter",
			},
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
			var edtkode_supplier = $("#edtkode_supplier").val();
			var edtnama_supplier = $("#edtnama_supplier").val();
			var edtalamat_supplier = $("#edtalamat_supplier").val();
			var edttlp_supplier = $("#edttlp_supplier").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Supplier/update",
				data: {
					edtkode_supplier: edtkode_supplier,
					edtnama_supplier: edtnama_supplier,
					edtalamat_supplier: edtalamat_supplier,
					edttlp_supplier: edttlp_supplier,
				},
				success: function (data) {
					$(".tmplsupplier").html(data);
					$("#edtnama_supplier").val("");
					$("#edtalamat_supplier").val("");
					$("#edttlp_supplier").val("");
					$("#form-supplieredit").modal("hide");
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
					toastr.success("Data Berhasil Di Ubah");
				},
			});
		},
	});
});

// end supplier

// start pelanggan

$("#simpanpelanggan").click(function () {
	$("#qpelanggantambah").validate({
		rules: {
			nama_pelanggann: {
				required: true,
			},
			alamat: {
				required: true,
			},
			telepon: {
				required: true,
				number: true,
				maxlength: 14,
				minlength: 9,
			},
		},
		messages: {
			nama_pelanggann: {
				required: "Nama Pelanggan Tidak Boleh Kosong",
			},
			alamat: {
				required: "Alamat Tidak Boleh Kosong",
			},
			telepon: {
				required: "Telepon Tidak Boleh Kosong",
				number: "Mohon Maaf Nomor Telepon Hanya Berisi Angka",
				maxlength: "Maksimal Nomer Yang Di Masukan 14 Karakter",
				minlength: "Minimal Nomer Yang Di Masukan 9 Karakter",
			},
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
			var nama_pelanggan = $("#nama_pelanggann").val();
			var alamat_pelanggan = $("#alamat").val();
			var telepon_pelanggan = $("#telepon").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Pelanggan/insert",
				data: {
					nama_pelanggan: nama_pelanggan,
					alamat_pelanggan: alamat_pelanggan,
					telepon_pelanggan: telepon_pelanggan,
				},
				success: function (data) {
					$("#vpelanggan").html(data);
					$("#nama_pelanggann").val("");
					$("#alamat_pelanggan").val("");
					$("#telepon_pelanggan").val("");
					$("#form-pelanggan").modal("hide");

					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
					toastr.success("Data Berhasil Di Simpan");
				},
			});
		},
	});
});

$("#pelanggan-tambah").click(function () {
	$("#nama_pelanggan").val("");
	$("#alamat").val("");
	$("#telepon").val("");
	$("#pelanggan-title").html("Tambah Data Pelanggan");
});

$("#vpelanggan").on("click", ".hapuspelanggan", function () {
	var kode_pelanggan = $(this).data("kode_pelanggan");
	Swal.fire({
		title: "Apakah Yakin?",
		text: "Menghapus Data Ini?",
		type: "warning",
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type: "POST",
				url: base_url + "Master/Pelanggan/hapus",
				data: {
					kode_pelanggan: kode_pelanggan,
				},
				success: function (data) {
					$("#vpelanggan").html(data);
					$(function () {
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.success("Data Berhasil Di Hapus");
					});
				},
			});
		}
	});
});

$("#vpelanggan").on("click", ".ubahpelanggan", function () {
	var kode_pelanggan = $(this).data("kode_pelanggan");
	var nama_pelanggan = $(this).data("nama_pelanggan");
	var alamat_pelanggan = $(this).data("alamat_pelanggan");
	var telepon_pelanggan = $(this).data("telepon_pelanggan");

	$("#form-pelangganedit").modal("show");
	$("#edtkode_pelanggan").val(kode_pelanggan);
	$("#edtnama_pelanggan").val(nama_pelanggan);
	$("#edtalamat_pelanggan").val(alamat_pelanggan);
	$("#edttelepon_pelanggan").val(telepon_pelanggan);
});

$("#ubahpelanggan").click(function () {
	$("#qpelangganedit").validate({
		rules: {
			edtnama_pelanggan: {
				required: true,
			},
			edtalamat_pelanggan: {
				required: true,
			},
			edttelepon_pelanggan: {
				required: true,
				number: true,
				maxlength: 14,
				minlength: 9,
			},
		},
		messages: {
			edtnama_pelanggan: {
				required: "Nama Pelanggan Tidak Boleh Kosong",
			},
			edtalamat_pelanggan: {
				required: "Alamat Pelanggan Tidak Boleh Kosong",
			},
			edttelepon_pelanggan: {
				required: "Telepon Tidak Boleh Kosong",
				number: "Mohon Maaf Nomor Telepon Hanya Berisi Angka",
				maxlength: "Maksimal Nomer Yang Di Masukan 14 Karakter",
				minlength: "Minimal Nomer Yang Di Masukan 9 Karakter",
			},
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
			var edtkode_pelanggan = $("#edtkode_pelanggan").val();
			var edtnama_pelanggan = $("#edtnama_pelanggan").val();
			var edtalamat_pelanggan = $("#edtalamat_pelanggan").val();
			var edttelepon_pelanggan = $("#edttelepon_pelanggan").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Pelanggan/update",
				data: {
					edtkode_pelanggan: edtkode_pelanggan,
					edtnama_pelanggan: edtnama_pelanggan,
					edtalamat_pelanggan: edtalamat_pelanggan,
					edttelepon_pelanggan: edttelepon_pelanggan,
				},
				success: function (data) {
					$("#vpelanggan").html(data);
					$("#edtnama_pelanggan").val("");
					$("#edtalamat_pelanggan").val("");
					$("#edttelepon_pelanggan").val("");
					$("#form-pelangganedit").modal("hide");
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
					toastr.success("Data Berhasil Di Ubah");
				},
			});
		},
	});
});

// end pelanggan

// start mekanik

$("#simpanmekanik").click(function () {
	$("#qmekaniktambah").validate({
		rules: {
			nama_mekanikk: {
				required: true,
			},
			jabatan_mekanik: {
				required: true,
			},
		},
		messages: {
			nama_mekanikk: {
				required: "Nama Mekanik Tidak Boleh Kosong",
			},
			jabatan_mekanik: {
				required: "Jabatan Tidak Boleh Kosong",
			},
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
			var nama_mekanik = $("#nama_mekanikk").val();
			var jabatan_mekanik = $("#jabatan_mekanik").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Mekanik/insert",
				data: {
					nama_mekanik: nama_mekanik,
					jabatan_mekanik: jabatan_mekanik,
				},
				dataType:'JSON',
				success: function (data) {
					table.ajax.reload(function (json) {
						json.response;
					});
					$("#nama_mekanik").val("");
					$("#jabatan_mekanik").val("");
					$("#form-mekanik").modal("hide");

					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
					toastr.success("Data Berhasil Di Simpan");
				},
			});
		},
	});
});

$("#mekanik-tambah").click(function () {
	$("#nama_mekanik").val("");
	$("#jabatan_mekanik").val("");
	$("#mekanik-title").html("Tambah Data Mekanik");
});

$(document).on("click", ".hapusmek", function () {
	var kode_mekanik = $(this).data("kode_mekanik");
	Swal.fire({
		title: "Apakah Yakin?",
		text: "Menghapus Data Ini?",
		type: "warning",
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type: "POST",
				url: base_url + "Master/Mekanik/hapus",
				data: {
					kode_mekanik: kode_mekanik,
				},
				dataType:'json',
				success: function (data) {
					table.ajax.reload(function (json) {
						json.response;
					});
					$(function () {
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.success("Data Berhasil Di Hapus");
					});
				},
			});
		}
	});
});

$(document).on("click", ".ubahmek", function () {
	var kode_mekanik = $(this).data("kode_mekanik");
	var nama_mekanik = $(this).data("nama_mekanik");
	var jabatan_mekanik = $(this).data("jabatan_mekanik");

	$("#form-mekanikedit").modal("show");
	$("#edtkode_mekanik").val(kode_mekanik);
	$("#edtnama_mekanik").val(nama_mekanik);
	$("#edtjabatan_mekanik").val(jabatan_mekanik);
});

$("#ubahmekanik").click(function () {
	$("#qmekanikedit").validate({
		rules: {
			edtnama_mekanik: {
				required: true,
			},
			edtjabatan_mekanik: {
				required: true,
			},
		},
		messages: {
			edtnama_mekanik: {
				required: "Nama Mekanik Tidak Boleh Kosong",
			},
			edtjabatan_mekanik: {
				required: "Jabatan Tidak Boleh Kosong",
			},
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
			var edtkode_mekanik = $("#edtkode_mekanik").val();
			var edtnama_mekanik = $("#edtnama_mekanik").val();
			var edtjabatan_mekanik = $("#edtjabatan_mekanik").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Mekanik/update",
				data: {
					edtkode_mekanik: edtkode_mekanik,
					edtnama_mekanik: edtnama_mekanik,
					edtjabatan_mekanik: edtjabatan_mekanik,
				},
				dataType:'json',
				success: function (data) {
					table.ajax.reload(function (json) {
						json.response;
					});
					// $("#viewmekanik").html(data);
					$("#edtnama_mekanik").val("");
					$("#edtjabatan_mekanik").val("");
					$("#form-mekanikedit").modal("hide");
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
					toastr.success("Data Berhasil Di Ubah");
				},
			});
		},
	});
});

// end mekanik

// start standart ban

$("#simpanstandart").click(function () {
	$("#qstandarttambah").validate({
		rules: {
			nama_standart: {
				required: true,
			},
			ring_standart: {
				required: true,
			},
			bandepan: {
				required: true,
			},
			banbelakang: {
				required: true,
			},
		},
		messages: {
			nama_standart: {
				required: "Standart Tidak Boleh Kosong",
			},
			ring_standart: {
				required: "Spesifikasi Standart Ban Tidak Boleh Kosong",
			},
			bandepan: {
				required: "Ban Depan Tidak Boleh Kosong",
			},
			banbelakang: {
				required: "Ban Belakang Tidak Boleh Kosong",
			},
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
			var nama_standart = $("#nama_standart").val();
			var ring_standart = $("#ring_standart").val();
			var bandepan = $("#bandepan").val();
			var banbelakang = $("#banbelakang").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Standart/insert",
				data: {
					nama_standart: nama_standart,
					ring_standart: ring_standart,
					bandepan: bandepan,
					banbelakang: banbelakang,
				},
				success: function (data) {
					$("#viewstandart").html(data);
					$("#nama_standart").val("");
					$("#ring_standart").val("");
					$("#bandepan").val("");
					$("#banbelakang").val("");
					$("#form-standart").modal("hide");

					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
					toastr.success("Data Berhasil Di Simpan");
				},
			});
		},
	});
});

$("#standart-tambah").click(function () {
	$("#nama_standart").val("");
	$("#jabatan_standart").val("");
	$("#standart-title").html("Tambah Data Standart");
});

$("#viewstandart").on("click", ".hapusstandart", function () {
	var id_standart = $(this).data("id_standart");
	Swal.fire({
		title: "Apakah Yakin?",
		text: "Menghapus Data Ini?",
		type: "warning",
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type: "POST",
				url: base_url + "Master/Standart/hapus",
				data: {
					id_standart: id_standart,
				},
				success: function (data) {
					$("#viewstandart").html(data);
					$(function () {
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.success("Data Berhasil Di Hapus");
					});
				},
			});
		}
	});
});

$("#viewstandart").on("click", ".ubahstandart", function () {
	var id_standart = $(this).data("id_standart");
	var nama_standart = $(this).data("nama_standart");
	var ring_standart = $(this).data("ring_standart");
	var bandepan = $(this).data("bandepan");
	var banbelakang = $(this).data("banbelakang");

	$("#form-standartedit").modal("show");
	$("#edtid_standart").val(id_standart);
	$("#edtnama_standart").val(nama_standart);
	$("#edtring_standart").val(ring_standart);
	$("#edtbandepan").val(bandepan);
	$("#edtbanbelakang").val(banbelakang);
});

$("#ubahstandart").click(function () {
	$("#qstandartedit").validate({
		rules: {
			edtnama_standart: {
				required: true,
			},
			edtring_standart: {
				required: true,
			},
			edtbandepan: {
				required: true,
			},
			edtbanbelakang: {
				required: true,
			},
		},
		messages: {
			edtnama_standart: {
				required: "Standart Tidak Boleh Kosong",
			},
			edtring_standart: {
				required: "Spesifikasi Tidak Boleh Kosong",
			},
			edtbandepan: {
				required: "Ban Depan Tidak Boleh Kosong",
			},
			edtbanbelakang: {
				required: "Ban Belakang Tidak Boleh Kosong",
			},
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
			var edtid_standart = $("#edtid_standart").val();
			var edtnama_standart = $("#edtnama_standart").val();
			var edtring_standart = $("#edtring_standart").val();
			var edtbandepan = $("#edtbandepan").val();
			var edtbanbelakang = $("#edtbanbelakang").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Standart/update",
				data: {
					edtid_standart: edtid_standart,
					edtnama_standart: edtnama_standart,
					edtring_standart: edtring_standart,
					edtbandepan: edtbandepan,
					edtbanbelakang: edtbanbelakang,
				},
				success: function (data) {
					$("#viewstandart").html(data);
					$("#edtnama_standart").val("");
					$("#edtring_standart").val("");
					$("#edtbanbelakang").val("");
					$("#edtbandepan").val("");
					$("#form-standartedit").modal("hide");
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
					toastr.success("Data Berhasil Di Ubah");
				},
			});
		},
	});
});
// end standart ban

// start akun

$("#simpan").click(function () {
	$("#form").validate({
		rules: {
			// kode_barang: {
			// 	required: true
			// },
			nama_lengkap: {
				required: true,
			},
			username: {
				required: true,
			},
			password1: {
				required: true,
				minlength: 4,
				maxlength: 16,
			},
			password2: {
				required: true,
				equalTo: "#password1",
				minlength: 4,
				maxlength: 16,
			},
			level: {
				required: true,
			},
		},
		messages: {
			// kode_barang: {
			// 	required: "Masukan Kode Barang"
			// },
			nama_lengkap: {
				required: "Nama Lengkap Tidak Boleh Kosong",
			},
			username: {
				required: "Username Tidak Boleh Kosong",
			},
			password1: {
				required: "Password Tidak Boleh Kosong",
				minlength: "Masukan Minimal 4 Karakter",
				maxlength: "Masukan Maksimal 16 karakter",
			},
			password2: {
				required: "Konfirmasi Password Tidak Boleh Kosong",
				equalTo: "Password Tidak Sama",
				minlength: "Masukan Minimal 4 Karakter",
				maxlength: "Masukan Maksimal 16 karakter",
			},
			level: {
				required: "Pilih Level",
			},
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
			var nama_lengkap = $("#nama_lengkap").val();
			var username = $("#username").val();
			var password = $("#password1").val();
			var level = $("#level").val();
			$.ajax({
				type: "POST",
				url: base_url + "Auth/insert",
				data: {
					nama_lengkap: nama_lengkap,
					username: username,
					password: password,
					level: level,
				},
				success: function (data) {
					$("#viewakun").html(data);
					$("#form-modal").hide();
					$("#nama_lengkap").val("");
					$("#username").val("");
					$("#password1").val("");
					$("#password2").val("");
					$("#level").val("").trigger("change");
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
					toastr.success("Data Berhasil Di Simpan");
					$("#form-modal").modal("hide");
				},
			});
		},
	});
});

$(document).on("click", ".ubahbarang", function () {
	var iduser = $(this).data("iduser");
	var nm_lengkap = $(this).data("nm_lengkap");
	var usrnm = $(this).data("usrnm");
	var level = $(this).data("level");

	$("#formEdit").modal("show");
	$("#judulEdit").html("Edit Akun");
	$("#iduser").val(iduser);
	$("#nm_lengkap").val(nm_lengkap);
	$("#usrnm").val(usrnm);
	$("#level2").val(level).trigger("change");
});

$("#ubahakun").click(function () {
	$("#editAkun").validate({
		rules: {
			nm_lengkap: {
				required: true,
			},
			usrnm: {
				required: true,
			},
			pass1: {
				required: true,
				minlength: 4,
				maxlength: 16,
			},
			pass2: {
				required: true,
				equalTo: "#pass1",
				minlength: 4,
				maxlength: 16,
			},
			level: {
				required: true,
			},
		},
		messages: {
			nm_lengkap: {
				required: "Nama Lengkap Tidak Boleh Kosong",
			},
			usrnm: {
				required: "Username Tidak Boleh Kosong",
			},
			pass1: {
				required: "Password Tidak Boleh Kosong",
				minlength: "Masukan Minimal 4 Karakter",
				maxlength: "Masukan Maksimal 16 karakter",
			},
			pass2: {
				required: "Konfirmasi Password Tidak Boleh Kosong",
				equalTo: "Password Tidak Sama",
				minlength: "Masukan Minimal 4 Karakter",
				maxlength: "Masukan Maksimal 16 karakter",
			},
			level: {
				required: "Pilih Level",
			},
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
			var iduser = $("#iduser").val();
			var nm_lengkap = $("#nm_lengkap").val();
			var usrnm = $("#usrnm").val();
			var pass1 = $("#pass1").val();
			var pass2 = $("#pass2").val();
			var level2 = $("#level2").val();

			$.ajax({
				type: "POST",
				url: base_url + "Auth/update",
				data: {
					nm_lengkap: nm_lengkap,
					usrnm: usrnm,
					pass1: pass1,
					pass2: pass2,
					level2: level2,
					iduser: iduser,
				},
				success: function (data) {
					$(".viewakun").html(data);
					$("#nm_lengkap").val("");
					$("#usrnm").val("");
					$("#pass1").val("");
					$("#pass2").val("");
					$("#level2").val("").trigger("change");
					$("#formEdit").modal("hide");
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
					toastr.success("Data Berhasil Di Ubah");
				},
			});
		},
	});
});
$(document).on("click", ".hapusakun", function () {
	var id_user = $(this).data("id_user");
	Swal.fire({
		title: "Apakah Yakin?",
		text: "Menghapus Data Ini?",
		type: "warning",
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type: "POST",
				url: base_url + "Auth/hapusakun",
				data: {
					id_user: id_user,
				},
				success: function (data) {
					$(".viewakun").html(data);
					$(function () {
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.success("Data Berhasil Di Hapus");
					});
				},
			});
		}
	});
});

// start nota setting
notatmpil();

function notatmpil() {
	$.ajax({
		type: "POST",
		url: base_url + "Setting/Nota/tmpilnota",
		dataType: "json",
		success: function (response) {
			$("#id_nota").val(response.data[0][0]);
			$("#nama_perusahaan").val(response.data[0][1]);
			$("#alamat").val(response.data[0][2]);
			$("#no_hp").val(response.data[0][3]);
		},
	});
}

$("#nota_simpan").click(function () {
	$("#notaform").validate({
		rules: {
			nama_perusahaan: {
				required: true,
			},
			alamat: {
				required: true,
			},
			no_hp: {
				required: true,
				number: true,
				maxlength: 14,
				minlength: 9,
			},
		},
		messages: {
			nama_perusahaan: {
				required: "Nama Perusahaan Tidak Boleh Kosong",
			},
			alamat: {
				required: "Alamat Tidak Boleh Kosong",
			},
			no_hp: {
				required: "Telepon Tidak Boleh Kosong",
				number: "Mohon Maaf Nomor Telepon Hanya Berisi Angka",
				maxlength: "Maksimal Nomer Yang Di Masukan 14 Karakter",
				minlength: "Minimal Nomer Yang Di Masukan 9 Karakter",
			},
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
			var id_nota = $("#id_nota").val();
			var nama_perusahaan = $("#nama_perusahaan").val();
			var alamat = $("#alamat").val();
			var no_hp = $("#no_hp").val();
			$.ajax({
				type: "POST",
				url: base_url + "Setting/Nota/update",
				data: {
					id_nota: id_nota,
					nama_perusahaan: nama_perusahaan,
					alamat: alamat,
					no_hp: no_hp,
				},
				success: function (response) {
					notatmpil();
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
					toastr.success("Data Berhasil Di Simpan");
				},
			});
		},
	});
});
// end nota setting

// start print setting
cetaktmpil();

function cetaktmpil() {
	$.ajax({
		type: "POST",
		url: base_url + "Setting/cetak/tmpilcetak",
		dataType: "json",
		success: function (response) {
			$("#id_cetak").val(response.data[0][0]);
			$("#apikey").val(response.data[0][1]);
			$("#port").val(response.data[0][2]);
		},
	});
}

$("#cetak_simpan").click(function () {
	$("#cetakform").validate({
		rules: {
			apikey: {
				required: true,
				number: true,
				maxlength: 10,
			},
			port: {
				required: true,
				number: true,
				maxlength: 4,
			},
		},
		messages: {
			apikey: {
				required: "Apikey Tidak Boleh Kosong",
				number: "Mohon Maaf Hanya Bisa Memasukan Angka",
				maxlength: "Maksimal Nomer Yang Di Masukan 10 Angka",
			},
			port: {
				required: "port Tidak Boleh Kosong",
				number: "Mohon Maaf Hanya Bisa Memasukan Angka",
				maxlength: "Maksimal Nomer Yang Di Masukan 4 Angka",
			},
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
			var id_cetak = $("#id_cetak").val();
			var apikey = $("#apikey").val();
			var port = $("#port").val();

			$.ajax({
				type: "POST",
				url: base_url + "Setting/cetak/update",
				data: {
					id_cetak: id_cetak,
					apikey: apikey,
					port: port,
				},
				success: function (response) {
					cetaktmpil();
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
					toastr.success("Data Berhasil Di Setting");
				},
			});
		},
	});
});
// end cetak setting

// start models satuan kategori
$("#simpan_satuan").click(function () {
	$("#satuanvalid").validate({
		rules: {
			nama_satuan: {
				required: true,
			},
		},
		messages: {
			nama_satuan: {
				required: "Mohon Masukan Nama Satuan",
			},
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
			var nama_satuan = $("#nama_satuan").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Satuan/insert",
				data: {
					nama_satuan: nama_satuan,
				},
				dataType: "json",
				success: function (response) {
					console.log(response.code);
					if (response.code == "200") {
						$("#nama_satuan").val("");
						$("#id_satuan").modal("hide");

						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.success("Data Berhasil Di Simpan");
						selectdata();
						$("#satuan").modal("hide");
						$("#form-modal").modal("show");
					} else {
						$(".errors").html(response.val);
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.error("Mohon Maaf, Data Sudah Ada");
					}
				},
			});
		},
	});
});

$("#simpan_kategori").click(function () {
	$("#kategorivalid").validate({
		rules: {
			nama_katagori: {
				required: true,
			},
		},
		messages: {
			nama_katagori: {
				required: "Mohon Masukan Nama Kategori",
			},
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
			var nama_katagori = $("#nama_katagori").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Kategori/insert",
				data: {
					nama_katagori: nama_katagori,
				},
				dataType: "json",
				success: function (response) {
					if (response.code == "200") {
						$("#nama_katagori").val("");
						$("#id_kategori").modal("hide");

						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.success("Data Berhasil Di Simpan");
						selectdata();
						$("#kategori").modal("hide");
						$("#form-modal").modal("show");
					} else {
						$(".errors").html(response.val);
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.error("Data Sudah Ada");
					}
				},
			});
		},
	});
});

// end models

// start jasa

$("#simpanjasa").click(function () {
	$("#qjasatambah").validate({
		rules: {
			Jasa: {
				required: true,
			},
			harga: {
				required: true,
			},
			qty_1:{
				number:true
			},
			pot_1:{
				number:true
			},
			qty_2:{
				number:true
			},
			pot_2:{
				number:true
			}
		},
		messages: {
			Jasa: {
				required: "Jenis Jasa Tidak Boleh Kosong",
			},
			harga: {
				required: "Harga Jasa Tidak Boleh Kosong",
			},
			qty_1:{
				number:"Mohon isi dengan angka"
			},
			pot_1:{
				number:"Mohon isi dengan angka"
			},
			qty_2:{
				number:"Mohon isi dengan angka"
			},
			pot_2:{
				number:"Mohon isi dengan angka"
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
			var Jasa = $("#Jasa").val();
			var harga = $("#harga").val();
			var qty_1 = $("#qty_1").val();
			var pot_1 = $("#pot_1").val();
			var qty_2 = $("#qty_2").val();
			var pot_2 = $("#pot_2").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Jasa/insert",
				data: {
					Jasa: Jasa,
					harga: harga,
					qty_1: qty_1,
					pot_1: pot_1,
					qty_2: qty_2,
					pot_2: pot_2,
				},
				dataType: "json",
				success: function (response) {
					if (response.code == "200") {
						$("#form-jasa").modal("hide");
						$("#Jasa").val("");
						$("#harga").val("");
						$("#qty_1").val("");
						$("#pot_1").val("");
						$("#qty_2").val("");
						$("#pot_2").val("");
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.success("Data Berhasil Di Simpan");
						$("#tmpJasa").load(base_url + "Master/Jasa/vjasa");
					} else {
						$(".errors").html(response.val);
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.error("Data Sudah Ada");
						$("#tmpJasa").load(base_url + "Master/Jasa/vjasa");
					}
				},
			});
		},
	});
});

$("#jasa-tambah").click(function () {
	$("#Jasa").val("");
	$("#harga").val("");
	$("#form-jasa").show();
	$("#jasa-title").html("Tambah Jasa");
});

$(document).on("click", ".hpsjasa", function () {
	var id_jasa = $(this).data("id_jasa");
	Swal.fire({
		title: "Apakah Yakin?",
		text: "Menghapus Data Ini?",
		type: "warning",
		showCancelButton: true,
		allowOutsideClick: false,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type: "POST",
				url: base_url + "Master/Jasa/hapus",
				data: {
					id_jasa: id_jasa,
				},
				success: function (data) {
					$("#tmpJasa").load(base_url + "Master/Jasa/vjasa");
					$(function () {
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.success("Data Berhasil Di Hapus");
					});
				},
			});
		}
	});
});

$(document).on("click", ".ubhjasa", function () {
	var id_jasa = $(this).data("idjasa");
	var Jasa = $(this).data("jasa");
	var Harga_jasa = $(this).data("hargajasa");
	var edtqty_1 = $(this).data("edtqty");
	var edtpot = $(this).data("edtpot");
	var edtqty2 = $(this).data("edtqty2");
	var edtpot2 = $(this).data("edtpot2");

	$("#form-jasaedit").modal("show");
	$("#edtid_jasa").val(id_jasa);
	$("#edtJasa").val(Jasa);
	$("#edtharga").val(Harga_jasa);
	$("#edtqty_1").val(edtqty_1);
	$("#edtpot").val(edtpot);
	$("#edtqty_2").val(edtqty2);
	$("#edtpot_2").val(edtpot2);
});

$("#ubahjasa").click(function () {
	$("#qjasaedit").validate({
		rules: {
			edtJasa: {
				required: true,
			},
			edtharga: {
				required: true,
			},
			edtqty_1:{
				number:true
			},
			edtpot:{
				number:true
			},
			edtqty_2:{
				number:true
			},
			edtpot_2:{
				number:true
			}
		},
		messages: {
			edtJasa: {
				required: "Jasa Tidak Boleh Kosong",
			},
			edtharga: {
				required: "Harga Tidak Boleh Kosong",
			},
			edtqty_1:{
				number:"Mohon isi dengan angka"
			},
			edtpot:{
				number:"Mohon isi dengan angka"
			},
			edtqty_2:{
				number:"Mohon isi dengan angka"
			},
			edtpot_2:{
				number:"Mohon isi dengan angka"
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
			var edtJasa = $("#edtJasa").val();
			var edtharga = $("#edtharga").val();
			var edtid_jasa = $("#edtid_jasa").val();
			var edtqty_1 = $("#edtqty_1").val();
			var edtpot = $("#edtpot").val();
			var edtqty_2 = $("#edtqty_2").val();
			var edtpot_2 = $("#edtpot_2").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Jasa/update",
				data: {
					edtid_jasa: edtid_jasa,
					edtJasa: edtJasa,
					edtharga: edtharga,
					edtqty_1:edtqty_1,
					edtpot:edtpot,
					edtqty_2:edtqty_2,
					edtpot_2:edtpot_2,
				},
				success: function (data) {
					$("#tmpJasa").load(base_url + "Master/Jasa/vjasa");
					$("#edtJasa").val("");
					$("#edtharga").val("");
					$("#edtqty_1").val("");
					$("#edtpot").val("");
					$("#edtqty_2").val("");
					$("#edtpot_2").val("");
					$("#form-jasaedit").modal("hide");
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
					});
					toastr.success("Data Berhasil Di Ubah");
				},
			});
		},
	});
});

$("#harga").on("keyup", function () {
	$("#harga").priceFormat({
		prefix: "",
		centsLimit: 0,
		thousandsSeparator: ".",
	});
});

$("#edtharga").on("keyup", function () {
	$("#edtharga").priceFormat({
		prefix: "",
		centsLimit: 0,
		thousandsSeparator: ".",
	});
});
// end jasa

// serverside retur barang
$(document).on("click", ".tambah", function () {
	var link = $(this).attr("data-link");
	$(".tambah").attr("disabled", true);
	$.ajax({
		url: link,
		type: "GET",
		dataType: "json",
		error: function () {
			Swal.fire({
				title: "Kesalahan!",
				text: "Gagal Load",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#3085d6",
				confirmButtonText: "Ok",
			});
		},
		success: function (data) {
			$("#modal-title").html(data.title);
			$(".datainput").html(data.datainput);
			$(".tambah").attr("disabled", false);
		},
	});
});


$(document).on("click", ".ubah", function () {
	var link = $(this).attr("data-link");
	$(".ubah").attr("disabled", true);
	$.ajax({
		url: link,
		type: "GET",
		dataType: "json",

		error: function () {
			Swal.fire({
				title: "Kesalahan!",
				text: "Gagal Load",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#3085d6",
				confirmButtonText: "Ok",
			});
		}
	}).done(function(data) {
		$("#modal-title").html(data.title);
		$(".datainput").html(data.datainput);
		$(".ubah").attr("disabled", false);
	});
});

$(".datainput #form input").on("keyup", function () {
	$(this).removeClass("is-invalid").addClass("is-valid");
	$(this).parents(".form-group").find("#error").html(" ");
});

$(document).on("click", ".simpan", function (event) {
	event.preventDefault();
	var link = $(".simpan").attr("data-link");
	var dataform = new FormData(this.form);
	$(".loading").show();
	$(".simpan").attr("disabled", true);
	$("#error").html(" ");
	$.ajax({
		type: "POST",
		contentType: false,
		processData: false,
		cache: false,
		url: link,
		data: dataform,
		dataType: "json",
		error: function () {
			Swal.fire({
				title: "Kesalahan!",
				text: "Gagal Load",
				type: "error",
				showCancelButton: false,
				confirmButtonColor: "#3085d6",
				confirmButtonText: "Ok",
			});
			$(".loading").hide();
			$(".simpan").attr("disabled", false);
		},
		success: function (data) {
			table.ajax.reload(function (json) {
				json.data;
			});
			tablee.ajax.reload(function(json) {
				json.data;
			})
	
				if ($.isEmptyObject(data.error)) {
					Swal.fire({
						title: "Berhasil",
						text: "",
						type: "success",
						showCancelButton: false,
						confirmButtonColor: "blue",
						confirmButtonText: "Ok",
					});
					$.each(data, function (key) {
						$("#tambah-" + key).val("");
					});
					
					$("#serverside").modal("hide");
					$(".loading").hide();
					$(".simpan").attr("disabled", false);
				} else {
					$.each(data, function (key, value) {
						$("#tambah-" + key).addClass("is-invalid");
						$("#tambah-" + key)
							.parents(".form-group")
							.find("#error")
							.html(value);
					});
					$(".loading").hide();
					$(".simpan").attr("disabled", false);
				}
			
		},
	});
});

$(document).on("click", ".remove", function () {
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
		cancelButtonText: "Batal",
	}).then((result) => {
		if (result.value) {
			$.ajax({
				type: "GET",
				url: link,
				dataType: "JSON",
				success: function (data) {
					table.ajax.reload(function (json) {
						json.data;
					});
					$(function () {
						const Toast = Swal.mixin({
							toast: true,
							position: "top-end",
							showConfirmButton: false,
							timer: 3000,
						});
						toastr.success("Data Berhasil Di Hapus");
					});
				},
			});
		}
	});
});


$(document).on('click','.pilih',function() {
	var link = $(this).data('link');
	$.ajax({
		type:"GET",
		url: link,
		dataType:"JSON"
	}).done(function (data) {
		$.each(data.data, function (keyfield, keyvalue) {
			$('#tambah-' + keyfield).val(keyvalue);
		  })
		  $('#searchdatatables').modal("hide");
		  $('#tambah-jmlhpengembalian').attr({
			"max" : data.data.jmlhpengembalian
		});
	})
})

// end serverside retur barang
