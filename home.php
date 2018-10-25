<?php
date_default_timezone_set('America/Los_Angeles');
include 'password.php';
$servername = "localhost";
$username = "brianpo3_tester";
$dbname = "brianpo3_tester";

$user = $_POST['user'];

$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$sql= "SELECT * FROM bme405 LEFT JOIN bme405userpass ON bme405.username = bme405userpass.user WHERE bme405.username='$user' UNION SELECT * FROM bme405 RIGHT JOIN bme405userpass ON bme405.username = bme405userpass.user WHERE bme405.username='$user'";

$qry = $pdo->query($sql);
$result = $qry->fetchAll();
$count = count($result);

//Date array building

$dateArray = [0];
for ($j=1;$j<$count;$j++) {
  $date2 = $result[$j]['date'];
  $date1 = $result[0]['date'];
  $diff = abs(strtotime($date2) - strtotime($date1));

  $years = floor($diff / (365*60*60*24));
  $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
  $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
  $dateArray[$j] = $days;
}
?>

<html>
<head>
<title>BME 405</title>
<script src="plotly-latest.min.js"></script>
</head>

<body>
  <div id="backDiv">
<div id="tester"></div>

<form id="form" action="/405/sample.php" method="post">
  <select name="dateSelection">
    <?php for ($i=0; $i<$count; $i++) {
      echo '<option value=' . $result[$i]['id'] . '>' . $result[$i]['date'] . '</option>';
    }
    ?>
  </select>
  <input id="button" type="submit" value="VIEW">
</form>

<h3>USERNAME: <?php echo $result[0]['username']?></h3>
<h3>AGE: <?php echo $result[0]['age']?></h3>
<img src="/405/faces/
<?php
if ($result[$count-1]['ppmRiseTotal'] > 25) {
  echo "3";
} elseif ($result[$count-1]['ppmRiseTotal'] > 15) {
  echo "2";
} else {
  echo "1";
}
 ?>.png">

</body>
</div>

<script>

TESTER = document.getElementById('tester');
var trace1 = {
x: [
  <?php for ($i=0;$i<$count;$i++) {
    echo $dateArray[$i] . ', ';
  }?>
],
y: [
  <?php for ($i=0;$i<$count;$i++) {
    echo $result[$i]['ppmRiseTotal'] . ', ';
  }?>
],
fill: 'tozeroy',
type: 'scatter',
marker: {
    color: 'rgb(17, 157, 255)',
    size: 20,
  },
};

var data = [trace1];

var layout = {
title:'Trend',
yaxis: {
  title: 'H<sub>2</sub> Total Rise (ppm)',
  showgrid: false,
  zeroline: false
},
xaxis: {
  title: 'Days since first sample',
},
font: {
  color: 'lightgrey',
  size: '23',
  family: 'Courier New',
},
plot_bgcolor:'black',
paper_bgcolor: 'black',
};

Plotly.newPlot(TESTER, data, layout, {displayModeBar: false});

</script>

<style>
body {
  background: black;
  color: lightgrey;
  font-family: 'Courier New';
}

</style>

</html>
