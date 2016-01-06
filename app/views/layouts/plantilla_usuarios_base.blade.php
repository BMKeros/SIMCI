<!DOCTYPE html>
<html>
  <head lang="es">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    @section('titulo')
      <title>SIMCI - Estudiante</title>
    @show
    
      <link rel="stylesheet" href="/semantic/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="/css/formulario_inicio_sesion.css">
    
    @section ('css')
    @show

  </head>
      <!--Agregar link de redirecciones en views de administrador y almacenista.
        link de redirecciones a el ministerio del resquim, ministerio de defensa, ministerio del daes.
      -->
  <body>

  @section('barra-usuarios')
    <header><!--Barra de navegacion usuario-profesor-->
        <div class="ui attached stackable menu">
          <a class="item"><i class="home icon"></i> SIMCI</a>
          <div class="right item" style="padding-right: 80px; "><!--Css para ubicar dropdown-->
          
            <div class="ui floating labeled icon dropdown button"><!--Dropdwn para ajustes-->
                  <i class="user icon"></i>
                  <span class="text">Usuario</span>
                  
                  <div class="menu">
                    <div class="header">
                        <i class="tags icon"></i>
                        Opciones
                    </div>
                    <div class="divider"></div>
                    
                    <div class="item">
                        <i class="plus icon"></i>
                        Empty
                    </div>
                    
                    <div class="item">
                        <i class="configure icon"></i>
                        Configuracion
                    </div>
                    
                    <div class="item">
                        <i class="sign out icon"></i>
                        Salir
                    </div>
                  </div>
              </div><!--Fin del Dropdown Ajustes-->
          </div>
        </div>  
    </header><!--Fin barra de navegacion principal de usuario-profesor-->
  @show

  @section('container-estudent')
    <div class="ui grid" id="desplegable">
        <!--Menu Desplegable de Usuario-Profesor-->
        <div class="eight column row">
          <div class="ui left vertical inverted labeled icon sidebar menu" id="usuario">
            <a class="item">
                <i class="home icon"></i>
                SIMCI
            </a>
          
            <a class="item">
                <i class="lab icon"></i>
                Reactivos
            </a>
          
            <a class="item">
                <i class="checkmark icon"></i>
                Disponibles
            </a>  
          
            <a class="item">
                <i class="search icon"></i>
                Buscar  
            </a>
          
            <a class="item">
                <i class="settings icon"></i>
                Ajustes
            </a>
          </div>

          <div class="ui animated fade big launch button" tabindex="1" id="menu">
              <div class="hidden content">
                <div id="botton">Menu</div>
              </div>
              <div class="visible content">
                <i class="sidebar icon"></i>
              </div>
          </div>
        </div>
    </div>
  @show
  
  <script src="js/jquery.min.js"></script>
  <script src="js/scripts_plantilla_usuario.js"></script>
  <script src="semantic/semantic.min.js"></script>  
  
  @section('js')
  @show 
</body>
</html>