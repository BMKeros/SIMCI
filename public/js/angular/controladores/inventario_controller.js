/// Controlador para inventario

simci.controller('InventarioController', [
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

    $scope.modulo.nombre = "Inventario";
    $scope.modulo.icono = {
      tipo: "archive",
      color: "green"
    };
    
    $scope.modulo.opciones = [
      {
        nombre:"registrar elemento",
        descripcion: "Esta opcion le permitira registrar nuevos elementos en el inventario",
        url: "#/inventario/registrar-elemento",
        icono: 'user'
      },
      {
        nombre:"entrada / salida",
        descripcion: "Esta opcion le permitira dar entrada o salida al los objetos del inventario",
        url: "#/inventario/ver/todos",
        icono: 'user'
      },
      {
        nombre:"ver inventario",
        descripcion: "Esta opcion le permitira ver los elementos en el inventario, a su vez tambien podra modificar o eliminar dichos objetos",
        url: "#/inventario/ver/todos",
        icono: 'user'
      },
      {
        nombre:"registrar almacen",
        descripcion: "Opcion para crear nuevos almacenes",
        url: "#/inventario/registrar-almacen",
        icono: 'user'
      },
      {
        nombre:"registrar estante",
        descripcion: "Opcion para crear nuevos estantes",
        url: "#/inventario/registrar-estante",
        icono: 'user'
      },
      {
        nombre:"crear agrupacion",
        descripcion: "Esta opcion le permitira crear las agrupaciones por las cuales se ordenaran los elementos",
        url: "#/",
        icono: 'user'
      },
      {
        nombre:"crear subagrupacion",
        descripcion: "Opcion para crear alguna caracteristica por la cual tambien ordenar elementos",
        url: "#/",
        icono: 'user'
      },
      
    ];
    
    $log.info($routeParams);
    $log.info($location);


    if($location.$$url == "/inventario/registrar-almacen"){
      $scope.mostrar_mensaje = false;
      
      $scope.registrar_almacen = function(){
        
        var formulario = $('#formulario_registrar_almacen');
        var is_valid_form = formulario.form(reglas_formulario_registrar_almacen).form('is valid');

        if(is_valid_form){
            
            //Activamos el loading
            ToolsService.loading_button('btn-registrar',true);    

            $http({
              method: 'POST',
              url: '/api/inventario/registrar-almacen',
              data: $scope.DatosForm
            }).then(function(data){

              if(data.data.resultado){
                
                $scope.mostrar_mensaje = true;
                $scope.mensaje_validacion = {
                  titulo: 'Almacen creado con exito',
                  icono: 'checkmark',
                  color: 'green',
                  mensajes: ['El almacen ha sido registrado en la base de datos.']
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
                  titulo: 'Hubo un error al guardar el formulario',
                  icono: 'remove',
                  color: 'red',
                  mensajes: data.data.mensajes
                };
              }

              //Desactivamos el loading
              ToolsService.loading_button('btn-registrar',false);

            },function(data_error){

              $scope.mostrar_mensaje = true;
              $scope.mensaje_validacion = ToolsService.get_mensaje_fail_http(data_error);

              //Desactivamos el loading
              ToolsService.loading_button('btn-registrar',false);
            });
            
        } //If condicional
      }
    }///inventario/registrar-almacen

    if($location.$$url == "/inventario/ver/todos"){
      $scope.tabla_elementos = {};
      $scope.id_elemento_actual = null;

      $scope.opciones_tabla_elementos = DTOptionsBuilder.newOptions()
        .withOption('ajax', {
         url: '/api/inventario/mostrar?type=paginacion',
         type: 'GET'
      })
      .withDataProp('data')
      .withPaginationType('full_numbers')
      .withOption('processing', true)
      .withOption('serverSide', true)
      .withOption('createdRow', function(row, data, dataIndex) {
        $compile(angular.element(row).contents())($scope);
        
        // 4 Celda de acciones en la tabla
        //angular.element($('td',row).eq(4).get(0)).css({'width':'135px'});
      });
    
      $scope.columnas_tabla_elementos = [
          DTColumnBuilder.newColumn('id').withTitle('ID').notSortable()
      ];
    }// inventario/ver/todos"




    
  }]
);
