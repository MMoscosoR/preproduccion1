$(document).ready(function(){
	control_de_menu($('#menu_solicitantes'));

	$('#tbl_maquinas').DataTable({
		dom: 'Bfrtp',
				buttons: [
						{
								text: 'Nuevo solicitante',
								className: 'bg-light-blue-active color-palette',
								action: function ( e, dt, node, config ) {
										$('#nuevo_solicitante').modal('show');

								}
						}

				]
	});

	$('#form_solicitante').submit(function(e){
		e.preventDefault();
		$.post(baseurl+'Solicitantes/save',$(this).serialize(),function(data){
			if(data.substring(0,2)=='No'){
				alertify.error(data);
			}else{
				alertify.success(data);
				setTimeout(function(){window.location.href=baseurl+"Contrato/solicitantes"},200);
			}

		});
	});

	$('.editar-solicitante').on('click',function(e){
		e.preventDefault();
		$('#idsolicitante').val($(this).attr('data-id'));
		$('#fullname').val($(this).attr('data-nombre'));
		$('#nuevo_solicitante').modal('show');

	});
});
