<?php
date_default_timezone_set('America/Los_Angeles');
include 'password.php';
$servername = "localhost";
$username = "brianpo3_tester";
$dbname = "brianpo3_tester";

$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$username = $_POST['username'];
$ppmRiseTotal = $_POST['ppmRiseTotal'];
$ppm1 = $_POST['ppm1'];
$ppm2 = $_POST['ppm2'];
$ppm3 = $_POST['ppm3'];
$date = date('Y-m-d');

$sql = "INSERT INTO bme405 (username, ppmRiseTotal, ppm1, ppm2, ppm3, date) VALUES (:username, :ppmRiseTotal, :ppm1, :ppm2, :ppm3, :date)";
$statement = $pdo->prepare($sql);
$statement->bindValue(':username', $username);
$statement->bindValue(':ppmRiseTotal', $ppmRiseTotal);
$statement->bindValue(':ppm1', $ppm1);
$statement->bindValue(':ppm2', $ppm2);
$statement->bindValue(':ppm3', $ppm3);
$statement->bindValue(':date', $date);
$statement->execute();


$sql= "SELECT * FROM `bme405`";

$qry = $pdo->query($sql);
$result = $qry->fetchAll();
$count = count($result) - 1;
?>

<html>
<head>
<title>BME 405</title>
<script src="plotly-latest.min.js"></script>
</head>

<body>

  <h5>USERNAME<br><?php echo $result[$count]['username']?></h5><br>
  <h5>TOTAL RISE<br><?php echo $result[$count]['ppmRiseTotal']?></h5><br>
  <h5>FIRST DATA POINT (PPM)<br><?php echo $result[$count]['ppm1']?></h5><br>
  <h5>SECOND DATA POINT (PPM)<br><?php echo $result[$count]['ppm2']?></h5><br>
  <h5>THIRD DATA POINT (PPM)<br><?php echo $result[$count]['ppm3']?></h5><br>

  <div id="tester"></div>
</body>

<script>
	TESTER = document.getElementById('tester');
var trace1 = {
  x: [1, 2, 3],
  y: [<?php echo $result[$count]['ppm1']?>, <?php echo $result[$count]['ppm2']?>, <?php echo $result[$count]['ppm3']?>],
  mode: 'lines+markers',
  name: 'Scatter + Lines'
};

var data = [trace1];

var layout = {
  title:'<?php echo $result[$count]['username']?>',
  yaxis: {
    title: 'Hydrogen Concentration (ppm)',
    showgrid: false,
    zeroline: false
  },
};

Plotly.newPlot(TESTER, data, layout);
</script>

</html>
