var List = {
	init:function(id, data = null, columns = null, filters_columns = true){
		var id_jquery = '#' + id;
		if (filters_columns) {
			List.initInputsFilters(id_jquery);
		}
		var table = $(id_jquery).DataTable(List.config(data, columns));
		if (filters_columns) {
			List.applyFilter(table);
		}
		document.getElementById(id).style.visibility = 'visible';
		// table.on( 'buttons-action', function ( e, buttonApi, dataTable, node, config ) {
		// 	alert("bton presionado");
		// } );
	},
	config:function(data, columns){
		var  config = {
				responsive: true,
				fixedHeader: true,
				language: {
					"sProcessing":     "Procesando...",
					"sLengthMenu":     "Mostrar _MENU_ registros",
					"sZeroRecords":    "No se encontraron resultados",
					"sEmptyTable":     "Ningún dato disponible en esta tabla",
					"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
					"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
					"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
					"sInfoPostFix":    "",
					"sSearch":         "Buscar:",
					"sUrl":            "",
					"sInfoThousands":  ",",
					"sLoadingRecords": "Cargando...",
					"oPaginate": {
						"sFirst":    "Primero",
						"sLast":     "Último",
						"sNext":     "Siguiente",
						"sPrevious": "Anterior"
					},
					"oAria": {
						"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
						"sSortDescending": ": Activar para ordenar la columna de manera descendente"
					}
				},
				// dom: 'Bflrtip',
				// buttons: [
				// 	{
				// 		extend: 'copy',
				// 		text: 'Copiar',
				// 		className: 'datatable-btn-copy',
				// 		titleAttr: "Copiar al portapales"
				// 	},
				// 	{
				// 		extend: 'excel',
				// 		text: 'Excel',
				// 		className: 'datatable-btn-excel',
				// 		titleAttr: "Copiar a un archivo de Excel"
				// 	},
				// 	{
				// 		extend: 'print',
				// 		text: 'Imprimir',
				// 		className: 'datatable-btn-print',
				// 		titleAttr: "Imprimir"
				// 	},
				// 	{
				// 		extend: 'csv',
				// 		text: 'CSV',
				// 		className: 'datatable-btn-csv',
				// 		titleAttr: "Copiar a un archivo CSV",
				// 		action: function ( e, dt, node, config ) {
				// 			showLoading();
				// 			$.fn.dataTable.ext.buttons.csvHtml5.action.call(this, e, dt, node, config);
				// 			hideLoading();
				// 		}
				// 	},
				// ]
			};
		if(data !== null)
			config['data'] = data;
		if(columns !== null)
			config['columns'] = columns;
		return config;
	},
	initInputsFilters:function(id_jquery){
		$(id_jquery + ' tfoot th').each(function () {
			var item = $(id_jquery + ' thead th').eq($(this).index());
			if (item.data("orderable") != false) {
				var title = item.text();
				$(this).html( '<input type="text" placeholder="' + title + '" />' );
			}
		});
	},
	applyFilter:function(table){
		table.columns().every( function () {
				var column = this;
				$( 'input', this.footer()).on('keyup change', function () {
					column.search(this.value).draw();
				});
			});
	},
	renderResponsiveData(api, rowIdx, columns ){

		return false;
	},
	htmlTable:function(columns){
		var rows = '';
		var length = columns.length;
		for (let index = 0; index < length; index++) {
			const element = columns[index];
			rows += "<tr></tr>";
		}
	}
}
