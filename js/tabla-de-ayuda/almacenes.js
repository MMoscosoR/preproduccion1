var tbl_almacenes;


$(document).ready(function(){
	tbl_almacenes=tabla_almacenes();
});


function tabla_almacenes(){
	var tbl_almacenes=$('#tbl_almacenes').DataTable({

	});

	return tbl_almacenes;
}