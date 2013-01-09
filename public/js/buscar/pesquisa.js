$(function() {
	//
	$("#pesquisaTermo").click(function() {
		pesquisa();	
	});
});


function pesquisa()
{
	var termo = $("#buscar").val();
	if(termo.length > 0)
	{
		var  params = termo;
		$.ajax({
			type: 'POST',
			url: "/buscar/termo/q/"+termo,
			data: params,
			success: function(txt){
				$("#resultado").html(txt);
			}
		});
	}
}
