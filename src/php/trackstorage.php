<?php
include 'db_credential.php';
$conn = mysqli_connect($host, $user, $password, $database);
$sql = "SELECT * FROM product";
$results = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
  <title>PIECHART OF SALES</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
  // Load google charts
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  // Draw the chart and set the chart values
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
    ['product', 'sales'],
    <?php
    while ($row = mysqli_fetch_array($results)) {
      // code...
      echo "['".$row["pname"]."',".$row["sale"]."],";
    }
    ?>
  ]);
  // Optional; add a title and set the width and height of the chart
  var options = {'title':'SALES', 'width':550, 'height':400};
    // Display the chart inside the <div> element with id="piechart"
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  }
  </script>

</head>
<body>
<div id="piechart"></div>

</body>
</html>
