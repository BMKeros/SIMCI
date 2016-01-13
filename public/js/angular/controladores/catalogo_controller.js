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