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
        descripcion: "Esta opcion le permitira registrar nuevos elementos en el inventario",
        url: "#/inventario/registrar-elemento",
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
        url: "#/inventario/crear-almacen",
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


    
  }]
);
