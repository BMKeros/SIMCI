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
        url: "#/inventario/ver/todos",
        icono: 'compress',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA, TIPO_USER_PROFESOR]
      },
      {
        nombre:"ver inventario",
        descripcion: "Esta opcion le permitira ver los elementos en el inventario, a su vez tambien podra modificar o eliminar dichos objetos",
        url: "#/inventario/ver/todos",
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
          { nombre:"ver almacen", url:"#/inventario/mostrar-almacen"}
        ],
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA]
      },
      {
        nombre:"sub dimension",
        descripcion: "Opcion para crear sub dimenciones",
        url: "#/inventario/registrar-sub-dimension",
        icono: 'write',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA]
      },
      {
        nombre:"crear agrupacion",
        descripcion: "Esta opcion le permitira crear las agrupaciones por las cuales se ordenaran los elementos",
        url: "#/",
        icono: 'write',
        show_in:[TIPO_USER_ROOT, TIPO_USER_ALMACENISTA]
      },
      {
        nombre:"crear subagrupacion",
        descripcion: "Opcion para crear alguna caracteristica por la cual tambien ordenar elementos",
        url: "#/",
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
          titulo: 'Estante creado con exito',
          mensajes: ['El estante ha sido registrado en la base de datos.']
        }///inventario/registrar-estante
      });
    }

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
