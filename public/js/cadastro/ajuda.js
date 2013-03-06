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
			     	 	login: {
			         	 	required: true,
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