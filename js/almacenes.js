var tbl_almacenes;


$(document).ready(function(){
	tbl_almacenes=tabla_almacenes();

	$('#tbl_almacenes tbody').on('click', 'tr', function () {
        var data = tbl_almacenes.row( this ).data();
        $('tr').removeClass('info');
        $(this).addClass('info');
        $('.btn-editar').removeClass( "disabled" );
        //setear datos al modal
        	$('#txtIdalmacen').val(data.contratoid);

        	$('#txtNombre').val(data.nombre);
        	$('#txtcentrocosto').val(data.centrocosto);
        	$('#txtProvincia').val(data.provincia);
        	$('#txtDireccion').val(data.direccion);
        	$('#txtTelefono').val(data.telefono);
        	$('#txtAdministrador').val(data.administrador);
        	$.ajax({
        	url:baseurl+"Almacenes/get_by_id",
        	type:"post",
        	data:{"almacenid":data.contratoid},
        	success:function(data){
        		var c=JSON.parse(data);

        		$.each(c,function(i,item){
        			$('#textCorreo_para').val(item.correo_para);
        			$('#textCorreo_cc').val(item.correo_cc);
        		});

        	}
        });
        	if(data.estado==0){
        		$('#cbo_estado').bootstrapToggle('off');
        	}

    } );
});

function borrarinputs(){
	$('#txtIdalmacen').val('');
    $('#txtNombre').val('');
    $('#txtcentrocosto').val('');
    $('#txtProvincia').val('');
    $('#txtDireccion').val('');
    $('#txtTelefono').val('');
    $('#txtAdministrador').val('');
    $('#txtAccion').val('');
    $('#textCorreo_para').val('');
    $('#textCorreo_cc').val('');
    $('#cbo_estado').bootstrapToggle('on');
}


function tabla_almacenes(){
	var tbl_almacenes=$('#tbl_almacenes').DataTable({
		dom: 'Bfrtp',
        buttons: [
            {
                text: 'Nuevo',
                className: 'bg-light-blue-active color-palette',
                action: function ( e, dt, node, config ) {
                	borrarinputs();
                	 $('#modal_almacenes').modal('show');
                	 $('#modal_titulo').html('Nuevo Contrato/Almacen');
                	 $('#txtAccion').val('nuevo');
                	 $('.btn-editar').addClass( "disabled" );
              }
            },
            {
                text: 'Editar',
                className:'disabled btn-editar',
                action: function ( e, dt, node, config ) {
                	$('#modal_almacenes').modal('show');
                	$('#modal_titulo').html('Editar Contrato/Almacen');
                	$('#txtAccion').val('editar');
                }
            }

        ],
        "pagin":true,
		'ajax':{
		      "url":baseurl+"Almacenes/get",
		      "type":"POST",
		       dataSrc:''

		},
		'columns':[
			{data:"contratoid"},
			{data:"nombre"},
			{data:"centrocosto"},
			{data:"provincia"},
			{data:"direccion"},
			{data:"telefono"},
			{data:"administrador"},
			{data:"estado"}

		],
		"columnDefs":[
			{
				"targets":[7],
				"data":"estado",
				"render":function(data,type,row){
					if(data==1){
						return '<span class="label label-success">Activo</span>'
					}
					if(data==0){
						return '<span class="label bg-black color-palette">Inactivo</span>'
					}
				}
			}
		]
	});

	return tbl_almacenes;
}



$('#enviar_formulario').on('click',function(e){
	var msgerror='<div class="alert alert-danger alert-dismissible">'+
                			'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                			'<h4><i class="icon fa fa-ban"></i> Error!</h4>'+
                			'Campos vacios'+
              				'</div>';

	if($('#txtNombre').val()!=''){
		if($('#txtcentrocosto').val()!=''){

				$.ajax({
					url:baseurl+"Almacenes/save",
					type:"post",
					data:$('#form_almacen').serialize(),
					beforesend:function(){
						$('#msg-error').html('Grabando...');
					},
					success:function(data){
						if(data==0){
							$('#msg-error').html('<div class="alert alert-danger alert-dismissible">'+
					                			'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
					                			'<h4><i class="icon fa fa-ban"></i> Error!</h4>'+
					                			'No se registro los datos'+
					              				'</div>');
						}
						else{
							$('#tbl_almacenes').dataTable().fnDestroy();
									tbl_almacenes=tabla_almacenes();
									$('#modal_almacenes').modal('hide');
									$('#msg-error').html('');
						}
					}

				});

		}
		else{
			$('#msg-error').html(msgerror);
		}
	}
	else{
		$('#msg-error').html(msgerror);
	}
});
