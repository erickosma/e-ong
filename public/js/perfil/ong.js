$(function() {

	marcaDivMenu();
});



function nomePagina(){
	var loc = $(location).attr('href');
	var separado = loc.split("/");
	return separado[4];
}

function marcaDivMenu(){
	switch(nomePagina())
	{
		case "ong":
			$("#home").addClass("ui-state-active");
			break;
		case "dados-pessoais-ong":
			$("#dadosPessoaisOng").addClass("ui-state-active");
 			break;
		case "imagem":
			$("#imagem").addClass("ui-state-active");
 			break;
		case "mensagem":
			$("#mensagem").addClass("ui-state-active");
 			break;
		case "email":
			$("#email").addClass("ui-state-active");
 			break;	
		case "dados":
			$("#dados").addClass("ui-state-active");
 			break;	
 		
	}
}