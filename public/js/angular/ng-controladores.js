/// Controlador para catalogo

simci.controller('CatalogoController', ['$scope','$http','$log','$route', '$routeParams', '$location', 
  function ($scope, $http, $log , $route, $routeParams, $location){
    
    $scope.modulo = {};

    $scope.modulo.nombre = "Catalogo";
    $scope.modulo.icono = {
      tipo: "book",
      color: "orange"
    };
    
    $scope.modulo.opciones = [
      {
        nombre:"registrar objeto",
        descripcion: "Esta opcion le permitira añadir nuevos objetos al catalogo",
        url: "#/"
      },
      {
        nombre:"ver catalogo",
        descripcion: "Esta opcion le permitira ver los objetos del catalogo, a su vez tambien podra modificar o eliminar dichos objetos",
        url: "#/"
      },
      
    ];
    
    $log.info($routeParams);
    $log.info($location);
    
  }]
);
/// Controlador para inventario

simci.controller('InventarioController', ['$scope','$http','$log','$route', '$routeParams', '$location', 
  function ($scope, $http, $log , $route, $routeParams, $location){
    
    $scope.modulo = {};

    $scope.modulo.nombre = "Inventario";
    $scope.modulo.icono = {
      tipo: "archive",
      color: "green"
    };
    
    $scope.modulo.opciones = [
      {
        nombre:"registrar elemento",
        descripcion: "Esta opcion le permitira crear nuevos elementos en el inventario",
        url: "#/"
      },
      {
        nombre:"ver inventario",
        descripcion: "Esta opcion le permitira ver los elementos en el inventario, a su vez tambien podra modificar o eliminar dichos objetos",
        url: "#/"
      },
      {
        nombre:"crear almacen",
        descripcion: "Opcion para crear nuevos almacenes",
        url: "#/"
      },
      {
        nombre:"crear estante",
        descripcion: "Opcion para crear nuevos estantes",
        url: "#/"
      },
      {
        nombre:"crear agrupacion",
        descripcion: "Esta opcion le permitira crear las agrupaciones por las cuales se ordenaran los elementos",
        url: "#/"
      },
      {
        nombre:"crear subagrupacion",
        descripcion: "Opcion para crear alguna caracteristica por la cual tambien ordenar elementos",
        url: "#/"
      },
      
    ];
    
    $log.info($routeParams);
    $log.info($location);


    
  }]
);


/// Controlador para usuarios

simci.controller('UsuariosController', ['$scope','$http','$log','$route', '$routeParams', '$location', 
  function ($scope, $http, $log , $route, $routeParams, $location){
    $scope.modulo = {};

    $scope.DatosForm = {}; // Objeto para los datos de formulario

    $scope.modulo.nombre = "Usuarios";
    $scope.modulo.icono = {
      tipo: "users",
      color: "blue"
    };

    $scope.modulo.opciones = [
      {
        nombre:"crear usuarios",
        descripcion: "Opcion para crear nuevos usuarios en el sistema",
        url: "#/usuarios/crear"
      },
      {
        nombre:"ver usuarios",
        descripcion: "Opcion para Ver, Actualizar, Eliminar los usuarios registrados en el sistema",
        url: "#/usuarios/ver/todos"
      },
      {
        nombre:"crear permisos",
        descripcion: "Opcion se podran crear nuevos permisos de usuarios para el sistema",
        url: "#/usuarios/eliminar"
      },
      {
        nombre:"ver permisos",
        descripcion: "Opcion para Ver, Actualizar, Eliminar los permisos registrados en el sistema",
        url: "#/usuarios/modificar"
      },
      {
        nombre:"crear tipos de usuario",
        descripcion: "Opcion para Ver, Actualizar, Eliminar los permisos registrados en el sistema",
        url: "#/usuarios/modificar"
      },
    ];
    
    $log.info($routeParams);
    $log.info($location);

    $scope.registrar_usuario = function(){
    
      var is_valid_form = $('#formulario_crear_usuario')
      .form(reglas_formulario_crear_usuario)
      .form('is valid');

      if(is_valid_form){
        $log.info($scope.DatosForm);
        $http({
          method: 'POST',
          url: '/api/usuarios/crear-usuario-completo',
          data: $scope.DatosForm
        }).then(function(data){
          console.log(data.data);
        },function(data_error){
          console.log(data_error);
        });
      }
    }


  }]
);
    
    