$( document ).ready(function() {
  var usuario=$(this).val();
  $.ajax({
    type:"post",
    data:{usuario:usuario},
    url:base_url+"Contrato/get",
    success:function(data){
          $('#contratos').find('option').remove();
      var c=JSON.parse(data);

    $.each(c,function(i,item){
      $('#contratos').append('<option value="'+item.contratoid+'">'+item.nombre+'</option>')
    })
    }
  });
});

$('#txtUsuario').on('change',function(e){
  var usuario=$(this).val();
  $.ajax({
    type:"post",
    data:{usuario:usuario},
    url:base_url+"Contrato/get",
    success:function(data){
          $('#contratos').find('option').remove();
      var c=JSON.parse(data);

    $.each(c,function(i,item){
      $('#contratos').append('<option value="'+item.contratoid+'">'+item.nombre+'</option>')
    })
    }
  });
});

$('#ingresar').click(function(e){
	//var contrato=$('#contratos option:selected').text().replace(' ','-');
	$.ajax({
		type:"post",
		url:base_url+"Login/validacion",
		data:$('#form-login').serialize(),
		success:function(data){
			if(data=='1'){
				window.location=(base_url)+"Contrato";
			}
			else{
				$('#msg').html(data);
			}

		}
	});
});
