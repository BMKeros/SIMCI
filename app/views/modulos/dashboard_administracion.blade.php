@extends('layouts.plantilla_master')

@section('titulo')
    <title>SIMCI - Administracion</title>
@stop

@section('contenido-body-master')

    <header>
        <div class="ui fixed menu">
            <div class="ui container">
                <a class="item" id="btn-abrir-menu">
                    <i class="sidebar icon"></i>
                </a>

                <a href="#/" class="header item">
                    <img class="logo" src="/img/logo.png">
                    &nbsp;&nbsp;&nbsp;SIMCI
                </a>

                <div class="right menu">

                    <div class="ui pointing dropdown link item" tabindex="0" ng-click="cargar_notificaciones()"
                         id="item_menu_notificaciones">
                        <i class="circular empty teal alarm icon" id="icono_barra_notificaciones"></i>
                        <a class="ui blue empty circular label" id="label_numero_notificaciones">0</a>
                        <i class="dropdown icon"></i>

                        <div class="menu transition hidden menu_notificaciones" tabindex="-1">
                            <div class="header">Notificaciones</div>
                            <div class="right label_ver_notificaciones"><a>Ver todas</a></div>

                            <div class="divider"></div>

                            <div ng-show="bandera_loading_notificaciones" class="item loading_notificaciones">
                                <div class="ui active loader"></div>
                            </div>

                            <div class="item" ng-show="notificaciones.length == 0">
                                <p align="center">No hay notificaciones</p>
                            </div>

                            <div ng-show="bandera_mostrar_notificaciones" class="item"
                                 ng-repeat="noti in notificaciones track by $index">
                                <!--<img class="ui avatar img_item_notificacion" src="/img/perfil-default.jpg">
								<div class="cuerpo_notificacion">
									<span class="texto capitalize"><% noti.mensaje %></span> 
								</div>
								<div class="fecha_notificacion" ><% noti.fecha | formato_fecha:'DD/MM/YY' %></div>-->
                                <div class="ui feed">
                                    <div class="event">
                                        <div class="label">
                                            <img src="/img/perfil-default.jpg">
                                        </div>

                                        <div class="content">
                                            <div class="summary">
                                                <a class="user">
                                                    <% noti.usuario | capitalize %>
                                                </a>
                                                <% noti.mensaje %>
                                                <div class="date" style="float:right;">
                                                    <% noti.fecha | formato_fecha:'DD/MM/YY' %>
                                                </div>
                                            </div>
                                            <div class="meta">
                                                <a class="like"><i class="clock icon"></i><% noti.hora %>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="ui dropdown item">
                        <img class="ui right spaced avatar image" src="{{ Auth::user()->get_avatar() }}">
                        Usuario
                        <i class="dropdown icon"></i>

                        <div class="menu">
                            <div class="item">
                                <div class="ui card">
                                    <div class="image">
                                        <img src="{{ Auth::user()->imagen }}">
                                    </div>
                                    <div class="content">
                                        <a class="header">{{ ucfirst(Auth::user()->usuario) }}</a>

                                        <div class="meta">
                                            <span class="date">Tipo: {{ Auth::user()->nombre_tipo_usuario() }}</span>
                                        </div>
                                        <div class="description">
                                            {{ Auth::user()->nombre_corto()}}
                                        </div>
                                    </div>
                                    <div class="extra content">
                                        <a href="/autenticacion/logout"><i class="settings icon"></i>Salir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>


    <div class="ui left vertical inverted labeled icon sidebar menu" id="menu-administracion">
        <a class="item" href="#/">
            <i class="home icon"></i>
            Inicio
        </a>

        <a class="item" ng-href="#/usuarios">
            <i class="user layout icon"></i>
            Usuarios
        </a>

        <a class="item" ng-href="#/catalogo">
            <i class="book icon"></i>
            Catalogo
        </a>

        <a class="item" ng-href="#/inventario">
            <i class="archive icon"></i>
            Inventario
        </a>

        <a class="item" ng-href="#/proveedores">
            <i class="shop icon"></i>
            Proveedor
        </a>

        <a class="item" ng-href="#/laboratorio">
            <i class="lab icon"></i>
            Laboratorio
        </a>

        <a class="item" ng-href="#/ordenes">
            <i class="edit icon"></i>
            Ordenes
        </a>

        <a class="item" ng-href="#/reportes">
            <i class="file text outline icon"></i>
            Reportes
        </a>

        <a class="item" ng-href="#/documentos">
            <i class="travel icon"></i>
            Documentos
        </a>

        <a class="item" ng-href="#/consulta">
            <i class="search icon"></i>
            Consultas
        </a>

        <a class="item" ng-href="#/instituciones">
            <i class="building icon"></i>
            Instituciones
        </a>

        <a class="item">
            <i class="settings icon"></i>
            Settings
        </a>
    </div>

    <div class="ui container espacio_buttom espacio_top">
        <div ng-view></div>
    </div>


    <script type="text/ng-template" id="main_dashboard.html">

        <div class="ui five statistics">
            <div class="ui mini <% indicador.color %> statistic steps" ng-repeat="indicador in indicadores" style="padding: 8px; font-size: 12px;">
                <div class="label">
                    <% indicador.label_primario %>
                </div>
                <div class="value" style="font-size: 50px;">
                    <i class="<% indicador.icono %>" ></i> <% indicador.value%>
                </div>
                <div class="label">
                    <% indicador.label_secundario %>
                </div>
            </div>
        </div>

        <h5 class="ui horizontal divider header">
            <i class="bar chart icon"></i> Graficas estadisticas
        </h5>

        <div class="ui grid">
            <div class="ten wide column">
                <canvas id="grafica_1" class="chart chart-line" chart-data="data_grafica_1"
                        chart-labels="labels_grafica_1" chart-legend="true" chart-series="series_grafica_1">
                </canvas>
            </div>
            <div class="six wide column">
                <canvas id="grafica_2" class="chart chart-bar"
                        chart-data="data_grafica_2" chart-labels="labels_grafica_2" chart-series="series_grafica_2">
                </canvas>
            </div>
        </div>

        <h5 class="ui horizontal divider header">
            <i class="bar chart icon"></i> Graficas
        </h5>

        <div class="ui three column grid">
            <div class="column">
                <canvas id="grafica_3" class="chart chart-pie"
                        chart-data="data_grafica_3" chart-labels="labels_grafica_3">
                </canvas>
            </div>
            <div class="column">
                <canvas id="grafica_4" class="chart chart-doughnut"
                        chart-data="data_grafica_3" chart-labels="labels_grafica_3">
                </canvas>
            </div>
            <div class="column">
                <canvas id="grafica_5" class="chart chart-radar"
                        chart-data="data_grafica_1" chart-labels="labels_grafica_5">
                </canvas>
            </div>
        </div>


    </script>

    <div class="ui bottom fixed menu barra_inferior">
        <div class="item right">
            <a class="ui teal tag label">
                <span id="reloj">0:00:00</span>
            </a>
        </div>
    </div>

@stop

@section('js')
    <script>
        $(document).ready(function () {

            $('#contenedorPadre').addClass('backgroundPadre');

            $("#btn-abrir-menu").click(function () {
                $('#menu-administracion')
                        .sidebar({
                            transition: 'overlay',
                            dimPage: true,
                            context: $('body'),
                        })
                        .sidebar('toggle');
            });

            $('.ui.dropdown').dropdown({
                transition: 'drop'
            });
        });
    </script>
@stop
