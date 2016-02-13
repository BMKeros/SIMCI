/// Controlador para catalogo

simci.controller('LaboratorioController', [
  '$scope',
  '$http',
  '$log',
  '$timeout',
  '$route', 
  '$routeParams', 
  '$location',
  'DTOptionsBuilder', 
  'DTColumnBuilder',
  '$compile',
  'ToolsService',
  '$templateCache',
  function ($scope, $http, $log ,$timeout,$route, $routeParams, $location,DTOptionsBuilder,DTColumnBuilder,$compile,ToolsService,$templateCache){
    
    $scope.modulo = {};
    $scope.DatosForm = {}; // Objeto para los datos de formulario
    $scope.data_global_user = ToolsService.get_data_user_localstorage();


    $scope.modulo.nombre = "Laboratorio";
    $scope.modulo.icono = {
      tipo: "lab",
      color: "purple"
    };
    
    $scope.modulo.opciones = [
      {
        nombre:"registrar laboratorio",
        descripcion: "Esta opcion le permitira añadir nuevos laboratorios",
        url: "#/laboratorio/crear-laboratorio",
        icono: 'write',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA]
      },
      
      {
        nombre:"mostrar laboratorio",
        descripcion: "Esta opcion le permitira ver los nuevos laboratorios",
        url: "#/laboratorio/ver/todos",
        icono: 'unhide',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      },


      {
        nombre:"agregar stock",
        descripcion: "Esta opcion le permitira agregar nuevos stock al laboratorios",
        url: "#/laboratorio/registrar-stock",
        icono: 'plus',
        show_in:[TIPO_USER_ROOT]
      },


      {
        nombre:"mostrar stock",
        descripcion: "Esta opcion le permitira ver los nuevos stock y moverlos a nuevos laboratorios",
        url: "#/laboratorio/mostrar-stock",
        icono: 'eye',
        show_in:[TIPO_USER_ROOT]
      },

       {
        nombre:"mover stock",
        descripcion: "Esta opcion le permitira mover los stock del laboratorios y moverlos a nuevos laboratorios",
        url: "#/laboratorio/mover-stock",
        icono: 'external',
        show_in:[TIPO_USER_ROOT]
      }

    ];

    $log.info($routeParams);
    $log.info($location);

    if($location.$$url == '/laboratorio/crear-laboratorio'){
        $scope.mostrar_mensaje = false;
        $scope.DatosForm = {};

        $scope.registrar_laboratorio = function(){
        
          var formulario = $('#formulario_crear_laboratorio');
          var is_valid_form = formulario.form(reglas_formulario_registrar_laboratorio).form('is valid');

          if(is_valid_form){
            
            //Activamos el loading
            ToolsService.loading_button('btn-registrar',true);

            $http({
              method: 'POST',
              url: '/api/laboratorio/registrar-laboratorio',
              data: $scope.DatosForm
            }).then(function(data){

              if(data.data.resultado){
                
                $scope.mostrar_mensaje = true;
                $scope.mensaje_validacion = {
                  titulo: 'Laboratoiro creado con exito',
                  icono: 'checkmark',
                  color: 'green',
                  mensajes: ['Nuevo Laboratorio creado']
                };

                $timeout(function(){
                  //Desactivamos el loading
                  ToolsService.loading_button('btn-registrar',false);
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
              ToolsService.loading_button('btn-registrar',false);

            },function(data_error){

              console.log(data_error);

              //Desactivamos el loading
              ToolsService.loading_button('btn-registrar',false);
            });
            
          } //If condicional
        }
      }// If == '/catalogo/registrar-clase'

  }]
);
    
 