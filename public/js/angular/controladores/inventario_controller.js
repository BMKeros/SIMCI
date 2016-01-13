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
