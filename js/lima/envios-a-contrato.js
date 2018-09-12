$(document).ready(function(){
  control_de_menu($('#envios-a-contrato'));
  $('#divenvio').hide();
  //get_guias();
});

$('#lima-tipo-envio').on('change',function(){
      var tipo=$('#lima-tipo-envio').val();
      borrarseccciones();
      if(tipo=='022' || tipo=='029'){
        $('#detalle-carga').html('');

        $('#formulario_carga').html('<div class="col-md-12">'+
										                  '<label>Fecha:</label>'+
						                '<div class="input-group date">'+
						                  '<div class="input-group-addon">'+
						                    '<i class="fa fa-calendar"></i>'+
						                  '</div>'+
						                  '<input type="text" class="form-control pull-right datepicker fecha_guias flat" id="fecha-guia-salida" >'+
						               '</div>'+
					                 '</div>');
        getguias($('#fecha-guia-salida').val());
      }
      else if(tipo=='031'){
        //$('#guia_de_salida_detalle').dataTable().fnDestroy();
        $('#detalle-carga').html('');
        $('#formulario_carga').html('<div class="col-md-6">'+
										                '<label>&nbsp</label>'+
						                        '<div class="input-group">'+
						                              '<button class="btn btn-warning" id="btn_cargadesdeexcel" data-toggle="modal" data-target="#cargardesdeexcel">Cargar desde excel</button> '+
      						                   '</div>'+
      					                     '</div>'+
                                     '<div class="col-md-6">'+
                             				 '<label>&nbsp</label>'+
                             				 '<div class="input-group">'+
                             				 '<button class="btn btn-info" id="btn_cargamanual" data-toggle="modal" data-target="#cargamanual">Cargar codigos manualmente</button> '+
                                   	 '</div>'+
                                   	 '</div>'
                                   );
      }
      else{
        $('#formulario_carga').html('');
        $('#guiassalida').html('')
      }

          $('.datepicker').daterangepicker(
          {
            ranges   : {
              'Hoy'       : [moment(), moment()],
              'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Ultimos 7 Dias' : [moment().subtract(6, 'days'), moment()],
              'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
              'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
              'Ultimo Mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(6, 'days'),
            endDate  : moment(),
            locale: {
           format: 'DD/MM/YYYY'
              }
          },
          function (start, end) {
            $('#daterange-btn span').html(start.format('dd/mm/yyyy') + ' - ' + end.format('dd/mm/yyyy'))
          }
        );


});

function borrarseccciones(){
  $('#guiassalida').html('');
  $('#divenvio').hide();
}
function getguias(rango){
  $.ajax({
    url:baseurl+'Guiadesalida/getguias',
    type:'post',
    data:{
      rango:rango,
      seriedoc:$('#lima-tipo-envio').val()
    },
    success:function(data){
      $('#guiassalida').html('<label for="">Guias de salida pendientes: </label><select id="sel_guias" name="selguias" class="form-control"><option>.:Seleccione una guia</option>  </select>');
        var guias=JSON.parse(data);
        $.each(guias,function(i,item){

            $('#sel_guias').append('<option value="'+item.CANUMDOC+'">'+item.CANUMDOC+'</option>');
          });

    }
  });
}

$(document).on('change','#fecha-guia-salida',function(){
  getguias($('#fecha-guia-salida').val());
});

$(document).on('change','#sel_guias',function(){
  $('#divenvio').show();
  $('#guia_de_salida_detalle').dataTable().fnDestroy();
  $('#guia_de_salida_detalle').empty();

  $.ajax({
    url:baseurl+"Guiadesalida/gettabladetalle",
    type:"post",
    async:false,
    data:{
      nguiasalida:$('#sel_guias').val()
    },
    beforesend:function(){
      $('#detalle-carga').html('Cargando tabla...');
    },
    success:function(data){
      $('#detalle-carga').html(data);
      $('table').DataTable();
    }
  });

});



$('#btn_preenvio').on('click',function(e){
  $.ajax({
    url:baseurl+"Guiadesalida/getdatosmodal",
    data:{
      seriedoc:$('#lima-tipo-envio').val(),
      guiasalida:$('#sel_guias').val(),
      tipodoc:"NI"
    },
    type:"post",
    success:function(data){
      $('#modal_body').html(data);
      $('#msg').html('');
    },
    error: function(xhr) { // if error occured
       alert("La sesion ha expirado");
       location.reload();

     }
  });
  $('#modal_resumen').modal('show');
});

$('#btn_confirmar_nota').on('click',function(e){
  $.ajax({
    url:baseurl+"Documento/creardocumentos",
    type:"post",
    data:$('#registro_envio_form').serialize(),
    beforeSend:function(){
      $('#msg').html('<div><h3>Registrando...</h3></div>');
      $('#btn_confirmar_nota').attr('disabled','true');
    },
    success: function(data){
        if(data=='1'){
          $('#msg').html('<div class="callout callout-success"><h4>Registro correcto!</h4><p>Se emitio el documento exitosamente.</p> </div>');
          location.reload();
        }
        else{
          $('#msg').html('<div class="callout callout-danger"><h4>Error!</h4><p>'+data+'</p> </div>');
        }
    },
    error: function (xhr, ajaxOptions, thrownError) {
        $('#msg').html('<div class="callout callout-danger"><h4>'+thrownError+'!</h4><p>'+xhr.responseText+'</p> </div>');
      }
  });
});
$(document).on('click','.eliminar',function(e){
  var id=$(this).attr('data-id');
  $.post(baseurl+'Cargaexcel/eliminar',{id:id},function(data){
    $('#detalle-carga').html(data);
  });
});

//-------------------------- 031-------------------------------------------------------------------

$('#btn_cargaexcel').on('click',function(e){
  var formData = new FormData(document.getElementById("form_envio_excel"));
    formData.append('almacen_salida',$('#almacen_salida').val());
$('.modal.in').modal('hide');
  $.ajax({
      url:baseurl+"Cargaexcel/cargartemporal",
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
          $('#detalle-carga').html(data);
          $('table').DataTable();
        }

  });


});
//------------------------------------carga manual---------------------------------------
$('#btn_agregar_manual').on('click',function(e){
    $.post(baseurl+'Cargaexcel/carga-manual',$('#form_carga_manual').serialize(),function(data){
        $('#detalle-carga').html(data);
        $('#divenvio').show();
        $('.modal.in').modal('hide');
        $('table').DataTable();

    });
});
