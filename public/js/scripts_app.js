(function(){
  
  var TOOLS = {
    ver_reloj: function(){
      setInterval(function(){
        angular.element('#reloj').text(moment().format('h:mm:ss A'))
      },1000);
    },
    cut_string: function(string, num_char){
      var infin = ((string.length > num_char)?'....':'');
      return string.substring(0,num_char)+infin;
    },
  };

  window.TOOLS_APP = TOOLS;

})();





  


