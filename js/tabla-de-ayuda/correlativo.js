var tbl_correlativos='';


$(document).ready(function(){
	control_de_menu($('#menu_correlativos'));
	tbl_correlativos=tabla_correlativos();

	$('#tbl_correlativos tbody').on('click', 'tr', function () {
        var data = tbl_correlativos.row( this ).data();
        $('tr').removeClass('info');
        $(this).addClass('info');
        $('.btn-editar').removeClass( "disabled" );
				$('#correlativo').val(data.correlativo);
				$('.modal-title').html(data.serie_docid+' - '+data.nombre);
				$('#txtSeriedoc').val(data.serie_docid);
				$('#txtTipo').val(data.tipo);

    } );

});

function tabla_correlativos(){
	var tbl=$('#tbl_correlativos').DataTable({
		dom: 'Bfrtp',
				buttons: [
						{
								text: 'Editar',
								className:'disabled btn-editar',
								action: function ( e, dt, node, config ) {
									$('#editar_modal').modal('show');
									/*

									$('#modal_titulo').html('Editar Contrato/Almacen');
									$('#txtAccion').val('editar');
									*/
								}
						}

				],
				"pagin":true,
				"ajax":{
					"url":baseurl+"Correlativo/getall",
					"type":"post",
					dataSrc:''
				},
				"columns":[

					{title:"Series",data:"serie_docid"},
					{title:"Descripcion",data:"nombre"},
					{title:"Tipo",data:"tipo"},
					{title:"Correlativo",data:"correlativo"}
				]

	});
	return tbl;
}

$('#btn_submit').on('click',function(e){
		$.ajax({
			url:baseurl+"Correlativo/save",
			type:"post",
			data:$('#form_correlativo').serialize(),
			success:function(data){
				if(data==1){
					$('#tbl_correlativos').dataTable().fnDestroy();
					tbl_correlativos=tabla_correlativos();
					$('#editar_modal').modal('hide');
					$('#msg').html('');
				}
				else{
					$('#msg').html('<div class="alert alert-danger alert-dismissible">'+
	                				'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+
	                				'<h4><i class="icon fa fa-ban"></i> Error!</h4>'+
	                					data+
	              						'</div>');
				}
			}
		});
});
