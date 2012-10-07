function atualizaDados(id)
{
	var params = getParam(id);
	
	if(params != false){
		$.ajax({
			type: 'POST',
			url: "update-dados-confidenciais",
			data: params,
			dataType: "json",
			beforeSend: function(){
				$('#loading').show();
			},
			success: function(txt){
				if(txt == '1')
				{
					$("#loading").css('background', '#D3D0D0'); 
					$('#loading').html("Dados confidenciais atualizados com sucesso!");
				}
				else
				{
					$("#loading").css('background', '#D30F0F'); 
					$('#loading').html("Ops!<br>Ocorreu algum erro tente mais tarde");
					$("#"+id).attr('checked', false);
				}
				$('#loading').delay(2500).fadeOut(5000);
			},
			error: function(txt){
				$("#loading").css('background', 'red'); 
				$('#loading').html(txt);
			}
		});
	}
}	

function getParam(id)
{
	var valor = $("#"+id).val();
	if(valor != undefined)
	{
		//check
		if($("#"+id+":checked").val() != undefined) 
		{	
			valor=1;
		}
		else
		{
			valor=2;
		}
		return id+"="+valor;
	}
	else
	{
		return false;
	}
}
