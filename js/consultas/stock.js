$(document).ready(function(){
  control_de_menu($('#menu_stock'));

  $.post(baseurl+'Almacenes/get-stock',{seriedoc:$('#serie_doc').val()},function(data){
      $('#tbl_stock').html(data);
      $('table').DataTable({
        dom: 'Bfrtip',
        buttons: [
          {
              extend: 'excelHtml5',
              title: 'Stock '+contrato+' serie-'+$('#serie_doc').val(),
              messageTop: 'Reporte generado:'+current
          },
          {
              extend: 'pdfHtml5',
              title: 'Stock '+contrato+' serie-'+$('#serie_doc').val(),
              messageTop: 'Reporte generado:'+current
          }
        ]
    } );
  });
});

$('#serie_doc').on('change',function(e){
  $.post(baseurl+'Almacenes/get-stock',{seriedoc:$('#serie_doc').val()},function(data){
      $('#tbl_stock').html(data);
      $('table').DataTable({
        dom: 'Bfrtip',
        buttons: [
          {
              extend: 'excelHtml5',
              title: 'Stock '+contrato+' serie-'+$('#serie_doc').val(),
              messageTop: 'Reporte generado:'+current
          },
          {
              extend: 'pdfHtml5',
              title: 'Stock '+contrato+' serie-'+$('#serie_doc').val(),
              messageTop: 'Reporte generado:'+current
          }
        ]
    } );
  });
});
