$(function() {	
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
        yearRange: '1970:2012' ,
        changeMonth: true,
        changeYear: true
	}); 

	$("#cpf").mask("999.999.999-99");
	$("#numero").numeric();
	$("#profissionalUpdate").validate({
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
			},
			dataNacimento: {
				required: true,
				date: true
			}
			
			// cpf: {cpf: true}
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
			cpf: { cnpj: tagImgErro,
				required: tagImgErro}
		},

		submitHandler:function(form) {
			updateForm(form);
		}
	});
	
	$("#cpf").blur(function(){
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
	
});




function updateForm(form){
	var $button =  $('input[type=submit]', form).attr('disabled', 'disabled');
	var params = $(form.elements).serialize();
	var self = form;
	$.ajax({
		// Usando metodo Post
		type: 'POST',
		// this.action pega o script para onde vai ser enviado os dados
		url: form.action,
		// os dados que pegamos com a função serialize()
		data: params,
		// Antes de enviar
		beforeSend: function(){
			// mostro a div loading
			$('#loading').show();
		},
		success: function(txt){
			if(txt == '1' || txt == '2')
			{
				$("#loading").css('background', '#D3D0D0'); 
				$('#loading').html("Atualizado com sucesso!");
				$('#loading').delay(2500).fadeOut(5000);
			}
			else if(txt == '5' ){
				$("#loading").css('background', '#D3D0D0'); 
				$('#loading').html("Jé existe um usuario com este cpf!");
				$('#loading').delay(1500).fadeOut(5000);
				bordaInputError("#cpf");
				$("#cpf").focus();
				$("#loading").hide();
				
			}
			// Ativo o botão usando a função attr()
			$('input[type=submit]', form).attr('disabled', false);
		},
		// Se acontecer algum erro é executada essa função
		error: function(txt){
			$("#loading").css('background', 'red'); 
			$('#loading').html(txt);
		}
	});
	return false;
}