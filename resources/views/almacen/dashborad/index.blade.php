@extends ('layouts.admin')
@section ('contenido')
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
  <div id="curve_chart" style=" height: 500px" ></div>



 
 </div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	
	<div id="piechart" ></div>

 

	
  </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	
	<div id="piechart2"  ></div>

 

	
  </div>

  
 
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Productos', 'mes'],
            @foreach ($pastel as $pastels)
              ['{{ $pastels->ubicacion}}', {{ $pastels->total}}],
            @endforeach
        ]);
        var options = {
          title: 'Clientes por ubicación'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Productos', 'mes'],
            @foreach ($pastel2 as $pastels)
              ['{{ $pastels->producto}}', {{ $pastels->total}}],
            @endforeach
        ]);
        var options = {
          title: 'Los 10 productos más vendidos'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart.draw(data, options);
      }
    </script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Ganancias', 'Mes'],
          @foreach ($linea as $lineas)
              ['{{date('M', strtotime($lineas->fecha))}}', {{ $lineas->total}}],
            @endforeach
        ]);

        var options = {
          title: 'Ventas mensuales',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
 
  
</html>
@endsection
