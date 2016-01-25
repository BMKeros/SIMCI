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
   duration: 20,
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
            prompt: 'Introduce una direccion email valida'
          }
        ]
      },

      password:{
        identifier: 'password',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede quedar vacio'
          },
          {
            type: 'match[password_confirmacion]',
            prompt: 'Las contraseñas no coinciden'
          },
          {
            type:'minLength[5]',
            prompt:'Es campo debe contener minimo {ruleValue} caracteres'
          },
        ]
      },

      password_confirmacion:{
        identifier: 'password_confirmacion',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede quedar vacio'
          },
        ]
      },

      permisos:{
        identifier: 'permisos',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede quedar vacio'
          },
        ]
      },

      tipo_usuario:{
        identifier: 'tipo_usuario',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede quedar vacio'
          },
        ]
      },

      sexo:{
        identifier: 'sexo',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede quedar vacio'
          },
        ]
      },

      primer_nombre:{
        identifier: 'primer_nombre',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'minLength[3]',
            prompt:'Es campo debe contener minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[15]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          },
          /*{
            type:'regExp[/^[A-Za-z]$/]',
            prompt:'Este campo solo dede tener caracteres alfabeticos'
          },*/
        ]
      },

      primer_apellido:{
        identifier: 'primer_apellido',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'minLength[3]',
            prompt:'Es campo debe contener minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[15]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          },
          /*{
            type:'regExp[/^[A-Za-z]$/]',
            prompt:'Este campo solo dede tener caracteres alfabeticos'
          },*/
        ]
      },

      cedula:{
        identifier: 'cedula',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'maxLength[8]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          },
          {
            type:'number',
            prompt:'Este campo solo puede contener datos numericos'
          },
        ]
      },

      fecha_nacimiento:{
        identifier: 'fecha_nacimiento',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede quedar vacio'
          },
          
        ]
      },
      
    },
   inline: true
};
var reglas_formulario_crear_objeto = {
   on: 'blur',
   duration: 40,
   fields: {
      nombre: {
        identifier: 'nombre',
        rules:[
            {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
           },
           {
               type:'minLength[5]',
               prompt:'Este campo debe contener minimo {ruleValue} caracteres'
            },
       ]
      },
      especificaciones:{
        identifier: 'especificaciones',
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
      },
      descripcion:{
        identifier: 'descripcion',
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
      },
      cod_unidad:{
        identifier: 'cod_unidad',
        rules:[
          {
            type:'empty',
              prompt:'Este campo no debe quedar vacio'
          }
        ]
      },
      cod_tipo_objeto:{
        identifier: 'cod_tipo_objeto',
        rules:[
          {
            type:'empty',
              prompt:'Este campo no debe quedar vacio'
          }
        ]
      }
    },
   inline: true
};