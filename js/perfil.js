var tbl_perfiles;

$(document).ready(function(){
	tbl_perfiles= tabla_roles();

	$('#tbl_perfiles tbody').on('click', 'tr', function () {
        var data = tbl_perfiles.row( this ).data();
        $('tr').removeClass('info');
        $(this).addClass('info');
        $('.btn-editar').removeClass( "disabled" );
        //setear datos al modal

        	$('#txtIdperfil').val(data.rolid);
					$('#txtNombre').val(data.rol);
        	$.ajax({
        	url:baseurl+"Perfil/get_accesos",
        	type:"post",
        	data:{"rolid":data.rolid},
        	success:function(data){
						$('.form_accesos').bootstrapToggle('off');

        		var c=JSON.parse(data);

        		$.each(c,function(i,item){
        			$('#'+item.submenuid).bootstrapToggle('on');
        		});

        	}
        });
        	if(data.estado==0){
        		$('#cbo_estado').bootstrapToggle('on');
        	}

    } );


});
$('.form_accesos').bootstrapToggle({
	on:'Si',
	off:'No',
	onstyle:'success',
	offstyle:'default',
});
function tabla_roles(){

	var tbl_perfil=$('#tbl_perfiles').DataTable({
		dom: 'Bfrtp',
        buttons: [
            {
                text: 'Nuevo',
                className: 'bg-light-blue-active color-palette',
                action: function ( e, dt, node, config ) {
                	borrarinputs();
                	$('#modal_perfiles').modal('show');
                	$('#modal_titulo').html('Nuevo perfil');
                	 $('#txtAccion').val('nuevo');
									 $('.form_accesos').bootstrapToggle('off');
                	 $('.btn-editar').addClass( "disabled" );

                }
            },
            {
                text: 'Editar',
                className:'disabled btn-editar',
                action: function ( e, dt, node, config ) {
                	$('#modal_perfiles').modal('show');
                	$('#modal_titulo').html('Editar Perfil');
                	 $('#txtAccion').val('editar');
									 	$('#msg').html('');

                }
            }
            ],
        "pagin":true,
		'ajax':{
		      "url":baseurl+"Perfil/getperfiles",
		      "type":"POST",
		       dataSrc:''

		},
		'columns':[
			{data:"rolid"},
			{data:"rol"},


		]
	});
	return tbl_perfil;
}


function borrarinputs(){
	$('#txtIdperfil').val('');
	$('#txtNombre').val('');
	$('#msg').html('');

}
$('#btn_guardar').on('click',function(e){
	e.preventDefault();
		$.ajax({
			url:baseurl+'Perfil/save',
			type:'post',
			data:$('#accesos').serialize(),
			beforeSend:function(){
					$('#msg').html('Guardando...');
			},
			success:function(data){
				if (data=='1') {
					$('#tbl_perfiles').dataTable().fnDestroy();
							tbl_perfiles=tabla_roles();
							$('#modal_perfiles').modal('hide');
							$('#msg').html('');
				}
				if(data=='10'){
					$('#msg').html('<div class="callout callout-danger">'+
	                			'<h4>Error!</h4>'+
	                			'<p>Existen usuarios utilizando este perfil...</p>'+
	              				'</div>');
					}
				if(data=='0'){
					$('#msg').html('<div class="callout callout-danger">'+
	                			'<h4>Error!</h4>'+
	                			'<p>No se pudo guardar la información</p>'+
	              				'</div>');
					}
				$('.btn-editar').addClass( "disabled" );
			}

		});
});
