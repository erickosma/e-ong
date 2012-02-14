var urlImg ="http://"+window.location.host;
var tagImgErro='<span id="status"> <img src="'+urlImg+'/public/images/geral/erro.jpg" width=15px; height=15px; /></span>';  
$(document).ready(function() {
	$("#dataNacimento").datepicker({
    	dateFormat: 'dd/mm/yy',
    	dayNames: [
    	'Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'
    	],
    	dayNamesMin: [
    	'D','S','T','Q','Q','S','S','D'
    	],
    	dayNamesShort: [
    	'Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'
    	],
    	monthNames: [
    	'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro',
    	'Outubro','Novembro','Dezembro'
    	],
    	monthNamesShort: [
    	'Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set',
    	'Out','Nov','Dez'
    	],
    	nextText: 'Próximo',
    	prevText: 'Anterior'
    	
    });  
    $("#cpf").mask("999.999.999-99");
    $("#profissional").validate({
    	 rules: {
             	nome: {
	            	 	required: true,
	            	 	minlength: 3
	        	 	},
	    	 	sobrenome: {
	             	 	required: true,
	             	 	minlength: 3
	         	 	},
	     	 	login: {
	         	 	required: true,
	         	 	minlength: 4
	         	    }
	     	 	 },	
	     	 	 senha: {
	                 required: true
	             },
	             confirm_senha:{
	                 required: true,
	                 equalTo: "#senha"
	             },
	             email: {
	                    required: true,
	                    email: true
	                },
                 dataNacimento: {
	                    required: true,
	                    date: true
	                },
          },
          messages: {
        	  nome: {required: tagImgErro,
        		  	 minlength: tagImgErro
    		  	 },
    		  	sobrenome: {required: tagImgErro,
        		  	 minlength: tagImgErro
    		  	 },
    		  	login: {required: tagImgErro,
    		  		minlength: tagImgErro
   		  	 	},
    		  	senha: {required: tagImgErro
        		 },
    		  	confirm_senha: {required: tagImgErro,
    		  					equalTo: tagImgErro
   		  	 	},
	   		  	 email: {
	                 required: tagImgErro,
	                 email: tagImgErro
	             },
	             dataNacimento: {
	                 required: tagImgErro,
	                 date: tagImgErro
	             },
          }
          ,submitHandler:function(form) {
        	  processform("#profissional");
          }
	 });
    
});
$(function(){
	$('#estado').change(function(){
		var params="estado="+$(this).val()+"&ajax=true";
		$.ajax({
			type: 'POST',
			url: "/cadastro/cidades",
			data: params,
			success: function(j){
				var options = '<option value="0">--- Selecione---</option>';
				for (var i = 0; i < j.length; i++) {
					options += '<option value="' + j[i].chave + '">' + j[i].nome + '</option>';
				}
				$('#cidade').html(options).show();
			}
			});
		});
});

$("#nome").blur(function(){
	var nome = $("#nome").val();
	if(nome.length > 2)
	{
		removebordaInputError("#nome");
	}
	else{
		bordaInputError("#nome");
	}
});

$("#sobrenome").blur(function(){
	var sobrenome = $("#sobrenome").val();
	if(sobrenome.length > 2)
	{
		removebordaInputError("#sobrenome");
	}
	else{
		bordaInputError("#sobrenome");
	}
});

$("#login").blur(function(){
	var login = $("#login").val();
	if(login.length > 2)
	{
		var params="login="+$("#login").val();
		$.ajax({
			type: 'POST',
			url: "/cadastro/valida-user-name",
			data: params,
			success: function(txt){
				if(txt == '1'){
					removebordaInputError("#login");
				}
				else{
					bordaInputError("#login");
				}
			}
		});
		
	}
	else{
		bordaInputError("#login");
	}
});

$("#email").blur(function(){
	var email = $("#email").val();
		var params="email="+$("#email").val();
		$.ajax({
			type: 'POST',
			url: "/cadastro/valida-email",
			data: params,
			success: function(txt){
				if(txt == '1'){
					removebordaInputError("#email");
				}
				else{
					bordaInputError("#email");
				}
			}
		});
		
	
});

$("#cpf").keyup(function(){
	var cpf = $("#cpf").val();
	var und = cpf.indexOf("_"); //listando underline's da string, que vêm no mask do campo
	if(cpf != 0)
	{
		if(cpf.length == 14 && und == -1)
		{
			if( !validaCPF( $("#cpf").val() ) || $("").val==0 )
			{
				bordaInputError("#cpf");
			}
			else
			{
				removebordaInputError("#cpf");
			}
		}
		else if (und != -1)
		{
			removebordaInputError("#cpf");
		}
	}
});


function processform(id){
 	$(id).submit(function() {
        /**
        Crio a variável $button
        attr(): set a propriedade de um atributo, nesse exemplo foi desativado o botão com a tag button
        */
        var $button = $('submit',this).attr('disabled',true);
        /**
       Criada a variável params
        serialize(): pega os dados inseridos no formulário
        */
        var params = $(this.elements).serialize();

        var self = this;
        $.ajax({
            // Usando metodo Post
            type: 'POST',
            // this.action pega o script para onde vai ser enviado os dados
            url: this.action,
            // os dados que pegamos com a função serialize()
            data: params,
            // Antes de enviar
            beforeSend: function(){
                // mostro a div loading
                $('#loading').show();
                // html(): equivalente ao innerHTML
                $('#loading').html("Aguarde...");
            },
            success: function(txt){
                // Ativo o botão usando a função attr()
                $button.attr('disabled',false);

                // Escrevo a mensagem
                $('#loading').html(txt);
                // Limpo o formulário
                self.reset();
            },
            // Se acontecer algum erro é executada essa função
            error: function(txt){
            	$("#result").css('background', 'red'); 
                $('#result').html(txt);
            }
        })
        return false;
    });
}
