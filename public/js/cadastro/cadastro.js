var urlImg ="http://"+window.location.host;
var tagImgErro='<span id="status"> <img src="'+urlImg+'/public/images/geral/erro.jpg" width=15px; height=15px; /></span>';  
$(document).ready(function() {

	if(verificaCampoCpfCnpj()){
		  // $("#cnpj").mask("99.999.999/9999-99");  
		   $("#ong").validate({
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
			                }
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
			             }
		          },
		          
		          submitHandler:function(form) {
		        	  submitFormCadastro(form);
		          }
			 });
	}
	else{
		//$("#cpf").mask("999.999.999-99");
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
			                }
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
			             }
		          },
		          
		          submitHandler:function(form) {
		        	  submitFormCadastro(form);
		          }
			 });
	}
  
    
 
  
    
});
$(function(){
	$('#estado').change(function(){
		var params="estado="+$(this).val()+"&ajax=true";
		$.ajax({
			type: 'POST',
			url: "/cadastro/cidades",
			data: params,
			beforeSend: function(){
				var options = '<option value="0">Aguarde.....</option>';
				$('#cidade').html(options).show();
			},
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
/*
$("#cpf").blur(function(){
	var cpf = $("#cpf").val();
	var und = cpf.indexOf("_"); //listando underline's da string, que v�m no mask do campo
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

$("#cnpj").blur(function(){
	var cnpj = $("#cnpj").val();
	var und = cnpj.indexOf("_"); //listando underline's da string, que v�m no mask do campo
	if(cnpj != 0)
	{
		if(cnpj.length == 18 && und == -1)
		{
			if( !validaCNPJ( $("#cnpj").val() ) )
			{
				bordaInputError("#cnpj");
			}
			else
			{
				removebordaInputError("#cnpj");
			}
		}
		else if (und != -1)
		{
			removebordaInputError("#cnpj");
		}
	}
});


$("#cpf").keyup(function(){
	var cpf = $("#cpf").val();
	var und = cpf.indexOf("_"); //listando underline's da string, que v�m no mask do campo
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
$("#cnpj").keyup(function(){
	var cnpj = $("#cnpj").val();
	var und = cnpj.indexOf("_"); //listando underline's da string, que v�m no mask do campo
	if(cnpj != 0)
	{
		if(cnpj.length == 18 && und == -1)
		{
			if( !validaCNPJ( $("#cnpj").val() ) )
			{
				bordaInputError("#cnpj");
			}
			else
			{
				removebordaInputError("#cnpj");
			}
		}
		else if (und != -1)
		{
			removebordaInputError("#cnpj");
		}
	}
});
*/

function verificaCampoCpfCnpj(){
	if($("#campo_oculto").val() == "1"){
		return true;
	}
	else {
		return false;
	}
}

function submitFormCadastro(form){
	  var $button =  $('input[type=submit]', form).attr('disabled', 'disabled');
      var params = $(form.elements).serialize();
      var self = form;
      $.ajax({
          // Usando metodo Post
          type: 'POST',
          // this.action pega o script para onde vai ser enviado os dados
          url: form.action,
          // os dados que pegamos com a fun��o serialize()
          data: params,
          // Antes de enviar
          beforeSend: function(){
              // mostro a div loading
              $('#loading').show();
          },
          success: function(txt){
              // Ativo o bot�o usando a fun��o attr()
        	  if(txt == '1' || txt == '2'){
              	$('#loading').hide();
                 window.location='/perfil/welcome';
              }
              else if(txt == '3' ){
            	  $("#loading").css('background', '#D3D0D0'); 
              	  $('#loading').html("J� existe um usuario com este email!");
              	  $('#loading').delay(1500).fadeOut(5000);
              	  bordaInputError("#email");
              }
              else if(txt == '4' ){
            	  $("#loading").css('background', '#D3D0D0'); 
              	  $('#loading').html("J� existe um usuario com este login!");
              	  $('#loading').delay(1500).fadeOut(5000);
              	  bordaInputError("#login");
              }
              else if(txt == '5' ){
            	  $("#loading").css('background', '#D3D0D0'); 
            	  $('#loading').html("J� existe um usuario com este cpf!");
                  $('#loading').delay(1500).fadeOut(5000);
              	  bordaInputError("#cpf");
              }
        	  $('input[type=submit]', form).attr('disabled', false);
                
          },
          // Se acontecer algum erro � executada essa fun��o
          error: function(txt){
           	$("#loading").css('background', 'red'); 
              $('#loading').html(txt);
          }
      })
      return false;
}
