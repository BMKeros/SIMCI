(function(){
  var simci = angular.module('SIMCI', ['ngRoute','datatables'], function($interpolateProvider) {
          $interpolateProvider.startSymbol('<%');
          $interpolateProvider.endSymbol('%>');
  });

  simci.run(function($rootScope,DTDefaultOptions,ToolsService){
      alertify.success('Ready!');
      //Lenguaje español para datatable
      DTDefaultOptions.setLanguageSource('/spanish.json');

      //Asignar funciones en el scope global
      $rootScope.tools_input = ToolsService.tools_input; 
  });

  simci.filter('capitalize', function() {
    return function(input, all) {
      var reg = (all) ? /([^\W_]+[^\s-]*) */g : /([^\W_]+[^\s-]*)/;
      return (!!input) ? input.replace(reg, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}) : '';
    }
  });

  simci.filter('inArray', function() {
    return function(array, value) {
        return Array.isArray(array) && array.indexOf(value) !== -1;
    };
  });

  simci.factory('ToolsService', [function () {
    return {
      tools_input:{
        //Para convertir el valor de los input en mayuscula
        upper: function(_event){
          var input = angular.element(_event.currentTarget);
          var value_upper = input.val().toUpperCase();
          input.val(value_upper);
        },
        // Esto se tiene que acomodar //
        quitar_caracteres: function(_event,_array_quitar){
          var input = angular.element(_event.currentTarget);
          var val = input.val().toString();
          patron =/[0-9]/;
          if(patron.test(_event.key)){
            val[val.length-1]= '';
          }
          input.val(val);
        },
        cambiar_coma_punto: function(_event){
          var input = angular.element(_event.currentTarget);
          var input_val = input.val().toString();
          var nuevo_val = input_val.replace(/,/,'.');
          input.val(nuevo_val);
        }
        // Esto se tiene que acomodar //
      },
      //Funcion para cortar el string dependiendo del numero de caracteres por parametros
      cut_string: function(string, num_char){
        var infin = ((string.length > num_char)?'....':'');
        return string.substring(0,num_char)+infin;
      },
      loading_button: function(id_button,activado){
        if(activado){
          $('#'+id_button).addClass('loading').prop('disabled',true);
        }
        else{
          $('#'+id_button).removeClass('loading').prop('disabled',false);
        }
      },
      //Funcion para recargar el cache que causa el ng-route
      reload_template_cache: function($ROUTE, $TEMPLATE_CACHE){
        var URLTemplate = $ROUTE.current.loadedTemplateUrl;
        $TEMPLATE_CACHE.remove(URLTemplate); 
      },
      //Funcion para recargar las tablas de datatables
      reload_tabla: function($SCOPE,NOMBRE_TABLA,CALLBACK){
          $SCOPE[NOMBRE_TABLA].reloadData(CALLBACK, false); 
      },
      //Funcion para devolver el mensaje con respecto al codigo http
      get_mensaje_fail_http: function(data_ajax){
        var objeto = {};

        switch(data_ajax.status) {
          case 401:
            objeto = {
                titulo: "Upss, Acceso no autorizado, inicie sesion porfavor. Estado["+data_ajax.status+"]",
                icono: 'ban',
                color: 'red',
                mensajes: data_ajax.data
              };
            break;
          case 403:
              objeto = {
                titulo: "Upss, Hubo un problema con sus permisos. Estado["+data_ajax.status+"]",
                icono: 'ban',
                color: 'red',
                mensajes: data_ajax.data
              };
            break;
          case 500:
              objeto = {
                titulo:"Upss, Ocurrio un error en el servidor. Estado["+data_ajax.status+"]",
                icono: 'remove',
                color: 'red',
                mensajes: data_ajax.data
              };
            break;
        }

        return objeto;
      },
      //Funcion para obtener la data del usuario guardada en el localstorage
      get_data_user_localstorage: function(){
        return JSON.parse(localStorage.getItem('data_usuario'));
      },
      //Funcion para el registro dinamico de todos los controladores
      registrar_dinamico: function($_SCOPE,$_HTTP,$_TIMEOUT,opciones){
        var global_this = this;
            
        return function(){
        
          var formulario = $('#'+opciones.formulario.id);
          var is_valid_form = formulario.form(opciones.formulario.reglas).form('is valid');

          if(is_valid_form){
            
            //Activamos el loading
            global_this.loading_button('btn-registrar',true);    

            $_HTTP({
              method: 'POST',
              url: opciones.url,
              data: $_SCOPE.DatosForm
            }).then(function(data){

              if(data.data.resultado){
                
                $_SCOPE.mostrar_mensaje = true;
                $_SCOPE.mensaje_validacion = {
                  titulo: opciones.exito.titulo,
                  icono: opciones.exito.icono || 'checkmark',
                  color: opciones.exito.color || 'green',
                  mensajes: opciones.exito.mensajes
                };

                $_TIMEOUT(function(){
                  //Desactivamos el loading
                  global_this.loading_button('btn-registrar',false);    
                  formulario.form('clear');
                }, 0, false);

              }
              else{

                $_SCOPE.mostrar_mensaje = true;
                $_SCOPE.mensaje_validacion = {
                  titulo: 'Hubo un error al guardar el formulario',
                  icono: 'remove',
                  color: 'red',
                  mensajes: data.data.mensajes
                };
              }

              //Desactivamos el loading
              global_this.loading_button('btn-registrar',false);

            },function(data_error){
              $_SCOPE.mostrar_mensaje = true;
              $_SCOPE.mensaje_validacion = global_this.get_mensaje_fail_http(data_error);

              //Desactivamos el loading
              global_this.loading_button('btn-registrar',false);
            });
          }
        }
      }
    }
  }]);

  simci.directive("ngModelFile", [function () {
    return {
        scope: {
            ngModelFile: "="
        },
        link: function (scope, element, attributes) {
          element.bind("change", function (changeEvent) {
              var reader = new FileReader();
              reader.onload = function (loadEvent) {
                  scope.$apply(function () {
                      scope.ngModelFile = loadEvent.target.result;
                  });
              }
              reader.readAsDataURL(changeEvent.target.files[0]);
          });
        }
    }
}]);
   
  //Seteamos de manera global la app simci
  window.simci = simci;

  return simci;
})();