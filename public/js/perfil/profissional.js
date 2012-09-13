$(function() {

	marcaDivMenu();
	//$( "#tabs").tabs({ disabled: true });
	/*$( "#tabs" ).tabs({
		ajaxOptions: {
			error: function( xhr, status, index, anchor ) {
				$( anchor.hash ).html(
					"Couldn't load this tab. We'll try to fix this as soon as possible. " +
					"If this wouldn't be a demo." );
			},
			success: function(){
			
			}
		}
	});*/
	
	
});


/*
$("#tabs a").click(function () {
	document.title = $(this).html();
});

*/

function nomePagina(){
	var loc = $(location).attr('href');
	var separado = loc.split("/");
	return separado[4];
}

function marcaDivMenu(){
	switch(nomePagina())
	{
		case "profissional":
			$("#home").addClass("ui-state-active");
			break;
		case "dados-pessoais-profissional":
			$("#dadosPessoaisProfissional").addClass("ui-state-active");
 			break;
		case "imagem":
			$("#imagem").addClass("ui-state-active");
 			break;
	}
}