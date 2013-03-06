   $("#ajuda").validate({
		    	 rules: {
		             	titulo: {
			            	 	required: true,
			            	 	minlength: 3
			        	 	},
			    	 	descricao: {
			             	 	required: true,
			             	 	minlength: 3
			         	 	},
		         	 	estado: {
			         	 	required: true,
			         	    },
		         	   cidade: {
			                 required: true
			             }
		          },
		          messages: {
		        	  titulo: {required: tagImgErro,
		        		  	 minlength: tagImgErro
		    		  	 },
		    		  	descricao: {required: tagImgErro,
		        		  	 minlength: tagImgErro
		    		  	 },
		    		  	estado: {required: tagImgErro,
		    		  		minlength: tagImgErro
		   		  	 	},
		   		  	 	cidade: {required: tagImgErro
		        		 }
		          },
		          submitHandler:function(form) {
		        	  submitFormAjuda(form);
		          }
			 });
   
   
   function submitFormAjuda(form){
	   form.action = "/cadastro/new-ajuda"
	    var $button =  $('input[type=submit]', form).attr('disabled', 'disabled');
	      var params = $(form.elements).serialize();
	      var self = form;
	      $.ajax({
	          type: 'POST',
	          url: form.action,
	          data: params,
	          beforeSend: function(){
	              $('#loading').show();
	          },
	          success: function(txt){
	        	  var cidade =$("#cidade option:selected").text();
	        	  var estado =$("#estado option:selected").text();
	        	  cidade = ucfirst(cidade);
	        	  $('#loading').hide();
	              $('input[type=submit]', form).attr('disabled', false);
	              $("#view-content").html(txt);
	              $("#newEstado").text(estado);
	              $("#newCidade").text(cidade);
	          },
	          error: function(txt){
	           	$("#loading").css('background', 'red'); 
	              $('#loading').html(txt);
	          }
	      })
	      return false;
	}
   
   
   function ucfirst (str) {
	   str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
		    return letter.toUpperCase();
		});
	   return str;
	 }