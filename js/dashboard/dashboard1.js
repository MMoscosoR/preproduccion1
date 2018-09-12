var graficocantidades,graficocostos;

$(document).ready(function(){
  control_de_menu($('#menu_dashboard'));

  graficocantidades=Morris.Bar({
  element: 'pormovimientos',
  data: data,
  xkey: 'descripcion',
  ykeys: ['cantidad'],
  labels: ['total movimientos'],
  resize:true,
  axes:'y'
});

graficocostos=Morris.Bar({
element: 'porcostos',
data: data2,
xkey: 'descripcion',
ykeys: ['cantidad'],
labels: ['Valor(S/.)'],
resize:true,
axes:'y'
});

graficocantidades.redraw();
graficocostos.redraw();

$(document).on('click','.cambiodegrafica',function(e){
  graficocantidades.redraw();
  graficocostos.redraw();
});

});
