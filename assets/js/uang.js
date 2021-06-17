var harga_jual = document.getElementById("harga_jual");
$(harga_jual).keyup(function (e) {
	harga_jual.value = formatRupiah(this.value, "Rp. ");
});

function formatRupiah(angka, prefix) {
	var number_string = angka.replace(/[^,\d]/g, "").toString(),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		harga_jual = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	if (ribuan) {
		separator = sisa ? "." : "";
		harga_jual += separator + ribuan.join(".");
	}

	harga_jual = split[1] != undefined ? harga_jual + "," + split[1] : harga_jual;
	return prefix == undefined ? harga_jual : harga_jual ? "Rp. " + harga_jual : "";
}

var harga_beli = document.getElementById("harga_beli");
$(harga_beli).keyup(function (e) {
	harga_beli.value = formatharga_beli(this.value, "Rp. ");
});
/* Fungsi formatharga_beli */
function formatharga_beli(angka, prefix) {
	var number_string = angka.replace(/[^,\d]/g, "").toString(),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		harga_beli = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);
	if (ribuan) {
		separator = sisa ? "." : "";
		harga_beli += separator + ribuan.join(".");
	}

	harga_beli = split[1] != undefined ? harga_beli + "," + split[1] : harga_beli;
	return prefix == undefined ? harga_beli : harga_beli ? "Rp. " + harga_beli : "";
}

var txtharga_jual = document.getElementById("txtharga_jual");
$(txtharga_jual).keyup(function (e) {
	txtharga_jual.value = formattxtharga_jual(this.value, "Rp. ");
});
/* Fungsi formattxtharga_jual */
function formattxtharga_jual(angka, prefix) {
	var number_string = angka.replace(/[^,\d]/g, "").toString(),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		txtharga_jual = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);
	if (ribuan) {
		separator = sisa ? "." : "";
		txtharga_jual += separator + ribuan.join(".");
	}

	txtharga_jual = split[1] != undefined ? txtharga_jual + "," + split[1] : txtharga_jual;
	return prefix == undefined ? txtharga_jual : txtharga_jual ? "Rp. " + txtharga_jual : "";
}

var txtharga_beli = document.getElementById("txtharga_beli");
$(txtharga_beli).keyup(function (e) {
	txtharga_beli.value = formattxtharga_beli(this.value, "Rp. ");
});

function formattxtharga_beli(angka, prefix) {
	var number_string = angka.replace(/[^,\d]/g, "").toString(),
		split = number_string.split(","),
		sisa = split[0].length % 3,
		txtharga_beli = split[0].substr(0, sisa),
		ribuan = split[0].substr(sisa).match(/\d{3}/gi);

	if (ribuan) {
		separator = sisa ? "." : "";
		txtharga_beli += separator + ribuan.join(".");
	}

	txtharga_beli = split[1] != undefined ? txtharga_beli + "," + split[1] : txtharga_beli;
	return prefix == undefined ? txtharga_beli : txtharga_beli ? "Rp. " + txtharga_beli : "";
}

// var total_tunai = document.getElementById('total_tunai');
// 	total_tunai.addEventListener('keyup', function(e){
// 			// tambahkan 'Rp.' pada saat form di ketik
// 			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
// 		total_tunai.value = formatRupiah(this.value, 'Rp. ');
// 	});

// 		/* Fungsi formatRupiah */
// 	function formatRupiah(angka, prefix){
// 	var number_string = angka.replace(/[^,\d]/g, '').toString(),
// 	split   		= number_string.split(','),
// 	sisa     		= split[0].length % 3,
// 	total_tunai  	= split[0].substr(0, sisa),
// 	ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

// 			// tambahkan titik jika yang di input sudah menjadi angka ribuan
// 	if(ribuan){
// 		separator = sisa ? '.' : '';
// 		total_tunai += separator + ribuan.join('.');
// 	}

// 	total_tunai = split[1] != undefined ? total_tunai + ',' + split[1] : total_tunai;
// 	return prefix == undefined ? total_tunai : (total_tunai ? 'Rp. ' + total_tunai : '');
// }
