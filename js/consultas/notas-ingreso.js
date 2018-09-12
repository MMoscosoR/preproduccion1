function listar_ingresos(serie){
  $.post(baseurl+'Documento/notas_ingreso',{seriedoc:serie},function(data){
      $('#tbl_stock').html(data);
      $('table').DataTable({
        "order": [['0','desc']]
      });
  });

}

$(document).ready(function(){
  control_de_menu($('#menu_nota_ingreso'));
  listar_ingresos($('#serie_doc').val());
});

$('#serie_doc').on('change',function(e){
  listar_ingresos($('#serie_doc').val());
});

function listar_detalle(idnota){
  $.post(baseurl+"Documento/get_detalle_docs/"+idnota+"/consulta",function(data){
    $('#tbl_stock').html(data);
  });
}

$(document).on('click','.verdetalle',function(e){
  e.preventDefault();
  var id=$(this).attr('data-id');

 listar_detalle(id);

});

$(document).on('click','#btn_retroceder',function(e){
   listar_ingresos($('#serie_doc').val());

});







var fila;
$(document).on('click','.eliminar_ni',function(e){
    var id=$(this).attr('data-id');
    fila=$(this).closest('tr');

    $.post(baseurl+'Documento/previo_eliminacion',{seriedoc:$('#serie_doc').val(),tipodoc:'NI',iddoc:id},function(data){
      $('#alert_msg').html(data);
      $('#form_id_movalmcab').val(id);
    });

});

$(document).on('click','#btn_confirmar_eliminacion',function(e){
  $.post(baseurl+'Documento/eliminar',$('#form_eliminar_doc').serialize(),function(data){
      if(data==1){
          fila.hide();
         $('.modal.in').modal('hide');
          alertify.notify('Se eliminaron los documentos', 'success', 5, function(){});
      }
      else{
        alertify.error(data);
      }
  });
});
