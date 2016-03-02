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
  '$templateCache',
  function ($scope, $http, $log ,$timeout, $route, $routeParams, $location, $compile,DTOptionsBuilder, DTColumnBuilder,ToolsService, $templateCache){
    
    $scope.modulo = {};

    $scope.DatosForm = {}; // Objeto para los datos de formulario
    $scope.data_global_user = ToolsService.get_data_user_localstorage();


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
        icono: 'write',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA]
      },
      {
        nombre:"entrada / salida",
        descripcion: "Esta opcion le permitira dar entrada o salida al los objetos del inventario",
        url: "#/inventario/entrada-salida",
        icono: 'compress',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA, TIPO_USER_PROFESOR]
      },
      {
        nombre:"ver inventario",
        descripcion: "Esta opcion le permitira ver los elementos en el inventario, a su vez tambien podra modificar o eliminar dichos objetos",
        url: "#/inventario/ver/elementos",
        icono: 'eye',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA, TIPO_USER_SUPERVISOR, TIPO_USER_PROFESOR]
      },
      {
        nombre:"Almacen",
        descripcion: "Opcion para crear nuevos almacenes",
        icono: 'write',
        ver_dropdown: true,
        opciones_dropdown: [
          { nombre:"registrar almacen",url: "#/inventario/registrar-almacen"},
          { nombre:"ver almacen", url:"#/inventario/ver/almacenes"}
        ],
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA]
      },
      {
        nombre:"crear sub dimension",
        descripcion: "Opcion para crear sub dimenciones",
        url: "#/inventario/registrar-sub-dimension",
        icono: 'write',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA]
      },
      {
        nombre:"crear agrupacion",
        descripcion: "Esta opcion le permitira crear las agrupaciones por las cuales se ordenaran los elementos",
        url: "#/inventario/registrar-agrupacion",
        icono: 'write',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA]
      },
      {
        nombre:"crear sub agrupacion",
        descripcion: "Opcion para crear alguna caracteristica por la cual tambien ordenar elementos",
        url: "#/inventario/registrar-sub-agrupacion",
        icono: 'write',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA]
      },
      
    ];
    
    $log.info($routeParams);
    $log.info($location);

    
    if($location.$$url == "/inventario/registrar-elemento"){
      $scope.mostrar_mensaje = false;

      $scope.registrar_elemento = ToolsService.registrar_dinamico($scope,$http,$timeout,{
        url: '/api/inventario/registrar-elemento',
        formulario:{
          id:'formulario_registrar_elemento',
          reglas: reglas_formulario_registrar_elemento
        },
        exito:{
          titulo: 'Elemento registrado con exito',
          mensajes: ['El elemento ha sido registrado en la base de datos.']
        }///inventario/registrar-elemento
      });
    }



    if($location.$$url == "/inventario/registrar-almacen"){
      
      ToolsService.reload_template_cache($route,$templateCache);

      $scope.mostrar_mensaje = false;

      $scope.registrar_almacen = ToolsService.registrar_dinamico($scope,$http,$timeout,{
        url: '/api/inventario/registrar-almacen',
        formulario:{
          id:'formulario_registrar_almacen',
          reglas: reglas_formulario_registrar_almacen
        },
        exito:{
          titulo: 'Almacen creado con exito',
          mensajes: ['El almacen ha sido registrado en la base de datos.']
        }///inventario/registrar-almacen
      });
    }

    if($location.$$url == "/inventario/registrar-sub-dimension"){
      $scope.mostrar_mensaje = false;

      $scope.registrar_sub_dimension = ToolsService.registrar_dinamico($scope,$http,$timeout,{
        url: '/api/inventario/registrar-sub-dimension',

        formulario:{
          id:'reglas_formulario_registrar_sub_dimension',
          reglas: reglas_formulario_registrar_sub_dimension
        },
        exito:{
          titulo: 'Sub dimension creado con exito',
          mensajes: ['La sub dimension ha sido registrado en la base de datos.']
        }///inventario/registrar-estante
      });
    }

    if($location.$$url == "/inventario/registrar-agrupacion"){
      $scope.mostrar_mensaje = false;

      $scope.registrar_agrupacion = ToolsService.registrar_dinamico($scope,$http,$timeout,{
        url: '/api/inventario/registrar-agrupacion',

        formulario:{
          id:'reglas_formulario_registrar_agrupacion',
          reglas: reglas_formulario_registrar_agrupacion
        },
        exito:{
          titulo: 'Agrupacion creado con exito',
          mensajes: ['La agrupacion ha sido registrado en la base de datos.']
        }///inventario/registrar-agrupacion
      });
    }

    if($location.$$url == "/inventario/registrar-sub-agrupacion"){
      $scope.mostrar_mensaje = false;

      $scope.registrar_sub_agrupacion = ToolsService.registrar_dinamico($scope,$http,$timeout,{
        url: '/api/inventario/registrar-sub-agrupacion',

        formulario:{
          id:'reglas_formulario_registrar_sub_agrupacion',
          reglas: reglas_formulario_registrar_sub_agrupacion
        },
        exito:{
          titulo: 'Sub agrupacion creado con exito',
          mensajes: ['La sub agrupacion ha sido registrado en la base de datos.']
        }///inventario/registrar-sub-agrupacion
      });
    }

    if($location.$$url == "/inventario/ver/elementos"){
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
        
        $timeout(function(){
            $('.ui.spopup').popup();
        },false,0);
      });
    
      $scope.columnas_tabla_elementos = [
          DTColumnBuilder.newColumn(null).withTitle('Codigo de elemento').renderWith(
            function(data, type, full){
              return ToolsService.generar_codigo_elemento(data,'label');
            }
          )
          .notSortable()
          .withOption('width', '20%'),

          DTColumnBuilder.newColumn('nombre_objeto').withTitle('Objeto').notSortable(),
          
          DTColumnBuilder.newColumn(null).withTitle('Disponibilidad').renderWith(
            function(data, type, full){
              return ToolsService.quitar_ceros_decimales(data.cantidad_disponible);
            }
          )
          .notSortable()
          .withOption('width', '10%'),
          
          DTColumnBuilder.newColumn(null).withTitle('Unidad').renderWith(
            function(data, type, full) {
              return data.nombre_unidad + ' ('+ data.abreviatura + ')';
            }
          )
          .notSortable()
          .withOption('width', '15%'),
          
          DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
            function(data, type, full) {
              return '<a class="ui icon button blue spopup" data-content="Ver Elemento" ng-click="modal_ver_elemento('+data.id+')"><i class="unhide icon"></i></a>'+
                      '<a class="ui icon button green spopup"  data-content="Modificar Elemento" ng-click="modal_modificar_usuario('+data.id+')"><i class="edit icon"></i></a>'+  
                      '<a class="ui icon button red spopup"  data-content="Eliminar Elemento" ng-click="modal_eliminar_usuario('+data.id+')"><i class="remove icon"></i></a>';
          })
          .notSortable()
          .withOption('width', '15%'),
      ];      
    }// inventario/ver/todos"  

    if($location.$$url == "/inventario/entrada-salida"){
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
        
        $timeout(function(){
            $('.ui.spopup').popup();
        },false,0);
      });
    
      $scope.columnas_tabla_elementos = [
          DTColumnBuilder.newColumn(null).withTitle('Codigo de elemento').renderWith(
            function(data, type, full){
              return ToolsService.generar_codigo_elemento(data,'label');
            }
          )
          .notSortable()
          .withOption('width', '20%'),

          DTColumnBuilder.newColumn('nombre_objeto').withTitle('Objeto').notSortable(),
          
          DTColumnBuilder.newColumn(null).withTitle('Disponibilidad').renderWith(
            function(data, type, full){
              return ToolsService.quitar_ceros_decimales(data.cantidad_disponible);
            }
          )
          .notSortable()
          .withOption('width', '10%'),
          
          DTColumnBuilder.newColumn(null).withTitle('Unidad').renderWith(
            function(data, type, full) {
              return data.nombre_unidad + ' ('+ data.abreviatura + ')';
            }
          )
          .notSortable()
          .withOption('width', '15%'),
          
          DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
            function(data, type, full) {
              return '<a class="ui icon button green spopup" data-content="Entrada Elemento" ng-click=""><i class="sign in icon"></i></a>'+
                      '<a class="ui icon button red spopup"  data-content="Salida Elemento" ng-click=""><i class="sign out icon"></i></a>';
          })
          .notSortable()
          .withOption('width', '15%'),
      ];      
    }// inventario/entrada-salida/"  




  }]
);
