var table;
var linkpembelian = $('#transpembelian').attr("data-link");
var tablepembelian;
$(document).ready(function () {

	// start transaksi
	
	tablepembelian = $("#transpembelian").DataTable({
		"dom": 'Bfrtip',
        "buttons": [
            'colvis'
		],
		"language": {
			"search": "Pencarian:",
			"lengthMenu": "Tampilkan _MENU_ baris",
			"zeroRecords": "Belum Ada Data",
			"info": "Halaman _PAGE_ dari _PAGES_",
			"infoFiltered": "(pencarian dari _MAX_ data)"
			},
			"responsive": true,
		"stateSave": true,
		"searching": false,
		"ordering": false,
		"processing": true,
		"serverSide": true,
		// "order": [],
	
		"ajax": {
			"url": linkpembelian,
			"type": "POST"
		},
	
		"columnDefs": [{
			"targets": [0],
		  "orderable": false,
		}, ]
	});


	$('#transjual').DataTable({
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": false,
		"autoWidth": true,
		"paging": false,
		"scrollY": "200px",
		"scrollCollapse": true,
		"bInfo": false
	});
	$('#woi').DataTable({
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": true,
		"autoWidth": true,
		"paging": false,
		"scrollCollapse": true
	});
	$('#cariPenjualan2').DataTable({
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": true,
		"autoWidth": true,
		"paging": false,
	});
	// end transaksi
	$("#example1").DataTable({
		"lengthChange": false,
		"searching": true,
		"ordering": false,
		"info": true,
		"autoWidth": false
	});
	$('#example2').DataTable({
		"lengthChange": false,
		"searching": false,
		"ordering": true,
		"info": true,
		"autoWidth": false
	});


	// start datatables laporan
	$('#lapbeli').DataTable({
		"lengthChange": false,
		"searching": false,
		"paging": true,
		"ordering": false,
		"info": true,
		"autoWidth": false
	});
	$('#lapjual').DataTable({
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": true,
		"autoWidth": false
	});
	$('#lapaktif').DataTable({
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": true,
		"autoWidth": false
	});
	$('#lapstok').DataTable({
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": true,
		"autoWidth": false
	});
	$('#lapbayar').DataTable({
		"lengthChange": false,
		"searching": false,
		"ordering": false,
		"info": true,
		"autoWidth": false
	});
	// end datatables laporan


	// serverside
	const linktable = $('#table').attr("data-link");
	table = $('#table').DataTable({
		"processing": true,
		"serverSide": true,
		"order": [],
		"ajax": {
			"url": linktable,
			"type": "POST"
		},

		"columnDefs": [{
			"targets": [0],
			"orderable": false,
		}, ],
	});
	// end serverside
});
