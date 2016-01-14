var reglas_formulario_login = {
   on: 'blur',
   duration: 40,
   fields: {
      usuario: {
        identifier: 'usuario',
    		rules:[
            {
              type:'empty',
	            prompt:'Este campo no puede quedar vacio'
	         },
	         {
	        	   type:'minLength[5]',
	        	   prompt:'Este campo debe contener minimo {ruleValue} caracteres'
	        	},
            {
               type:'maxLength[20]',
               prompt:'Este campo no debe exceder los {ruleValue} caracteres'
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
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          }
  			]
  		}
  	},
   inline: true
};


var reglas_formulario_crear_usuario = {
  on: 'blur',
   duration: 40,
   fields: {
      usuario: {
        identifier: 'usuario',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'minLength[5]',
            prompt:'Es campo debe contener minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[20]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
       ]
      },

      email:{
        identifier: 'email',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede quedar vacio'
          },
          {
            type: 'email',
            prompt: ''
          }
        ]
      }
      
    },
   inline: true
};

