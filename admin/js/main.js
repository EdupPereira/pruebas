$(document).ready(function(){
	if (window.history.replaceState) { // verificamos disponibilidad
		window.history.replaceState(null, null, window.location.href);
	}

	
	$("#tabla_llegada,#tabla_rol,#tabla_area,#tabla_estado,#tabla_persona,#tabla_identidad,#tabla_usuarios,#tabla_glosario,#tabla_directorio").DataTable({
		"language":{
			"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
		},
		responsive:"true",
		dom:"Bfrtilp",
		buttons:[
		{
			extend: 'excelHtml5',
			text:'<i class="bi bi-lg  bi-file-earmark-excel-fill" title="Exportar Excel"></i>',
			title:'Exportar Excel',
			className:'btn btn-success'	
		},
		{
			extend: 'pdfHtml5',
			text:'<i class="bi bi-file-pdf" title="Exportar PDF"></i>',
			title:'Exportar PDF',
			className:'btn btn-danger'	
		},

		]
	});

	$("#tabla_post").DataTable({
		"language":{
			"url":"https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
		},
		responsive:"true",
		dom:"Bfrtilp",
		buttons:[
		{
			extend: 'excelHtml5',
			text:'<i class="bi bi-file-earmark-excel-fill" title="Exportar Excel"></i>',
			title:'Exportar Excel Publicaciones',
			className:'btn btn-success'	
		},
		{
			extend: 'pdfHtml5',
			text:'<i class="bi bi-file-pdf" title="Exportar PDF"></i>',
			title:'Exportar PDF',
			className:'btn btn-danger'	
		},

		]
	});

});
