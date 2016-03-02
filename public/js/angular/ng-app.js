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
      },
      //Funcion para formatear string
      printf: function(formato){
        var args = Array.prototype.slice.call(arguments,1);
        return formato.replace(/{(\d+)}/g, function(match, number) { 
          return typeof args[number] != 'undefined'? args[number] : match;
        });
      },
      //Funcion para cortar el string dependiendo del numero de caracteres por parametros
      cut_string: function(string, num_char){
        var infin = ((string.length > num_char)?'....':'');
        return string.substring(0,num_char)+infin;
      },
      //Funcion para quitar decimales si son ceros
      quitar_ceros_decimales: function(numero){
        var num_split_punto = numero.split('.');
        var decimal = Number(num_split_punto[1]);
        
        return (decimal !== NaN && decimal === 0)?(num_split_punto[0]):(numero);
      },
      //Funcion para mostrar el loading
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
      //Funcion para generar un alertify un mensaje dependiendo del status
      generar_alerta_status: function(data){
        var mensaje = "";
        mensaje = this.printf('Ha ocurrido un error al realizar la operacion. Estado[{0}]',data.status);
        alertify.error(mensaje);
      },
      //Funcion para obtener la data del usuario guardada en el localstorage
      get_data_user_localstorage: function(){
        return JSON.parse(localStorage.getItem('data_usuario'));
      },
      //Funcion para generar el codigo de los elementos del alamacen
      generar_codigo_elemento: function(obj_codigos, tipo){
        if(tipo.toLowerCase() === 'label'){
          var tmp = '';
            tmp += '<div class="ui small green label spopup" data-content="Dimension">'+obj_codigos.cod_dimension+'</div>';
            tmp += '<div class="ui small blue label spopup" data-content="SubDimension">'+obj_codigos.cod_subdimension+'</div>';
            tmp += '<div class="ui small teal  label spopup" data-content="Agrupacion">'+obj_codigos.cod_agrupacion+'</div>';
            if(obj_codigos.cod_subagrupacion){
              tmp += '<div class="ui small red label spopup" data-content="SubAgrupacion">'+obj_codigos.cod_subagrupacion+'</div>';
            }
            tmp += '<div class="ui small gray label spopup" data-content="Numero de orden">'+obj_codigos.numero_orden+'</div>';

            return tmp;
        }
      },
      //Funcion para mostrar modal dinamico
      mostrar_modal_dinamico: function($_SCOPE, $_HTTP,opciones){
          
        $_HTTP({
          method: 'GET',
          url: opciones.url
        }).then(function(data){

          $_SCOPE[opciones.scope_data_save_success] = data.data;
          
          //Mostramos la modal
          setTimeout(function(){
            angular.element('#'+opciones.id_modal).modal('show');
          },100);

        },function(data_error){
          //$log.info(data_error);
          alertify.error("Upss, ha ocurrido un error inesperado");
        });
        
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

  simci.directive('ngUpdateHidden', [function () {
    return {
      restrict: 'AE', //attribute or element
      scope: {},
      replace: true,
      require: 'ngModel',
      link: function ($scope, elemento, attr, ngModel) {
          $scope.$watch(ngModel, function (nuevo_val) {
              elemento.val(nuevo_val);
          });
          elemento.change(function () { //bind the change event to hidden input
              $scope.$apply(function () {
                  ngModel.$setViewValue(elemento.val());
              });
          });
      }
    };
  }]);

  //Seteamos de manera global la app simci
  window.simci = simci;

  return simci;
})();