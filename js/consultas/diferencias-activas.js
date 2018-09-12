function listar_doc_dif(serie){
  $.post(baseurl+'Documento/diferencias_activas',{seriedoc:serie},function(data){
      $('#tbl_stock').html(data);
      $('table').DataTable();
  });
}
$("#fileevidencias").fileinput({
    showUpload:false,
    maxFileCount: 5

  });

$(document).ready(function(){
  control_de_menu($('#menu_diferencia_activa'));
  listar_doc_dif($('#serie_doc').val());


});
$('#serie_doc').on('change',function(e){
  listar_doc_dif($('#serie_doc').val());
});

function listar_detalle(idnota){
  $.post(baseurl+"Documento/get_detalle_docs/"+idnota+"/diferencia",function(data){
    $('#tbl_stock').html(data);
  });
}

$(document).on('click','.verdetalle',function(e){
  e.preventDefault();
  var id=$(this).attr('data-id');

 listar_detalle(id);

});

$(document).on('click','#btn_retroceder',function(e){
   listar_doc_dif($('#serie_doc').val());

});

$(document).on('click','#btn_registrar_reporte',function(e){
    var formData = new FormData(document.getElementById("form_reporte"));

    $.ajax({
      url:baseurl+"Documento/subir-reporte-diferencia",
      type:"post",
      data:formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend:function(){
          $('#msg').html('<div class="callout callout-info"><h4>Espere!</h4>Registrando y subiendo archivos...</div>');
      },
      success:function(data){
          alertify.success('Reporte registrado exitosamente');
          
          listar_doc_dif($('#serie_doc').val());
          $('#reporte').modal('hide');

          if ($('.modal-backdrop').is(':visible')) {
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
          };
        }

    });

});
