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