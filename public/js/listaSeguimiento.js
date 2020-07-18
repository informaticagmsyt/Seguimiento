




var idioma_espanol = {
    "sProcessing":     "Procesando...",
  "sLengthMenu": 'Mostrar <select>'+
    '<option value="10">10</option>'+
    '<option value="20">20</option>'+
    '<option value="30">30</option>'+
    '<option value="40">40</option>'+
    '<option value="50">50</option>'+
    '<option value="-1">All</option>'+
    '</select> registros',    
  "sZeroRecords":    "No se encontraron resultados",
  "sEmptyTable":     "Ningún dato disponible en esta tabla",
  "sInfo":           "Mostrando del (_START_ al _END_) de un total de _TOTAL_ registros",
  "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
  "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
  "sInfoPostFix":    "",
  "sSearch":         "Filtrar:",
  "sUrl":            "",
  "sInfoThousands":  ",",
  "sLoadingRecords": "Por favor espere - cargando...",
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
  }
  var desde =$("#desde").val()
  var hasta =$("#hasta").val()
  listar(idioma_espanol);
  function listar(idioma_espanol) {
  
  var table= $('#datatablesProyectos').dataTable({
  "language": idioma_espanol,
  "ajax":{
  
  "method":"GET",
  "url":"listaseguimiento/all?desde="+desde+"&hasta="+hasta
  
  },
  "columns":[
  {"data":"id"},
  {"data":"producto"},
  {"data":"origen"},
  {"data":"fuente"},
  
  {"data":"parroquia"},
  {"data":"fecha"},
  {"data":"precio"},
  {"data":"usuario"},


  {"defaultContent":  "   <button type='button' class='btn editar '><i class='ti-pencil-alt'></i></button>"+
  "  "+
  " <button type='button' class='eliminar btn btn-danger'  ><i class='ti-trash'></i></button> "}
  
  ]
  });
  

  $('#datatablesProyectos_wrapper .dataTables_filter input').attr('placeholder', 'Buscar...');
  
  data_editar("#datatablesProyectos tbody",table);
  data_elimiar("#datatablesProyectos tbody",table)
  data_verpdf  ("#datatablesProyectos tbody",table)
  }
  
  
  
  
  function data_editar  (tbody,table){
  var urlbase=""
  
  $(tbody).on("click", "button.editar",function(){
    var id =$(this).parents("tr")[0].children[0].innerText 
    $(".editarSeguimiento"+id).click();
  //var data=table.row($(this).parents("tr") ).data();

  
       
  
  });
  }
  
  
  function data_elimiar (tbody,table){
  var urlbase=""
  
  $(tbody).on("click", "button.eliminar",function(){
  
  //var data=table.row($(this).parents("tr") ).data();
  var id =$(this).parents("tr")[0].children[0].innerText 
 $(".eliminarSeguimiento"+id).click();
  
  });
  }
  
  
  
  function data_verpdf (tbody,table){
  var urlbase=""
  
  $(tbody).on("click", "button.verpdf",function(){
  
  //var data=table.row($(this).parents("tr") ).data();
  var id =$(this).parents("tr")[0].children[0].innerText 
  
  window.location=urlbase+"reportes/pdfproyecto/"+id+"";         
  
  });
  }
  