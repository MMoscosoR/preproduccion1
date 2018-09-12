$(document).ready(function(){
  control_de_menu($('#menu_kardex_unidad'));
  $('.select2').select2();

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

$('#sel_codigo').on('change',function(e){
    $.post(baseurl+'Articulo/getseriesdsponibles',{codigo:$(this).val()},function(data){
      $('#sel_serie').find('option:not(:first)').remove();

      var series=JSON.parse(data);
      $.each(series,function(i,item){
          if(item.seriearticulo!='NULL'){
          $('#sel_serie').append('<option value="'+item.seriearticulo+'">'+item.seriearticulo+'</option>');
          }
        });
    })
});

$(document).on('click','#btn_consultar',function(e){
  e.preventDefault();

  $.ajax({
    url:baseurl+'Reporte/kardex_unidad',
    type:"post",
    data:$('#form_consulta').serialize(),
    beforeSend:function(){
      $('#reporte').html('Cargando reporte,espere porfavor...');
    },
    success:function(data){
        $('#reporte').html(data);
    }
  });



});


$(document).on('click','#imprimir_kardex',function(e){

  var seriedoc=$('#sel_seriedoc').val();
  var form_codigo=$('#sel_codigo').val();
  var form_seriearticulo=$('#sel_serie').val();
  var form_periodo=$('#fecha-guia-salida').val();

  window.open(baseurl+'Reporte/kardex_unidad_pdf?form_seriedoc='+seriedoc+'&form_codigo='+form_codigo+'&form_seriearticulo='+form_seriearticulo+'&form_periodo='+form_periodo+'');



});


$(document).on('click','#imprimir_kardex_excel',function(e){

  var seriedoc=$('#sel_seriedoc').val();
  var form_codigo=$('#sel_codigo').val();
  var form_seriearticulo=$('#sel_serie').val();
  var form_periodo=$('#fecha-guia-salida').val();

  window.open(baseurl+'Reporte/kardex_unidad_excel?form_seriedoc='+seriedoc+'&form_codigo='+form_codigo+'&form_seriearticulo='+form_seriearticulo+'&form_periodo='+form_periodo+'');



});
