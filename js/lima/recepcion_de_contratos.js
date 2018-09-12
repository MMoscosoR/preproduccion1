
$(document).ready(function(){
  control_de_menu($('#menu_recepcion_de_contrato'));
  listar_pendientes($('#sel_seriedoc').val());

});

$('#sel_seriedoc').on('change',function(e){
  listar_pendientes($('#sel_seriedoc').val());
});

function listar_pendientes(seriedoc){
  $.post(baseurl+"Documento/get_enviados",{seriedoc:seriedoc},function(data){
    $('#pendientes_por_aprobar').html(data);
  }).fail(function(xhr,status,error){

      $('#pendientes_por_aprobar').html(xhr.responseText);
  });
}

function listar_detalle(idnota){
  $.post(baseurl+"Documento/get_detalle/"+idnota,function(data){
    $('#pendientes_por_aprobar').html(data);
  });
}

$(document).on('click','.verdetalle',function(e){
  e.preventDefault();
  var id=$(this).attr('data-id');
  listar_detalle(id);

});
$(document).on('click','#btn_retroceder',function(e){
   listar_pendientes($('#sel_seriedoc').val());

});

$(document).on('click','#confirmar_nota',function(e){
  var json="";
  var json_total="";
          $("#tbl_detalle tbody tr").each(function () {
            json ="";
            $(this).find("td").each(function () {
            $this=$(this);
                if($this.attr("class")=="item" || $this.attr("class")=="cantidad" ||$this.attr("class")=="cant_recepcionado"){
                  if($this.attr("class")!="cant_recepcionado"){
                    json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';
                  }else{
                    json=json+',"'+$this.attr("class")+'":"'+$this.find("input").val()+'"';
                  }
                }
            });
            obj=JSON.parse('{'+json.substr(1)+'}');
            json_total=json_total+','+JSON.stringify(obj);

        });
          var array_json=JSON.parse('['+json_total.substr(1)+']');
       $.post(baseurl+"Documento/recepcionar_ni",{json_array:array_json,ndoc:$('#doc_ingreso').html()},function(data){
          if(data=='2'){
            $('.msg').html('<div class="callout callout-success"><h4>Exito!</h4><p>Se recepciono correctamente.</p></div>');
          }
          if(data=='3'){
            $('.msg').html('<div class="callout callout-warning"><h4>Observaciones!</h4><p>Se registro el documento pero con diferencias activas,porfavor registrar un informe en el apartado Consultas->Difrencias activas.</p></div>');
          }

        });
});
