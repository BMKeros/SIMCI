/// Controlador para reportes

simci.controller('ReportesController', [
  '$scope',
  '$http',
  '$log',
  '$timeout',
  '$route', 
  '$routeParams', 
  '$location',
  '$compile',
  'DTOptionsBuilder', 
  'DTColumnBuilder',
  'ToolsService',
  function ($scope, $http, $log ,$timeout, $route, $routeParams, $location, $compile,DTOptionsBuilder, DTColumnBuilder,ToolsService){
    $scope.modulo = {};

    $scope.DatosForm = {}; // Objeto para los datos de formulario

    $scope.modulo.nombre = "Reportes";
    $scope.modulo.icono = {
      tipo: "users",
      color: "blue"
    };

    $scope.modulo.opciones = [
      
    ];
    
    $log.info($routeParams);
    $log.info($location);

    if($location.$$url == ''){
        
        $scope.mostrar_mensaje = false;

        $scope.registrar_usuario = function(){
        
          var formulario = $('#formulario_crear_usuario');
          var is_valid_form = formulario.form(reglas_formulario_crear_usuario).form('is valid');

          if(is_valid_form){
            
            //Activamos el loading
            $('#btn-registrar').addClass('loading').prop('disabled',true);

            $http({
              method: 'POST',
              url: '/api/usuarios/crear-usuario-completo',
              data: $scope.DatosForm
            }).then(function(data){

              if(data.data.resultado){
                
                $scope.mostrar_mensaje = true;
                $scope.mensaje_validacion = {
                  titulo: 'Usuario creado con exito',
                  icono: 'checkmark',
                  color: 'green',
                  mensajes: ['El usuario ha sido almacenado en la base de datos.']
                };

                $timeout(function(){
                  //Desactivamos el loading
                  $('#btn-registrar').removeClass('loading').prop('disabled',false);
                  formulario.form('clear');
                }, 0, false);

              }
              else{

                $scope.mostrar_mensaje = true;
                $scope.mensaje_validacion = {
                  titulo: 'Hubo un error al guardar el formulario',
                  icono: 'remove',
                  color: 'red',
                  mensajes: data.data.mensajes
                };
              }

              //Desactivamos el loading
              $('#btn-registrar').removeClass('loading').prop('disabled',false);

            },function(data_error){

              console.log(data_error);

              //Desactivamos el loading
              $('#btn-registrar').removeClass('loading').prop('disabled',false);
            });
            
          } //If condicional
        }
    
    }// If == '/usuarios/crear'
  }

]);