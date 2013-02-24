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
		alert(termo.length);
		window.location = "/encontre/termo";
	}
}
