function listardetalle(serie){

  $.post(baseurl+'Transferencia/listarDetalle',{seriedoc:serie},function(data){
      $('#tbl_detalle').html(data);
      $('table').DataTable({
        searching:false,
        "order": []
      });
  });

}


$(document).ready(function(){
  control_de_menu($('#menu_devolucion_lima'));
  listardetalle($('#sel_seriedoc').val());
  $('.select2').select2({

  });
});

$('#sel_codigo').on('change',function(e){
  $.post(baseurl+'Articulo/getseriesdsponibles',{codigo:$(this).val()},function(data){
    $('#sel_serie').find('option:not(:first)').remove();

    var series=JSON.parse(data);
    $.each(series,function(i,item){
        if(item.seriearticulo!='NULL'){
        $('#sel_serie').append('<option value="'+item.seriearticulo+'">'+item.seriearticulo+'</option>');
        }
      });
  });
  $.post(baseurl+'Articulo/getArticuloFromStkart',{codigo:$(this).val(),seriedoc:$('#sel_seriedoc').val()},function(data2){
        var articulo=JSON.parse(data2);
        $('#descripcion_articulo').html(articulo.descripcion);
        if(articulo.stock!=null && articulo.stock>0){
          $('#stock_disponible').html('Stock disponible:'+articulo.stock);
          $('#stock_disponible').css("color","green");
        }
        else{
          $('#stock_disponible').html('Stock disponible: 0');
          $('#stock_disponible').css("color","red");
        }
  });
});

$('#btn_agregar_codigo').on('click',function(e){
  var seriedocumento = {
  'seriedoc' : $('#sel_seriedoc').val()
};
    $.post(baseurl+'Cargaexcel/carga_temporal_consumo',$('#form_carga_manual').serialize()+ '&' + $.param(seriedocumento),function(data){
        listardetalle($('#sel_seriedoc').val());
        $('.modal.in').modal('hide');
    });
});
$('#sel_seriedoc').on('change',function(e){
  var seriedoc= $('#sel_seriedoc').val();
    listardetalle(seriedoc);
});

$(document).on('click','.eliminar',function(e){
  var id=$(this).attr('data-id');
  var seriedoc= $('#sel_seriedoc').val();
  $.post(baseurl+'Cargaexcel/eliminar',{id:id,seriedoc:seriedoc},function(data){
    listardetalle(seriedoc);
  });

});


$('#btn_confirmar_nota').on('click',function(e){
  var seriedocumento = {
  'nidocid' : $('#sel_seriedoc').val()
};
  $.ajax({
    url:baseurl+"Documento/creardocumentos",
    type:"post",
    data:$('#form_cargainicial').serialize(),
    beforeSend:function(){
      $('#msg').html('<div><h3>Registrando...</h3></div>');
      $('#btn_confirmar_nota').prop('disabled',true);;
    },
    success: function(data){
        if(data=='1'){
          alertify.success('Se emitio el documento exitosamente.');
          listardetalle($('#sel_seriedoc').val());
        }
        else{
          alertify.error(data);
          listardetalle($('#sel_seriedoc').val());
        }
          $('#btn_confirmar_nota').prop('disabled',false);
    },
    error: function (xhr, ajaxOptions, thrownError) {
        $('#msg').html('<div class="callout callout-danger"><h4>'+thrownError+'!</h4><p>Verifique que no exista codigos,o series repetidas.</p> </div>');
        $('#btn_confirmar_nota').prop('disabled',false);
      }
  });
});
