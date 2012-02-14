function validaCNPJ(CNPJ) {

		erro = new String;
	//	if (CNPJ.length < 18) erro += "E' necessarios preencher corretamente o numero do CNPJ! \n\n";
	/*	if ((CNPJ.charAt(2) != ".") || (CNPJ.charAt(6) != ".") || (CNPJ.charAt(10) != "/") || (CNPJ.charAt(15) != "-")){
			if (erro.length == 0) erro += "E' necessarios preencher corretamente o numero do CNPJ! \n\n";
		}
	*/
		//substituir os caracteres que nao sao numeros
		if(document.layers && parseInt(navigator.appVersion) == 4){
			x = CNPJ.substring(0,2);
			x += CNPJ.substring(3,6);
			x += CNPJ.substring(7,10);
			x += CNPJ.substring(11,15);
			x += CNPJ.substring(16,18);
			CNPJ = x;
		} else {
			CNPJ = CNPJ.replace(".","");
			CNPJ = CNPJ.replace(".","");
			CNPJ = CNPJ.replace("-","");
			CNPJ = CNPJ.replace("/","");
		}
		var nonNumbers = /\D/;
		if (nonNumbers.test(CNPJ)) erro += "A verificacao de CNPJ suporta apenas numeros! \n\n";
		var a = [];
		var b = new Number;
		var c = [6,5,4,3,2,9,8,7,6,5,4,3,2];
		for (i=0; i<12; i++){
			a[i] = CNPJ.charAt(i);
			b += a[i] * c[i+1];
		}
		if ((x = b % 11) < 2) { a[12] = 0 } else { a[12] = 11-x }
		b = 0;
		for (y=0; y<13; y++) {
			b += (a[y] * c[y]);
		}
		if ((x = b % 11) < 2) { a[13] = 0; } else { a[13] = 11-x; }
		if ((CNPJ.charAt(12) != a[12]) || (CNPJ.charAt(13) != a[13])){
			//erro +="Digito verificador com problema!";
			return false;
		}

		return true;
	}

function validaCPF(cpf) {
  		cpf = cpf.replace(".","");
		cpf = cpf.replace(".","");
		cpf = cpf.replace("-","");
		cpf = cpf.replace("/","");
        erro = new String;
        if (cpf.length < 11) erro += "Sao necessarios 11 digitos para verificacao do CPF! \n\n";
        var nonNumbers = /\D/;
        if (nonNumbers.test(cpf)) erro += "A verificacao de CPF suporta apenas numeros! \n\n";
        if (cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999"){
        	erro += "Numero de CPF invalido!";
        	return false;
        }
        var a = [];
        var b = new Number;
        var c = 11;
        for (i=0; i<11; i++){
        	a[i] = cpf.charAt(i);
        	if (i < 9) b += (a[i] * --c);
        }
        if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
        b = 0;
        c = 11;
        for (y=0; y<10; y++) b += (a[y] * c--);
        if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }
        if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10])){
        	//   erro +="Digito verificador com problema!";
			return false;
        }
        return true;
}


function bordaInputError(id){
	$("#status").remove();
	$(id).css('border','3px solid #A53A3A');
	$(id).after('<span id="status"> <img src="'+urlImg+'/public/images/geral/erro.jpg" width=15px; height=15px; /></span>');
}
function removebordaInputError(id){
	$("#status").remove();
	$(id).css('border','3px solid #CCCCCC');
	$(id).after('<span id="status"> <img src="'+urlImg+'/public/images/geral/confirm.jpg" width=15px; height=15px; /></span>');
}