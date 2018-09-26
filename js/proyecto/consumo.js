$(document).ready(function(){
  control_de_menu($('#menu_consumo'));
  $('.select2').select2({

  });
});
function zfill(number, width) {
    var numberOutput = Math.abs(number); /* Valor absoluto del número */
    var length = number.toString().length; /* Largo del número */
    var zero = "0"; /* String de cero */

    if (width <= length) {
        if (number < 0) {
             return ("-" + numberOutput.toString());
        } else {
             return numberOutput.toString();
        }
    } else {
        if (number < 0) {
            return ("-" + (zero.repeat(width - length)) + numberOutput.toString());
        } else {
            return ((zero.repeat(width - length)) + numberOutput.toString());
        }
    }
}
//buscar series disponibles para el articulos
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
//cambio de serie
$('#sel_serie').on('change',function(e){
  $.post(baseurl+'Articulo/getstockserie',{serie:$(this).val(),seriedoc:$('#sel_seriedoc').val()},function(data2){

        if(data2 != 0){
          $('#stock_disponible').html('Stock disponible:'+data2);
          $('#stock_disponible').css("color","green");
        }
        else{
          $('#stock_disponible').html('Stock disponible: 0');
          $('#stock_disponible').css("color","red");
        }
  });
});


//agregar articulo a gettemporal
$('#btn_agregar_codigo').on('click',function(e){
  var seriedocumento = {
  'seriedoc' : $('#sel_seriedoc').val()
};
    $.post(baseurl+'Cargaexcel/carga_temporal_consumo',$('#form_carga_manual').serialize()+ '&' + $.param(seriedocumento),function(data){
        $('#relacion_consumo').html(data);
        $('.modal.in').modal('hide');
    });
});

$(document).on('click','.eliminar',function(e){
  var id=$(this).attr('data-id');
  var seriedoc= $('#sel_seriedoc').val();
  $.post(baseurl+'Cargaexcel/eliminar',{id:id,seriedoc:seriedoc},function(data){
    $('#relacion_consumo').html(data);
  });

});

$('#sel_seriedoc').on('change',function(e){
  var seriedoc= $('#sel_seriedoc').val();
  $.post(baseurl+'Cargaexcel/listar_consumo',{seriedoc:seriedoc},function(data){
    $('#relacion_consumo').html(data);
  }).fail(function() {
  $('#relacion_consumo').html('<h3>Sin registros</h3>');
});;

  $.ajax({
    url:baseurl+"Correlativo/get_correlativo",
    type:"post",
    data:{seriedoc: $('#sel_seriedoc').val(),tipodoc:"NS"},
    success:function(data2){

        $('#form_numdoc').val($('#sel_seriedoc').val() + zfill(data2,7));
        $('#form_correlativo').val(data2);


    }
  });
});


//---------
$('#btn_confirmar_nota').on('click',function(e){
  var seriedocumento = {
  'nidocid' : $('#sel_seriedoc').val()
};
  $.ajax({
    url:baseurl+"Documento/creardocumentos",
    type:"post",
    data:$('#registro_carga_form').serialize()+ '&' + $.param(seriedocumento),
    beforeSend:function(){
      $('#msg').html('<div><h3>Registrando...</h3></div>');
      $('#btn_confirmar_nota').prop('disabled',true);
    },
    success: function(data){
        if(data=='1'){
          $('#msg').html('<div class="callout callout-success"><h4>Registro correcto!</h4><p>Se emitio el documento exitosamente.</p> </div>');
            location.reload();
        }
        else{
          $('#msg').html('<div class="callout callout-danger"><h4>Error!</h4><p>'+data+'.</p> </div>');
          $('#btn_confirmar_nota').prop('disabled',false);
        }

    },
    error: function (xhr, ajaxOptions, thrownError) {
        $('#msg').html('<div class="callout callout-danger"><h4>'+thrownError+'!</h4><p>Verifique que no exista codigos,o series repetidas.</p> </div>');
      }
  });
});

//----------------carga masiva por excel-----------------------------
$('#btn_cargaexcel').on('click',function(e){
  var formData = new FormData(document.getElementById("form_envio_excel"));
    formData.append('seridoc',$('#sel_seriedoc').val());
$('.modal.in').modal('hide');
  $.ajax({
      url:baseurl+"Consumo/carga_consumo",
      type:"post",
      data:formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend:function(){
          $('#detalle-carga').html('<div><h3>Registrando...</h3></div>');
      },
      success:function(data){
          $('#divenvio').show();
          $('#relacion_consumo').html(data);
          $('table').DataTable();
        }

  });


});
