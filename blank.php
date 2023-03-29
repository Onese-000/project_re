<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Ample Admin Lite Template by WrapPixel</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <!-- Custom CSS -->
   <link href="css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

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
<!--    

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">HOME</div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">onese</div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">gachogu</div>
</div> -->
<div class="container">
  <div id="columnchart_material" style="width: 100%; height: 100%;"></div>
</div>



<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function(){
  $('#myTab a').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
  });
}); -->

</script> -->
<!-- <div class="btn-group">
  <button type="button" class="btn btn-group-item" onclick="openChart('London')">Monthly Expenditure</button>
  <button type="button" class="btn btn-group-item" onclick="openChart('Paris')">Annual Overview</button>
</div> 
 <button type="button" class="btn btn-group-item" onclick="openCity('Tokyo')">Tokyo</button>  


<div id="piechart" class="chart">
  <h2>London</h2>
  <p>London is the capital of England.</p>
</div>

<div id="Barchart" class="chart" style="display:none">
  <h2>Paris</h2>
  <p>Paris is the capital of France.</p>
</div> -->

<!-- <div id="Tokyo" class="city" style="display:none">
  <h2>Tokyo</h2>
  <p>Tokyo is the capital of Japan.</p>
</div> -->






<script>

function openChart(chartName) {
  var i;
  var x = document.getElementsByClassName("chart");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  document.getElementById(chartName).style.display = "block";
}

</script>
</body>

</html>