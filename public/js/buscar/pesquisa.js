$(function() {
	//
	$("#pesquisaTermo").click(function() {
		pesquisa();	
	});
});


function pesquisa()
{
	var termo = $("#buscar").val();
	if(termo.length > 3)
	{
		window.location = "/encontre/termo/"+termo;
	}
}
