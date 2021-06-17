$("#tambahdata").load(base_url + "Gudang/Pembelian/viewC");
$("#cariBarang").load(base_url + "Gudang/Pembelian/cariVBar");

// tombol pembelian disable start
$("#tambahcart").attr("disabled", "disabled");
$("#txtnama_barang").attr("disabled", "disabled");
$("#harga_jual").attr("disabled", "disabled");
$("#harga_beli").attr("disabled", "disabled");
$("#txtqty").attr("disabled", "disabled");
$("#txtkode_barang").attr("disabled", true);
// end tombol disable

const berhasil = $(".flash-berhasil").data("berhasil");
if (berhasil) {
	Swal.mixin({
		toast: true,
		position: "top-end",
		showConfirmButton: false,
		timer: 5000
	});
	toastr.success(berhasil);
}

const gagal = $(".flash-gagal").data("gagal");
if (gagal) {
	Swal.mixin({
		toast: true,
		position: "top-end",
		showConfirmButton: false,
		timer: 10000
	});
	toastr.error(gagal);
}

$(document).on("click", ".caribrg", function () {
	var kode_barang = $(this).data("kode_brg");
	var nama_barang = $(this).data("nama_barang");
	var harga_jual = $(this).data("harga_jual");
	var harga_beli = $(this).data("harga_beli");
	var nama_satuan = $(this).data("nama_satuan");
	var nama_katagori = $(this).data("nama_katagori");
	var type_exp = $(this).data("type_exp");

	$("#tambahcart").attr("disabled", false);
	$("#harga_jual").attr("disabled", false);
	$("#harga_beli").attr("disabled", false);
	$("#txtqty").attr("disabled", false);

	$("#txtkode_barang").val(kode_barang);
	$("#txtnama_barang").val(nama_barang);
	$("#harga_jual").val(harga_jual);
	$("#harga_beli").val(harga_beli);
	$("[name='satuan']").val(nama_satuan);
	$("[name='katagori']").val(nama_katagori);
	$("#exampleModal").modal("hide");
	if (type_exp == "1") {
		$(".hidde").show();
	} else {
		$(".hidde").hide();
	}
	const Toast = Swal.mixin({
		toast: true,
		position: "top-end",
		showConfirmButton: false,
		timer: 3000
	});
	toastr.success("Data Barang Berhasil Diakses");
});

$(document).on("click", "#beliJasa", function () {
	$(".hidde").show();
	$(".real").hide();
	$("#beliBan").show();
	$("#beliJasa").hide();
});
$(document).on("click", "#beliBan", function () {
	$(".hidde").hide();
	$(".real").show();
	$("#beliBan").hide();
	$("#beliJasa").show();
});

function tambahdata() {
	var kode_barang = $(this).data("kode_barang");
	var nama_barang = $(this).data("nama_barang");
	var harga_jual = $(this).data("harga_jual");
	var harga_beli = $(this).data("harga_beli");
	var nama_satuan = $(this).data("nama_satuan");
	var nama_katagori = $(this).data("nama_katagori");

	$("[name='txtkode_barang']").val(kode_barang);
	$("[name='txtnama_barang']").val(nama_barang);
	$("[name='txtHrg_jual']").val(harga_jual);
	$("[name='txtHrg_beli']").val(harga_beli);
	$("[name='satuan']").val(nama_satuan);
	$("[name='katagori']").val(nama_katagori);
	$("form").modal("hide");
}

//hapus_cart
$(document).on("click", ".hapus_cart", function () {
	var kode_produksi = $(this).data("kode_produksi");
	var kode_barang = $(this).data("kode_barang");
	Swal.fire({
		title: "Apakah Yakin?",
		text: "Menghapus Data Ini?",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus",
		cancelButtonText: "Batal"
	}).then(result => {
		if (result.value) {
			$.ajax({
				url: base_url + "Gudang/Pembelian/hapus_cart",
				method: "POST",
				data: {
					kode_barang: kode_barang,
					kode_produksi:kode_produksi
				},
				success: function (data) { 
					tablepembelian.ajax.reload(function (json) {
						json.response;
					});
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000
					});
					toastr.success("Data Cart Berhahsil Di Hapus");
					$("#tambahdata").html(data);
				}
			});
		}
	});
});

$("#txtkode_barang").keypress(function (event) {
	if (event.keyCode === 13) {
		$("#loading").show();
		var kode_barang = $(this).val();
		$.ajax({
			type: "POST",
			url: base_url + "Gudang/Pembelian/carikodebarang",
			dataType: "JSON",
			data: {
				kode_barang: kode_barang
			},
			success: function (data) {
				$.each(data, function (
					kode_barang,
					nama_barang,
					harga_jual,
					harga_beli,
					id_satuan,
					id_katagori,
					type_exp
				) {
					if (
						data.nama_barang !== "" &&
						data.harga_jual != null &&
						data.harga_beli != null &&
						data.type_exp != null
					) {
						$("#tambahcart").attr("disabled", false);
						$("#harga_jual").attr("disabled", false);
						$("#harga_beli").attr("disabled", false);
						$("#txtqty").attr("disabled", false);
						$("#txtnama_barang").val(data.nama_barang);
						$("#harga_jual").val(data.harga_jual);
						$("#harga_beli").val(data.harga_beli);
						$("#satuan").val(data.id_satuan);
						$("#katagori").val(data.id_katagori);
						if (data.type_exp == "1") {
							$(".hidde").show();
						} else {
							$(".hidde").hide();
						}
						$("#loading").hide();
					} else {
						$("#tambahcart").attr("disabled", true);
						$("#harga_jual").attr("disabled", true);
						$("#harga_beli").attr("disabled", true);
						$("#txtqty").attr("disabled", true);
						$("#txtnama_barang").val("");
						$("#harga_jual").val("");
						$("#harga_beli").val("");
						$("#satuan").val("");
						$("#katagori").val("");
						if (data.type_exp == "1") {
							$(".hidde").show();
						} else {
							$(".hidde").hide();
						}
						$("#loading").hide();
					}
				});
			}
		});
		return false;
	}
});

$("#tambahcart").click(function () {
	$("#pembelianvalid").validate({
		rules: {
			txtno_faktur: {
				required: true
			},
			kode_supplier: {
				required: true
			},
			txttgl_pembelian: {
				required: true
			},
			txtqty: {
				required: true,
				number: true
			},
			harga_jual: {
				required: true
			},
			harga_beli: {
				required: true
			},
			stok_min: {
				required: true
			},
			aktif: {
				required: true
			},
			txtkode_produksi: {
				required: true
			},
			txtmasa_aktif: {
				required: true
			}
		},
		messages: {
			txtno_faktur: {
				required: "No Faktur Tidak Boleh Kosong"
			},
			kode_supplier: {
				required: "Supplier Harus Di Pilih Terlebih Dahulu"
			},
			txttgl_pembelian: {
				required: "Tanggal Harus Di Pilih Terlebih Dahulu"
			},
			txtqty: {
				required: "Qty Tidak Boleh Kosong",
				number: "Harus Di Isi Dengan Angka"
			},
			harga_jual: {
				required: "Harga Jual Tidak Boleh Kosong"
			},
			harga_beli: {
				required: "Harga Beli Tidak Boleh Kosong"
			},
			txtkode_produksi: {
				required: "Kode Produksi Tidak Boleh Kosong"
			},
			txtmasa_aktif: {
				required: "Masa Aktif Harus Di Pilih Terlebih Dahulu"
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
			$("#tambahcart").attr("disabled", "disabled");
			var kode_barang = $("#txtkode_barang").val();
			var nama_barang = $("#txtnama_barang").val();
			var kode_produksi = $("#txtkode_produksi").val();
			var masa_aktif = $("#txtmasa_aktif").val();
			var harga_jual = $("#harga_jual").val();
			var harga_beli = $("#harga_beli").val();
			var qty = $("#txtqty").val();
			var satuan = $("#satuan").val();
			var katagori = $("#katagori").val();
			// -------
			var txtno_faktur = $("#txtno_faktur").val();
			var kode_supplier = $("#kode_supplier").val();
			var txttgl_pembelian = $("#txttgl_pembelian").val();
			// -------------
			$.ajax({
				url: base_url + "Gudang/Pembelian/add_cart",
				method: "POST",
				data: {
					kode_barang: kode_barang,
					nama_barang: nama_barang,
					kode_produksi: kode_produksi,
					masa_aktif: masa_aktif,
					harga_jual: harga_jual,
					harga_beli: harga_beli,
					qty: qty,
					satuan: satuan,
					katagori: katagori,
					txtno_faktur: txtno_faktur,
					kode_supplier: kode_supplier,
					txttgl_pembelian: txttgl_pembelian
				},
				dataType:"json",
				success: function (data) {
					tablepembelian.ajax.reload(function (json) {
						json.response;
					});
					$("#tambahdata").html(data);
					$("#txtkode_barang").val("");
					$("#txtnama_barang").val("");
					$("#txtkode_produksi").val("");
					$("#txtmasa_aktif")
						.val("")
						.trigger("change");
					$("#harga_jual").val("");
					$("#harga_beli").val("");
					$("#txtqty").val("");
					$("#satuan").val("");
					$("#katagori").val("");
					$("#tambahcart").attr("disabled", true);
					$("#harga_jual").attr("disabled", true);
					$("#harga_beli").attr("disabled", true);
					$("#txtqty").attr("disabled", true);
					$("#loading").hide();
					$(".hidde").hide();
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000
					});
					toastr.success("Items Berhasil Di Tambah");
				}
			});
		}
	});
});

$("#simpan_sup").click(function () {
	$("#suppliervalid").validate({
		rules: {
			nama_supplier: {
				required: true
			},
			alamat_sup: {
				required: true
			},
			telpon_sup: {
				required: true,
				number: true,
				maxlength: 14,
				minlength: 9
			}
		},
		messages: {
			nama_supplier: {
				required: "Mohon Masukan Nama Supplier"
			},
			alamat_sup: {
				required: "Mohon Masukan Alamat Supplier"
			},
			telpon_sup: {
				required: "Mohon Masukan Nomor Telepon",
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
			var nama_supplier = $("#nama_supplier").val();
			var alamat_sup = $("#alamat_sup").val();
			var telpon_sup = $("#telpon_sup").val();
			$.ajax({
				type: "POST",
				url: base_url + "Master/Supplier/insert",
				data: {
					nama_supplier: nama_supplier,
					alamat_sup: alamat_sup,
					telpon_sup: telpon_sup
				},
				success: function (data) {
					$("#nama_supplier").val("");
					$("#alamat_sup").val("");
					$("#telepon").val("");
					$("#kode_supplier").modal("hide");
					supplierselect();
					const Toast = Swal.mixin({
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000
					});
					toastr.success("Data Berhasil Di Simpan");
					// window.location.reload(true);
					$('#supplier').modal('hide');

				}
			});
		}
	});
});


$(document).on("click", ".hapus", function () {
	var link = $(this).data("link");
	Swal.fire({
		title: "Apakah Yakin Menghapus ?",
		text: "Data yang sudah terhapus tidak bisa di kembalikan",
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


$(document).on("click", ".hapuspembelian", function () {
	var link = $(this).data("link");
	var kodebarang = $(this).data('kode_barang')
	var kode_produksi = $(this).data('kode_produksi_pem')
	console.log(kodebarang);
	Swal.fire({
		title: "Apakah Yakin Menghapus ?",
		text: "Data yang sudah terhapus tidak bisa di kembalikan",
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
				url: link,
				data: {
					kodebarang:kodebarang,
					kode_produksi:kode_produksi
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
