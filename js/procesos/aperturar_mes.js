$(document).ready(function(){
  control_de_menu($('#menu_apertura_mes'));

});
$(document).on('click','.eliminar_cierre',function(e){
  e.preventDefault();
  var periodo=$(this).attr('data-id');

  $.post(baseurl+'Cierremes/aperturar-mes',{periodo:periodo},function(data){
    alertify.success('Aperturado exitosamente');
    setTimeout(function(){window.location.href = baseurl+"Contrato/aperturar-mes"},1000);
  });
});
