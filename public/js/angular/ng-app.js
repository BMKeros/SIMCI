(function(){
  var simci = angular.module('SIMCI', ['ngRoute','datatables'], function($interpolateProvider) {
          $interpolateProvider.startSymbol('<%');
          $interpolateProvider.endSymbol('%>');
  });

  simci.filter('capitalize', function() {
    return function(input, all) {
      var reg = (all) ? /([^\W_]+[^\s-]*) */g : /([^\W_]+[^\s-]*)/;
      return (!!input) ? input.replace(reg, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}) : '';
    }
  });

  simci.factory('ToolsService', [function () {
    return {
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
      get_mensaje_http: function(data_ajax){
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
    };
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