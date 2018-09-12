$(document).ready(function(){
  control_de_menu($('#menu_cierre_mes'));

});

$('#btn_cierre_mes').on('click',function(e){
    $(this).attr('disabled',true);
    $.ajax({
      url:baseurl+"Cierremes/cierre-mes",
      data:$('#form_cierre').serialize(),
      type:'post',
      beforeSend:function(){
        $('#msg').html('<br><br> <center><img src="http://192.168.1.7/almacenes-virtuales/assets/img/espera.gif"> <h3>Por favor espere a que el proceso termine, no actualize ni cambie de pagina</h3></center><br> ');
      },
      success:function(data){
        $('#btn_cierre_mes').attr('disabled',false);
        $('#msg').html('');
        alertify.warning('Cierre realizado exitosamente');
      }
    });
});
