(function(){
  
  var TOOLS = {
    ver_reloj: function(){
      setInterval(function(){
        angular.element('#reloj').text(moment().format('h:mm:ss a'))
      },1000);
    },
  };

  window.TOOLS_APP = TOOLS;

})();





  


