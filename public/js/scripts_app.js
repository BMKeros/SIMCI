(function(){
  
  var TOOLS = {
    intervalo_notificaciones: 600000,
    sonido_notificacion: function(){
      return new Howl({ urls: ['/sonidos/sound-noti1.wav'] });
    },
    listen_notificaciones: function(){
      var sound = this.sonido_notificacion();
      setInterval(function(){
        var data = JSON.parse(localStorage.getItem('data_usuario'));
        $.ajax({ url:'/api/notificaciones/mostrar?id_usuario='+data.id_usuario+'&contar=true' })
        .done(function(data){
          if(data.datos != 0){
            sound.play();
          }
          $("#label_num_notificaciones").html(data.datos);
        });
      },this.intervalo_notificaciones);
    },
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
    },
    cargar_data_localstorage: function(){
      var data = localStorage.getItem('data_usuario');
      var data_convertida = JSON.parse(data);
      for(key in data_convertida){
        localStorage.setItem(key, data_convertida[key]);
      }
    },
  };

  window.TOOLS_APP = TOOLS;

  //Constantes de tipos de usuario
  window.TIPO_USER_ROOT = 'TU01';
  window.TIPO_USER_ADMIN = 'TU02';
  window.TIPO_USER_PROFESOR = 'TU03';
  window.TIPO_USER_ESTUDIANTE = 'TU04';
  window.TIPO_USER_ALMACENISTA = 'TU05';
  window.TIPO_USER_SUPERVISOR = 'TU06';

})();





  


