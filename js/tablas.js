   $(document).ready(function() {
    $("table.display").DataTable({
    
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
    $("#busqueda_glosario").DataTable({
    
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

    });