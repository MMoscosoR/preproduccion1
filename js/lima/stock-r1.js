$(document).ready(function(){
  control_de_menu($('#stock-r1'));

  $('#tbl_stockr1').DataTable({
    dom: 'Bfrtip',
      buttons: [
        {
            extend: 'excelHtml5',
            title: 'Stock Almacen R1'
        }
      ]
  });
});
