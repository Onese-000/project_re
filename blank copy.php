<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>

<script src="https://www.gstatic.com/charts/loader.js"></script>
<script>
 google.charts.load('current', {'packages': ['corechart', 'bar']});
 google.charts.setOnLoadCallback(drawCharts);

  function drawChart() {
  var data = google.visualization.arrayToDataTable([    ['Year', 'Sales', 'Expenses', 'Profit'],
    ['2014', 1000, 400, 200],
    ['2015', 1170, 460, 250],
    ['2016', 660, 1120, 300],
    ['2017', 1030, 540, 350]
  ]);
  
  var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
  chart.draw(data, google.charts.Bar.convertOptions(options));
}
</script>
</head>

<body>

<div class="container" style="width:100%; height: 100%; overflow: hidden; position: relative;">
  <div id="columnchart_material"></div>
</div>

</body>
</html>