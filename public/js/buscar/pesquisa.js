$(function() {
	//
	$("#pesquisaTermo").click(function() {
		pesquisa();	
	});

	$("#buscar").keypress(function(e) {
		var code = (e.keyCode ? e.keyCode : e.which);
		if(code == 13) {
	    	pesquisa();	
	        $.print( e );
	    }
	});
	

	$('#ajudaTexarea').jqEasyCounter({
		'maxChars': 500,
		'maxCharsWarning': 450,
		'msgFontSize': '12px',
		'msgFontColor': '#666666',
		'msgTextAlign': 'right',
		'msgWarningColor': '#F00',
		'textOp': ' '
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
