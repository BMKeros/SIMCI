var reglas_formulario_login = {
   on: 'blur',
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
	        	   prompt:'El campo usuario debe contener minimo 5 caracteres'
	        	},
            {
               type:'maxLength[20]',
               prompt:'Elcampo usuario no debe exceder los 20 caracteres'
            }
	     ]
  		},
  		password:{
  			identifier: 'password',
  			rules:[
  				{
  					type:'empty',
	            prompt:'Este campo no debe quedar vacio'
  				},
          {
            type:'minLength[5]',
            prompt:'La contraseña debe contener como minimo 5 caracteres'
          }
  			]
  		}
  	},
   inline: true
};