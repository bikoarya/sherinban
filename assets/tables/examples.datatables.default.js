(function ($) {

	'use strict';

	var datatableInit = function () {

		$('#datatable-dashboard').dataTable({
			columnDefs: [{
				"searchable": false,
				"orderable": false,
				"targets": [0, 6]
			}]
		});

		$('#datatable-report').dataTable({
			columnDefs: [{
				"searchable": false,
				"orderable": false,
				"targets": [0, 4]
			}]
		});

		$('#datatable-assignment').dataTable({
			columnDefs: [{
				"searchable": false,
				"orderable": false,
				"targets": [0, 6]
			}]
		});

		$('#datatable-courses').dataTable({
			columnDefs: [{
				"searchable": false,
				"orderable": false,
				"targets": [0]
			}]
			// "order": [1, "desc"]
		});

		$('#datatable-accounts').dataTable({
			columnDefs: [{
				"searchable": false,
				"orderable": false,
				"targets": [0, 5, 7]
			}]
			// "order": [1, "desc"]
		});

		$('#datatable-students').dataTable({
			columnDefs: [{
				"searchable": false,
				"orderable": false,
				"targets": [0, 5]
			}]
			// "order": [1, "desc"]
		});

		$('#datatable-all-rks').dataTable({
			columnDefs: [{
				"searchable": false,
				"orderable": false,
				"targets": [0, 6]
			}]
			// "order": [1, "desc"]
		});

	};

	$(function () {
		datatableInit();
	});

}).apply(this, [jQuery]);
