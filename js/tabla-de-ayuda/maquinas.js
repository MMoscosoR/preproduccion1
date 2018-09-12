$(document).ready(function(){
	control_de_menu($('#menu_maquinas'));

	$('#tbl_maquinas').DataTable({
		dom: 'Bfrtp',
				buttons: [
						{
								text: 'Nuevo Maquina',
								className: 'bg-light-blue-active color-palette',
								action: function ( e, dt, node, config ) {
										$('#nueva_maquina').modal('show');

								}
						}

				]
	});

	$('#form_maquina').submit(function(e){
		e.preventDefault();
		$.post(baseurl+'Maquinas/save',$(this).serialize(),function(data){
			if(data.substring(0,2)=='No'){
				alertify.error(data);
			}else{
				alertify.success(data);
				setTimeout(function(){window.location.href=baseurl+"Contrato/maquinas"},200);
			}

		});
	});

	$('.editar-maquina').on('click',function(e){
		e.preventDefault();
		$('#idmaquina').val($(this).attr('data-id'));
		$('#maquina').val($(this).attr('data-nombre'));
		$('#nueva_maquina').modal('show');

	});
});
