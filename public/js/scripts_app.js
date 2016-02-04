(function(){
  
  var TOOLS = {
    ver_reloj: function(){
      setInterval(function(){
        angular.element('#reloj').text(moment().format('H:mm:ss A'))
      },1000);
    },
    cut_string: function(string, num_char){
      var infin = ((string.length > num_char)?'....':'');
      return string.substring(0,num_char)+infin;
    },

    lenguaje_pikaday: {
      previousMonth : 'Anterior Mes',
      nextMonth     : 'Siguiente Mes',
      months        : ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
      weekdays      : ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
      weekdaysShort : ['Dom','Lun','Mar','Mie','Jue','Vie','Sab']
    }
  };

  window.TOOLS_APP = TOOLS;

})();





  


