$(document).ready(function(e){
  control_de_menu($('#menu_consulta_reporte_sig'));
  $('table').DataTable();

  $('.btn_eliminar').on('click',function(e){
      e.preventDefault();
      let id=$(this).attr("data-id");
      let codigo=$(this).attr("data-codigo");
      let fila=$(this).closest('tr');
      alertify.confirm('Confirmacion', 'Confirme para eliminar el documento: '+codigo,
                      function(){
                         $.post(baseurl+'Reporte/eliminar_reporte_sig',{id:id,codigo:codigo},function(data){
                            if(data==1){
                               alertify.success('Documento eliminado correctamente');
                               fila.hide();
                            }
                            if(data==0){
                              alertify.error('Ocurrio un error,no se elimino el documento');
                            }
                         });
                        },
                      function(){
                         alertify.error('Cancelado')
                       });

  });
});
