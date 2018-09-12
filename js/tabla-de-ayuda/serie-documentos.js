$(document).ready(function(){
	control_de_menu($('#menu_serie_documentos'));

});

$('#btn_enviar').on('click',function(e){
	e.preventDefault();
	$.ajax({
		url:baseurl+"Seriedoc/solicitud",
		type:"post",
		data:{
			descripcion:$('#txtDescripcion').val()
		},
		beforeSend:function(){
			$('#msg').html('Enviando...');
		},
		success:function(data){
			if(data=='1'){
				$('#msg').html('<div class="alert alert-success alert-dismissible">'+
												'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
												'<h4><i class="icon fa fa-ban"></i> Se envio la solicitud!</h4>'+
													'El area de sistemas se estara comunicando con usted...'+
													'</div>');

			}
			if(data=='0'){
				$('#msg').html('<div class="alert alert-danger alert-dismissible">'+
                				'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
                				'<h4><i class="icon fa fa-ban"></i> Fallo el envio!</h4>'+
                					'Ocurrio un error durante el envio'+
              						'</div>');
			}
		}
	});
});
