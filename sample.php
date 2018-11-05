<?php
date_default_timezone_set('America/Los_Angeles');
include 'password.php';
$servername = "localhost";
$username = "brianpo3_tester";
$dbname = "brianpo3_tester";

$user = $_POST['user'];
$id = $_POST['dateSelection'];

$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$sql= "SELECT * FROM bme405 LEFT JOIN bme405userpass ON bme405.username = bme405userpass.user WHERE bme405.id='$id' UNION SELECT * FROM bme405 RIGHT JOIN bme405userpass ON bme405.username = bme405userpass.user WHERE bme405.id='$id'";

$qry = $pdo->query($sql);
$result = $qry->fetchAll();
$count = count($result);

?>

<html>
<head>
<title>BME 405</title>
<style>
@font-face {
  font-family: "Francisco";
  src: url('/405/SF-Pro-Display-Light.otf');
}
</style>
<script src="plotly-latest.min.js"></script>
</head>

<body>
<div id="tester"></div>

</body>

<script>

TESTER = document.getElementById('tester');
var trace1 = {
x: [0, 45, 90],
y: [<?php echo $result[0]['ppm1']?>, <?php echo $result[0]['ppm2']?>, <?php echo $result[0]['ppm3']?>],
fill: 'tozeroy',
type: 'scatter',
marker: {
    color: 'rgb(17, 157, 255)',
    size: 20,
  },
};

var data = [trace1];

var layout = {
title:'<?php echo $result[0]['date']?>',
yaxis: {
  title: 'H<sub>2</sub> (ppm)',
  showgrid: false,
  zeroline: false
},
xaxis: {
  title: 'Time from start of test (mins)',
},
font: {
  color: 'lightgrey',
  size: '23',
  family: 'Francisco',
},
plot_bgcolor:'rgba(8, 1, 1, 0)',
paper_bgcolor: 'rgba(8, 1, 1, 0.1)',
};

Plotly.newPlot(TESTER, data, layout, {displayModeBar: false});

</script>

<style>

body {
  background: linear-gradient(225deg, #676767, #2f2f2f);
  color: lightgrey;
  font-family: 'Francisco', sans-serif;
  font-weight: 100;
  margin: 2rem;
  text-align: center;
}

</style>

</html>
