function getmovimientos(periodo){
  $.post(baseurl+'Documento/movimientos',{periodo:periodo},function(data){
      $('#tbl_stock').html(data);
      $('table').DataTable({
        dom: 'Bfrtip',
        buttons: [

            {
                extend: 'excel',
                title: 'Movimientos '+contrato,
                messageTop: 'Reporte generado:'+current
            },
            {
                extend: 'pdf',
                orientation: 'landscape',
                title: 'Movimientos '+contrato,
                messageTop: 'Reporte generado:'+current
            }

        ]
      });
  });
}


$(document).ready(function(){
  control_de_menu($('#menu_movimientos'));
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
getmovimientos($('#periodo').val());

});

$('#periodo').on('change',function(e){
 getmovimientos($('#periodo').val());
});
