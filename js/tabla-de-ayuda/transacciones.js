var tbl_transacciones;

$('#estado').bootstrapToggle({
      on: 'Activo',
      off: 'Inactivo',
			onstyle:'success',
			offstyle:'default',
			width:100,

    });


$(document).ready(function(){
	control_de_menu($('#menu_transacciones'));
	tbl_transacciones=tbl_transacciones2();

	$('#tbl_transacciones tbody').on('click', 'tr', function () {
        var data = tbl_transacciones.row( this ).data();
        $('tr').removeClass('info');
        $(this).addClass('info');
        $('.btn-editar').removeClass( "disabled" );

        //setear datos al modal
				$('#txtIdtransac').val(data.transaccionid);
				$('#txtCodigo').val(data.codigo);
				$('#txtDescripcion').val(data.nombre);
				$('#sel_tipo').val(data.tipo);
				if(data.estado==1){
					$('#estado').bootstrapToggle('on');
				}
				if(data.estado==0){
					$('#estado').bootstrapToggle('off');
				}

    } );
});

function tbl_transacciones2(){
	var tbl=$('#tbl_transacciones').DataTable({
		dom: 'Bfrtp',
        buttons: [
            {
                text: 'Nuevo',
                className: 'bg-light-blue-active color-palette',
                action: function ( e, dt, node, config ) {
									$('.modal-title').html('Nueva transaccion');
									$('#accion').val('nuevo');
									$('#modal_transaccion').modal('show');
									borrarinputs();
									$('#txtCodigo').removeAttr('readonly');
									$('.btn-editar').addClass( "disabled" );
									/*

                	 $('#modal_almacenes').modal('show');
                	 $('#modal_titulo').html('Nuevo Contrato/Almacen');
                	 $('#txtAccion').val('nuevo');

									 */
              }
            },
            {
                text: 'Editar',
                className:'disabled btn-editar',
                action: function ( e, dt, node, config ) {
									$('.modal-title').html('Editar transaccion');
									$('#accion').val('editar');
									$('#txtCodigo').attr('readonly','');
									$('#modal_transaccion').modal('show');
									/*
                	$('#modal_almacenes').modal('show');
                	$('#modal_titulo').html('Editar Contrato/Almacen');
                	$('#txtAccion').val('editar');
									*/
								}
            }

        ],
        "pagin":true,
				'ajax':{
				      "url":baseurl+"Transaccion/getall",
				      "type":"POST",
				       dataSrc:''

				},
				"columns":[
					{title:"#",data:"transaccionid"},
					{title:"Codigo",data:"codigo"},
					{title:"Descripcion",data:"nombre"},
					{title:"Tipo",data:"tipo"},
          {title:"Localidad",data:"locacion"},
					{title:"Estado",data:"estado"}
				],
				"columnDefs":[
					{
						targets:[5],
						data:"estado",
						render:function(data,type,row){
								if(data=='1'){
									return '<span class="label label-success">Activo</span>'
								}
								if (data=='0') {
									return '<span class="label label-default">Inactivo</span>'
								}
						}
					}
				]
	});
	return tbl;
}
function borrarinputs(){
	$('#txtIdtransac').val('');
	$('#txtCodigo').val('');
	$('#txtDescripcion').val('');
	$('#sel_tipo').val('');
	$('#estado').bootstrapToggle('on');
}
$('#btn_submit').on('click',function(e){
	e.preventDefault();
		$.ajax({
			url:baseurl+"Transaccion/save",
			type:"post",
			data:$('#form_transaccion').serialize(),
			success:function(data){
				if(data=='0'){
					$('#msg').html('<div class="alert alert-danger alert-dismissible">'+
	                				'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
	                				'<h4><i class="icon fa fa-ban"></i> Error!</h4>'+
	                					'No se registro porque ya existe el codigo'+
	              						'</div>');
				}
				else{
					$('#tbl_transacciones').dataTable().fnDestroy();
					tbl_transacciones=tbl_transacciones2();
					$('#modal_transaccion').modal('hide');
					$('#msg').html('');
				}
			}
		});
});
