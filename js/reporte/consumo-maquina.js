function listarreporte(maquina,periodo){
    $.ajax({
      url:baseurl+'Reporte/listarConsumos',
      type:"post",
      data:{filtro:maquina,periodo:periodo,campo:'maquina'},
      beforeSend:function(){
        $('#tbl_reporte').html('Cargando reporte,espere porfavor...');
      },
      success:function(data){
          $('#tbl_reporte').html(data);
          $('#relacion_reporte').DataTable({
              dom: 'Bfrtip',
              buttons: [

                  {
                      extend: 'excel',
                      title: 'Consumos de la maquina: '+ maquina +'Periodo: '+periodo

                  },
                  {
                      extend: 'pdf',
                      orientation: 'landscape',
                      title: 'Consumos de la maquina: '+ maquina +'Periodo: '+periodo

                  }

              ]

          });
      }
    });

}


$(document).ready(function(){
  control_de_menu($('#menu_consumo_maquina'));
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
let filtro=$('#filtro').val();
let periodo=$('#periodo').val();
listarreporte(filtro,periodo);


});


$(document).on('change','.form_consumo',function(e){
  let filtro=$('#filtro').val();
  let periodo=$('#periodo').val();
  listarreporte(filtro,periodo);

});
