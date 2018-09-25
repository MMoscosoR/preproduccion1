$(document).ready(function(){
  var item3=1;
  control_de_menu($('#menu_reporte-sig'));
  $('.select2').select2();

  $('#btn_importar').on('click',function(e){
    alertify.confirm('Reporte de salida para el SIG', 'Confirmar importacíon',
                  function(){
                    let valecargado=$('#sel_vales').val();
                    let documentosreferencia=$('#txt_docref').val()+' - '+valecargado.substring(6);
                      if(documentosreferencia.substring(1,2)=='-'){
                        documentosreferencia=documentosreferencia.substring(3);
                      }
                    $('#txt_docref').val(documentosreferencia);
                    $.ajax({
                      url:baseurl+'Reporte/detalles-por-vale',
                      type:"post",
                      data:{vale:$('#sel_vales').val()},
                      beforeSend:function(){

                      },
                      success:function(data){
                          detalles=JSON.parse(data);
                          $.each(detalles,function(i,item){
                            if(item.serie=='NULL'){
                              item.serie='';
                            }
                            $('#tbl_detalle').append('<tr>'+
                                                        '<td class="item">'+(item3)+'</td>'+
                                                        '<td class="codigo">'+item.codigo+'</td>'+
                                                        '<td class="descripcion">'+item.descripcion+'</td>'+
                                                        '<td class="unidad">'+item.unidad+'</td>'+
                                                        '<td class="serie">'+item.serie+'</td>'+
                                                        '<td class="cantidad">'+item.cantidad+'</td>'+
                                                        '<td class="maquina">'+item.maquina+'</td>'+
                                                        '<td class="seriedocid">'+item.seriedocid+'</td>'
                                );
                              item3=item3+1;
                          });
                          alertify.success('Vale '+valecargado.substring(5)+ ' cargado');
                      }
                    });
                   },
                   function(){
                      alertify.error('Cancelado')
                  });
  });

  $('#btn_borrar').on('click',function(e){
    alertify.confirm('Reporte de salida para el SIG', 'Confirmar para limpiar tabla de detalles',
                      function(){
                        item3=1;
                          $("#tbl_detalle tbody tr").remove();
                          $('#txt_docref').val('');
                         alertify.success('Tabla limpiada');
                        },
                      function(){
                        alertify.error('Cancelado');
                      });
  });

  $(document).on('click','#btn_guardar',function(e){
    $('#form_reportesig').submit(function(ev){
      ev.preventDefault();
      alertify.confirm('Reporte de salida para el SIG', 'Confirmar para guardar',
                      function(){
                          //capturar datos de la Tabla
                          var json="";
                          var json_total="";
                                  $("#tbl_detalle tbody tr").each(function () {
                                    json ="";
                                    $(this).find("td").each(function () {
                                          $this=$(this);
                                          if($this.attr("class")!='descripcion'){
                                            json=json+',"'+$this.attr("class")+'":"'+$this.html()+'"';
                                          }




                                    });
                                    obj=JSON.parse('{'+json.substr(1)+'}');
                                    json_total=json_total+','+JSON.stringify(obj);

                                });

                          var array_json=JSON.parse('['+json_total.substr(1)+']');

                          //fin

                         $.ajax({
                           url:baseurl+"Reporte/guardar-formato-sig",
                           type:"post",
                           data:$('#form_reportesig').serialize()+ "&tbldetalle=" + JSON.stringify(array_json),
                           beforeSend:function(){
                             $('#btn_guardar').prop('disabled',true);
                           },
                           success: function(data){
                                alertify.success(data);
                               setTimeout(function(){location.reload();},300);
                           },
                           error: function (xhr, ajaxOptions, thrownError) {

                                alertify.error('Ocurrio un error');

                             }
                         });

                        },
                      function(){
                        alertify.error('Cancelado');
                       });
    });

  });
});
