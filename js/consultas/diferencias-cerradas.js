function listar_doc_dif(serie){
  $.post(baseurl+'Documento/diferencias_cerradas',{seriedoc:serie},function(data){
      $('#tbl_stock').html(data);
      $('table').DataTable();
  });
}


$(document).ready(function(){
  control_de_menu($('#menu_diferencia_cerrada'));
  listar_doc_dif($('#serie_doc').val());
});



$('#serie_doc').on('change',function(e){
  listar_doc_dif($('#serie_doc').val());
});

function listar_detalle(idnota){
  $.post(baseurl+"Documento/get_detalle_docs/"+idnota+"/cerrada",function(data){
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

$(document).on('click','#mostrar_reporte',function(e){
  var idcabecera=$(this).attr('data-id');

  $.post(baseurl+'Documento/detalle-reporte',{idcabecera:idcabecera},function(data){
    $('#resumen').html(data);
    $('#detalle-reporte').modal('show');
  });
});
