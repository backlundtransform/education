
<!DOCTYPE html>
<html>
  <head>
  	<title>Statistik</title>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, height=device-height">





{{HTML::style('css/layout.css');}}

</head>
<body>

<input type="button"
  onClick="window.print()"
  value="Skriv ut"/>
  <a href="#" onclick="history.go(-1)">Gå tillbaka</a>
  
  	<h1> {{$user->fornamn }} {{$user->efternamn }}</h1> 

<br>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          {{$data}}     ]);

        var options = {
         
        };

        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width:100%; height: 100%;"></div>
  </body>
</html>