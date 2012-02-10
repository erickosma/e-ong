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
    
});
$(function(){
	$('#estado').change(function(){
		params="estado="+$(this).val()+"&ajax=true";
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


$("#cpf").keyup(function(){
	var cpf = $("#cpf").val();
	var und = cpf.indexOf("_"); //listando underline's da string, que vêm no mask do campo
	if(cpf != 0)
	{
		if(cpf.length == 14 && und == -1)
		{
			if( !validaCPF( $("#cpf").val() ) || $("").val==0 )
			{
				$("#status").remove();
				bordaInput("#cpf");
				$("#cpf").after('<span id="status"> <img src="../public/images/geral/erro.jpg" width=15px; height=15px; /></span>');
			}
			else
			{
				removebordaInput("#cpf");
				$("#status").remove();
				$("#cpf").after('<span id="status"> <img src="../public/images/geral/confirm.jpg" width=15px; height=15px; /></span>');
			}
		}
		else if (und != -1)
		{
			removebordaInput("#cpf");
			$("#status").remove();
		}
	}
});