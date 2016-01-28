(function(){
  var simci = angular.module('SIMCI', ['ngRoute','datatables'], function($interpolateProvider) {
          $interpolateProvider.startSymbol('<%');
          $interpolateProvider.endSymbol('%>');
  });

  simci.filter('capitalize', function() {
    return function(input, all) {
      var reg = (all) ? /([^\W_]+[^\s-]*) */g : /([^\W_]+[^\s-]*)/;
      return (!!input) ? input.replace(reg, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}) : '';
    }
  });
  
  /*simci.filter('cut_string', function(){
    return function(string, num_char){
      var infin = ((string.length > num_char)?'....':'');
      return string.substring(0,num_char)+infin;
    }
  });*/

  simci.factory('ToolsService', [function () {
    return {
      cut_string: function(string, num_char){
        var infin = ((string.length > num_char)?'....':'');
        return string.substring(0,num_char)+infin;
      }
    };
  }]);

  simci.directive("ngModelFile", [function () {
    return {
        scope: {
            ngModelFile: "="
        },
        link: function (scope, element, attributes) {
          element.bind("change", function (changeEvent) {
              var reader = new FileReader();
              reader.onload = function (loadEvent) {
                  scope.$apply(function () {
                      scope.ngModelFile = loadEvent.target.result;
                  });
              }
              reader.readAsDataURL(changeEvent.target.files[0]);
          });
        }
    }
}]);
   
  //Seteamos de manera global la app simci
  window.simci = simci;

  return simci;
})();