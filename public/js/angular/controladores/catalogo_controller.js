/// Controlador para catalogo

simci.controller('CatalogoController', [
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
  function ($scope, $http, $log ,$timeout,$route, $routeParams, $location,DTOptionsBuilder,DTColumnBuilder,$compile){
    
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
        url: "#/catalogo/ver/todos"
      }
    ];
    
    $log.info($routeParams);
    $log.info($location);

    if($location.$$url == '/catalogo/registrar-objeto'){

      $scope.mostrar_mensaje = false;

        $scope.registrar_objeto = function(){
        
          var formulario = $('#formulario_crear_objeto');
          var is_valid_form = formulario.form(reglas_formulario_crear_objeto).form('is valid');

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
            
          } //If condicional
        }
    
      }// If == '/catalogo/registrar-objeto'

      if($location.$$url == '/catalogo/ver/todos'){

        $scope.opciones_tabla_objetos = DTOptionsBuilder.newOptions()
          .withOption('ajax', {
           url: '/api/catalogo/mostrar?type=paginacion',
           type: 'GET'
        })
        .withDataProp('data')
        .withPaginationType('full_numbers')
        .withOption('processing', true)
        .withOption('serverSide', true)
        .withOption('createdRow', function(row, data, dataIndex) {
          $compile(angular.element(row).contents())($scope);
        });
      
        $scope.columnas_tabla_objetos = [
            DTColumnBuilder.newColumn('id').withTitle('ID').notSortable(),
            DTColumnBuilder.newColumn('nombre').withTitle('Nombre').notSortable(),
            DTColumnBuilder.newColumn(null).withTitle('Unidad').renderWith(
              function(data, type, full) {
                return data.data_unidad.nombre+' ('+data.data_unidad.abreviatura+')';
            }).notSortable(),
            DTColumnBuilder.newColumn('descripcion').withTitle('Descripcion').notSortable(),
            
            DTColumnBuilder.newColumn(null).withTitle('Acciones').renderWith(
              function(data, type, full) {
                return '<a class="ui icon button blue" data-content="Ver Usuario" ng-click="modal_ver_objeto('+data.id+')"><i class="unhide icon"></i></a>
                        <a class="ui icon button green"  data-content="Modificar Usuario" ng-click="modal_modificar_objeto('+data.id+')"><i class="edit icon"></i></a>  
                        <a class="ui icon button red "  data-content="Eliminar Usuario" ng-click="modal_eliminar_objeto('+data.id+')"><i class="remove icon"></i></a>';
            })
        ];

      }// If == '/catalogo/mostrar-catalogo'
    
  }]
);