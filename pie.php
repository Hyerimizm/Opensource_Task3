<?// pie.php

// 데이터베이스 연결
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "pizza";

$conn = new mysqli($servername, $username, $password, $dbname);

// 데이터베이스에서 데이터 가져오기
$sql = "SELECT * FROM pizza";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $data[] = $row['data'];
  }
}

// 구글 차트 API 사용하여 Pie 그래프 생성
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Value'],
          ['Data 1', <?php echo $data[0]; ?>],
          ['Data 2', <?php echo $data[1]; ?>],
          ['Data 3', <?php echo $data[2]; ?>],
          ['Data 4', <?php echo $data[3]; ?>],
          ['Data 5', <?php echo $data[4]; ?>],
        ]);

        var options = {
          title: 'Pizza Toppings',
          pieSliceText: 'label',
          pieStartAngle: 100,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 1000px; height: 700px;"></div>
  </body>
</html>
