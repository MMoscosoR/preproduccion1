$(document).ready(function(){
  control_de_menu($('#menu_kardex_valorizado'));


  $(document).on('click','#btn_consultar',function(e){
    e.preventDefault();

    $.ajax({
      url:baseurl+'Reporte/costo-almacen',
      type:"post",
      data:$('#form_consulta').serialize(),
      beforeSend:function(){
        $('#reporte').html('Cargando reporte,espere porfavor...');
      },
      success:function(data){
          $('#reporte').html(data);
          $('#valorizado').DataTable({
            dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf'
        ]
          });
      }
    });



  });
});
