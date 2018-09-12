$(document).ready(function(){
	control_de_menu($('#menu_maestro_articulo'));
	tabla_maestro_articulos();
});


function tabla_maestro_articulos(){
	$('#tbl_maestro_articulos').DataTable({
		"ordering": false,
		"pagin":true,
		"info": true,
		"filtrer":true,
		"stateSave": true,
		"processing":true,
		"serverSide":true,
		'ajax':{
		      "url":baseurl+"Articulo/get",
		      "type":"POST"


		},
		'columns':[
			{data:"ROW"},
			{data:"ACODIGO"},
			{data:"ADESCRI"},
			{data:"AUNIDAD"},
			{data:"AFAMILIA"},			
			{data:"ACODIGO",
				"orderable": true,
				render:function(data,type,row){
				return '<button onClick="cargarficha(\''+row.ACODIGO+'\')"">Ver ficha</button>';
			}
		  }
		]

	});
}

function prueba(){
	$.ajax({
		url:baseurl+"Articulo/get",
		type:"post",
		success:function(data){
			alert(data)
		}

	});
}

function cargarficha(codigo){
	$('.modal-title').html('Ficha técnica: <strong>'+codigo+'</strong>');
	$.ajax({
		url:baseurl+"Articulo/fichatecnica",
		type:"post",
		data:{
			codigo:codigo
		},
		success:function(data){
			$('#txtFicha').val(data);
		}
	});
	$('#fichatecnica').modal('show');
}
