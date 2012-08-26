$(function() {
	$( "#tabs" ).tabs({
		ajaxOptions: {
			error: function( xhr, status, index, anchor ) {
				$( anchor.hash ).html(
					"Couldn't load this tab. We'll try to fix this as soon as possible. " +
					"If this wouldn't be a demo." );
			},
			success: function(){
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
			}
		}
	});
});



$("#tabs a").click(function () {
	document.title = $(this).html();
});

