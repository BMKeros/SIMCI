var reglas_formulario_login = {
   fields: {
      usuario: {
         identifier: 'usuario',
    		rules:[
            {
               type:'empty',
	            prompt:'Este campo no puede quedar vacio, y debe contene entre 5 y 20 caracteres'
	         },
	         {
	        	   type:'minLength[5]',
	        	   prompt:'Elcampo usuario debe contener minimo 5 caracteres'
	        	},
            {
               type:'maxLength[20]',
               prompt:'Elcampo usuario no debe exceder los 20 caracteres'
            }
	     ]
  		},
  		password:{
  			identifier: 'password',
  			ruler:[
  				{
  					type:'empty',
	            prompt:'Este campo no puede quedar vacio, y debe contene entre 5 y 20 caracteres'
  				}
  			]
  		}
  	}
};