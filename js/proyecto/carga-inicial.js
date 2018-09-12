$(document).ready(function(){
  control_de_menu($('#menu_carga_inicial'));
  $('#btn_abrirmodal').hide();
  $.post(baseurl+"Cargaexcel/listarcarga2",{},function(data){
    $('#tbl_carga').html(data);
    $('table').DataTable();
  });
});
$('#btn_cargaexcel').on('click',function(e){
  var formData = new FormData(document.getElementById("form_cargainicial"));
  $.ajax({
      url:baseurl+"Cargaexcel/cargartemporal",
      type:"post",
      data:formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend:function(){
        $('#tbl_carga').html('<div><h3>Cargando excel....</h3></div>');
      },
      success:function(data){
          $('#tbl_carga').html(data);
          $('table').DataTable();
          $('#btn_abrirmodal').show();
        }

  });


});

$('#btn_preenvio').on('click',function(e){

  $.ajax({
    url:baseurl+"Transaccion/gettransacciones",
    type:"post",
    data:{tipo:"Ingreso"},
    success:function(data){
      $('#form_transaccion').find('option').remove();
      c= JSON.parse(data);
      $.each(c,function(i,item){
        $('#form_transaccion').append('<option value="'+item.transaccionid+'">'+item.codigo+'-'+item.nombre+'</option>');
      });
    }
  });


  $('#modal_resumen').modal('show');
});
//completar correlativo al cambiar valor de seriedoc
$('#form_seriedoc').on('change',function(e){
  $.ajax({
    url:baseurl+"Correlativo/get_correlativo",
    type:"post",
    data:{seriedoc: $('#form_seriedoc').val(),tipodoc:"NI"},
    success:function(data){

        $('#form_numdoc').val($('#form_seriedoc').val()+zfill(data,7));
        $('#form_correlativo').val(data);

    }
  });
});
//funcion para completar co 0 a la izquierda
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


$('#btn_confirmar_nota').on('click',function(e){
  $.ajax({
    url:baseurl+"Documento/creardocumentos",
    type:"post",
    data:$('#registro_carga_form').serialize(),
    beforeSend:function(){
      $('#msg').html('<div><h3>Registrando...,puede tardar hasta 1 minuto</h3></div>');
      $('#btn_confirmar_nota').prop('disabled',true);
    },
    success: function(data){
        if(data=='1'){
          $('#msg').html('<div class="callout callout-success"><h4>Registro correcto!</h4><p>Se emitio el documento exitosamente.</p> </div>');
          location.reload();
        }
        else{
          $('#msg').html('<div class="callout callout-danger"><h4>Error!</h4><p>'+data+'.</p> </div>');
        }
        $('#btn_confirmar_nota').prop('disabled',false);
    },
    error: function (xhr, ajaxOptions, thrownError) {
        $('#msg').html('<div class="callout callout-danger"><h4>'+thrownError+'!</h4><p>Verifique que no exista codigos,o series repetidas,actualize y vuelva a cargar</p> </div>');


      }
  });
});
$(document).on('click','.eliminar',function(e){
  var id=$(this).attr('data-id');
  var seriedoc= $('#sel_seriedoc').val();
  $.post(baseurl+'Cargaexcel/eliminar',{id:id,seriedoc:seriedoc},function(data){
    $('#tbl_carga').html(data);
    $('table').DataTable();
  });

});
