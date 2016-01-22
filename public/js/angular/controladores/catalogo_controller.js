/// Controlador para catalogo

simci.controller('CatalogoController', ['$scope','$http','$log','$route', '$routeParams', '$location', 
  function ($scope, $http, $log , $route, $routeParams, $location){
    
    $scope.modulo = {};
    $scope.DatosForm = {}; // Objeto para los datos de formulario

    $scope.modulo.nombre = "Catalogo";
    $scope.modulo.icono = {
      tipo: "book",
      color: "orange"
    };
    
    $scope.modulo.opciones = [
      {
        nombre:"registrar objeto",
        descripcion: "Esta opcion le permitira añadir nuevos objetos al catalogo",
        url: "#/catalogo/registrar-objeto"
      },
      {
        nombre:"ver catalogo",
        descripcion: "Esta opcion le permitira ver los objetos del catalogo, a su vez tambien podra modificar o eliminar dichos objetos",
        url: "#/catalogo/mostrar-catalogo"
      },
      
    ];
    
    $log.info($routeParams);
    $log.info($location);

    if($location.$$url == '/catalogo/registrar-objeto'){

      $scope.mostrar_mensaje = false;

        $scope.registrar_objeto = function(){
        
         /* var formulario = $('#formulario_crear_objeto');
          var is_valid_form = formulario.form(reglas_formulario_crear).form('is valid');

          if(is_valid_form){
            
            //Activamos el loading
            $('#btn-registrar').addClass('loading').prop('disabled',true);

            $http({
              method: 'POST',
              url: '/api/catalogo/registrar-objeto',
              data: $scope.DatosForm
            }).then(function(data){

              if(data.data.resultado){
                
                $scope.mostrar_mensaje = true;
                $scope.mensaje_validacion = {
                  titulo: 'Objeto creado con exito',
                  icono: 'checkmark',
                  color: 'green',
                  mensajes: ['El Objeto ha sido agregado al catalogo.']
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
                  titulo: 'Hubo un error al guardar la informacion',
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
            
          } //If condicional*/

          $log.info($scope.DatosForm);
        }
    
      }// If == '/usuarios/crear'
    
  }]
);