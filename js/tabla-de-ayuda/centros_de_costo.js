$(document).ready(function(){
	control_de_menu($('#menu_cc'));
	$('#tbl_centroscosto').DataTable({
		dom: 'Bfrtp',
				buttons: [
						{
								text: 'Nueva area',
								className: 'bg-light-blue-active color-palette',
								action: function ( e, dt, node, config ) {
										$('#nuevo_centrocosto').modal('show');

								}
						}

				]
	});

	$('#form_centrocosto').submit(function(e){
		e.preventDefault();
		$.post(baseurl+'Centrocosto/save',$(this).serialize(),function(data){
			if(data.substring(0,2)=='No'){
				alertify.error(data);
			}else{
				alertify.success(data);
				setTimeout(function(){window.location.href=baseurl+"Contrato/centros_de_costo"},200);
			}

		});
	});

	$('.editar-centrocosto').on('click',function(e){
		e.preventDefault();
		$('#idcentrocosto').val($(this).attr('data-id'));
		$('#descripcion').val($(this).attr('data-nombre'));
		$('#nuevo_centrocosto').modal('show');

	});
});
