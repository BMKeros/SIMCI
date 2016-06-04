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
          }
          
        ]
      }
      
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
            {
              type:'maxLength[100]',
              prompt:'Este campo no debe exceder los {ruleValue} caracteres'
            }

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
          },
          {
            type:'maxLength[200]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
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
          },
          {
            type:'maxLength[200]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
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
      cod_clase_objeto:{
        identifier: 'cod_clase_objeto',
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

var reglas_formulario_crear_almacen = {
   on: 'blur',
   duration: 40,
   fields: {
      cod_almacen: {
        identifier: 'cod_almacen',
        rules:[
            {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
           },
       ]
      },
      descripcion_almacen: {
        identifier: 'descripcion',
        rules:[
            {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
           },
           {
              type:'minLength[4]',
              prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
           },
           {
              type:'maxLength[8]',
              prompt:'Este campo debe tener como maximo {ruleValue} caracteres'
           }
       ]
      }
      
    },
   inline: true
};

var reglas_formulario_crear_elemento = {
   on: 'blur',
   duration: 40,
   fields: {
      numero_orden: {
        identifier: 'numero_orden',
        rules:[
            {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
           },
       ]
      },

      objetos_disponibles: {
        identifier: 'objetos_disponibles',
        rules:[
            {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
           },
       ]
      },

      recipientes_disponibles: {
        identifier: 'recipientes_disponibles',
        rules:[
            {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
           }
       ]
      }

    },
   inline: true
};

var reglas_formulario_crear_estante = {
   on: 'blur',
   duration: 40,
   fields: {
      descripcion_estante: {
        identifier: 'descripcion_estante',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'minLength[4]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[8]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      }

    },
   inline: true
};

var reglas_formulario_crear_permiso = {
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
            type:'minLength[4]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[15]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

      descripcion: {
        identifier: 'descripcion',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'minLength[5]',
            prompt:'Este campo debe tener como minimo {ruleValue}'
          },
          {
            type:'maxLength[150]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      }
    },
   inline: true
};

var reglas_formulario_crear_tipo_usuario = {
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
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[15]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

      descripcion: {
        identifier: 'descripcion',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'minLength[5]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[50]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

    },
   inline: true
};

var reglas_formulario_crear_unidad = {
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
            type:'minLength[3]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[50]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

      abreviatura: {
        identifier: 'abreviatura',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'minLength[1]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[10]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

    },
   inline: true
};

var reglas_formulario_crear_clase_objeto = {
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
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[30]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

      descripcion: {
        identifier: 'descripcion',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'minLength[5]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[50]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

    },
   inline: true
};


var reglas_formulario_registrar_laboratorio = {
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
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[40]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

      descripcion: {
        identifier: 'descripcion',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'minLength[5]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[150]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

    },
   inline: true
};


var reglas_formulario_registrar_almacen = {
  on: 'blur',
   duration: 40,
   fields: {
      descripcion: {
        identifier: 'descripcion',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'minLength[5]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[150]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

    },
   inline: true
 };

var reglas_formulario_registrar_sub_dimension = {
  on: 'blur',
   duration: 40,
   fields: {

      codigo: {
        identifier: 'codigo',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          }
        ]
      },

      descripcion: {
        identifier: 'descripcion',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'minLength[5]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[150]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      }

    },
   inline: true
};

var reglas_formulario_registrar_agrupacion = {
  on: 'blur',
   duration: 40,
   fields: {

      codigo: {
        identifier: 'codigo',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'minLength[1]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[3]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

      nombre: {
        identifier: 'nombre',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede estar vacio'

          },
          {
            type:'minLength[5]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[150]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

      descripcion: {
        identifier: 'descripcion',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'minLength[5]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[150]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      }

    },
    inline: true
};

var reglas_formulario_registrar_sub_agrupacion = {
  on: 'blur',
   duration: 40,
   fields: {

      codigo: {
        identifier: 'codigo',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'minLength[1]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[3]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

      nombre: {
        identifier: 'nombre',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede estar vacio'

          },
          {
            type:'minLength[5]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[150]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

      descripcion: {
        identifier: 'descripcion',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'minLength[5]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[150]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      }

    },
    inline: true
};

var reglas_formulario_registrar_elemento = {
  on: 'blur',
   duration: 40,
   fields: {

      cod_dimension: {
        identifier: 'cod_dimension',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          }
        ]
      },
      cod_sub_dimension: {
        identifier: 'cod_sub_dimension',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          }
        ]
      },
      cod_agrupacion: {
        identifier: 'cod_agrupacion',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          }
        ]
      },
      cod_objeto: {
        identifier: 'cod_objeto',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          },
        ]
      },

      numero_orden: {
        identifier: 'numero_orden',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          },
          {
              type:'integer',
              prompt:'Este campo solo debe contener numeros enteros'
          },
        ]
      },
      cantidad_disponible: {
        identifier: 'cantidad_disponible',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          },
          {
              type:'number',
              prompt:'Este campo solo debe contener numeros'
          },
        ]
      }

    },
   inline: true
};

var reglas_formulario_registrar_proveedor = {
  on: 'blur',
   duration: 40,
   fields: {

      razon_social: {
        identifier: 'razon_social',
        rules:[
          {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'minLength[5]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[150]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

      doc_identificacion: {
        identifier: 'doc_identificacion',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede estar vacio'

          },
          {
            type:'minLength[5]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[150]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },


      email: {
        identifier: 'email',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede quedar vacio'
          },
          {
            type:'email',
            prompt:'Introduce una direccion de email valida' 
          },
          {
            type:'minLength[5]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[100]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

      telefono_movil1: {
        identifier: 'telefono_movil1',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede estar vacio'

          },
          {
            type:'number',
            prompt:'Introduce un numero de telefono valido'
          },
          {
            type:'minLength[11]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[15]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

      telefono_fijo1: {
        identifier: 'telefono_fijo1',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede estar vacio'

          },
          {
            type:'number',
            prompt:'Introduce un numero de telefono valido'
          },
          {
            type:'minLength[11]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[15]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      },

      direccion: {
        identifier: 'direccion',
        rules:[
          {
            type:'empty',
            prompt:'Este campo no puede estar vacio'

          },
          {
            type:'minLength[10]',
            prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
          },
          {
            type:'maxLength[100]',
            prompt:'Este campo no debe exceder los {ruleValue} caracteres'
          }
        ]
      }
      
    },
    inline: true
};

var reglas_formulario_agregar_stock = {
   on: 'blur',
   duration: 40,
   fields: {
      select_laboratorio: {
        identifier: 'select_laboratorio',
        rules:[
            {
              type:'empty',
              prompt:'Este campo no puede quedar vacio'
           }
        ]
      },
      select_objeto:{
        identifier: 'select_objeto',
        rules:[
          {
            type:'empty',
              prompt:'Este campo no debe quedar vacio'
          }
        ]
      },

      cantidad:{
        identifier: 'cantidad',
        rules:[
          {
            type:'empty',
              prompt:'Este campo no debe quedar vacio'
          },
          {
            type:'number',
            prompt:'Este campo debe contener solo numeros'
          },
          {
            type   : 'not[0]',
            prompt : 'La cantidad debe ser mayor a cero'
          }
        ]
      }
    },
   inline: true
};

var reglas_formulario_mover_stock = {
    on: 'blur',
    duration: 40,
    fields: {
        select_laboratorio_origen: {
            identifier: 'select_laboratorio_origen',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Este campo no puede quedar vacio'
                }
            ]
        },
        select_laboratorio_destino: {
            identifier: 'select_laboratorio_destino',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Este campo no debe quedar vacio'
                },
                {
                    type: 'different[select_laboratorio_origen]',
                    prompt: 'Este laboratorio debe ser diferente al laboratorio origen'
                }
            ]
        }
    },
    inline: true
};

var reglas_formulario_generar_ordenes = {
    on: 'blur',
    duration: 40,
    fields: {
        select_laboratorio: {
            identifier: 'select_laboratorio',
            rules:[
                {
                    type:'empty',
                    prompt:'Este campo no puede quedar vacio'
                }
            ]
        },
        select_objeto:{
            identifier: 'select_objeto',
            rules:[
                {
                    type:'empty',
                    prompt:'Este campo no debe quedar vacio'
                }
            ]
        },

        cantidad:{
            identifier: 'cantidad',
            rules:[
                {
                    type:'empty',
                    prompt:'Este campo no debe quedar vacio'
                },
                {
                    type:'number',
                    prompt:'Este campo debe contener solo numeros'
                },
                {
                    type   : 'not[0]',
                    prompt : 'La cantidad debe ser mayor a cero'
                }
            ]
        },

        fecha_actividad:{
            identifier: 'fecha_actividad',
            rules:[
                {
                    type:'empty',
                    prompt:'Este campo no debe quedar vacio'
                }
            ]
        },

        observaciones:{
            identifier:'observaciones',
            rules:[
                {
                    type:'empty',
                    prompt:'Este campo no debe de quedar vacio,'

                },
                {
                    type:'minLength[10]',
                    prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
                },
                {
                    type:'maxLength[50]',
                    prompt:'Este campo debe tener como maximo {ruleValue} caracteres'
                }
            ]
        }
    },
    inline: true
};


var reglas_formulario_datos_orden = {
    on: 'blur',
    fields: {
        responsable: {
            identifier: 'responsable',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Este campo no puede quedar vacio'
                }
            ]
        },
        fecha_actividad: {
            identifier: 'fecha_actividad',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Este campo no puede quedar vacio'
                }
            ]
        },
        select_laboratorio: {
            identifier: 'select_laboratorio',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Este campo no puede quedar vacio'
                }
            ]
        },
        observaciones: {
            identifier: 'observaciones',
            rules: [
                {
                    type: 'empty',
                    prompt: 'Este campo no puede quedar vacio'
                },
                {
                    type:'minLength[10]',
                    prompt:'Este campo debe tener como minimo {ruleValue} caracteres'
                },
                {
                    type:'maxLength[200]',
                    prompt:'Este campo debe tener como maximo {ruleValue} caracteres'
                }
            ]
        }
    },
    inline: true,
    //Esta Funcion es para que no se envie el formulario automaticamente
    onSuccess: function (_event) {
        _event.preventDefault();
        _event.stopPropagation();
    }
};

var reglas_formulario_enviar_correo = {};