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
<style>
@font-face {
  font-family: "Francisco";
  src: url('/405/SF-Pro-Display-Light.otf');
}
</style>
<link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">
</head>

<body>
<img class='jump' src="/405/sprites/<?php echo $result[0]['spriteNumber']; ?>.png" height="200">
<p class="username"> <?php echo $user;?> </p>
<div id="backDiv">
<div id="tester"></div><br>

<div id="newPlayerCard">

<p class="sectionHeader">Most recent hydrogen rise</p>
<p class='values'><?php echo $result[$count-1]['ppmRiseTotal']; ?> ppm</p>
<img height=100px src="/405/faces/
<?php
if ($result[$count-1]['ppmRiseTotal'] > 25) {
  echo "3";
} elseif ($result[$count-1]['ppmRiseTotal'] > 15) {
  echo "2";
} else {
  echo "1";
}
 ?>.png">
<p class="sectionHeader">View individual test results</p>
 <form id="form" action="/405/sample.php" method="post">
   <select name="dateSelection">
     <?php for ($i=0; $i<$count; $i++) {
       echo '<option value=' . $result[$i]['id'] . '>' . $result[$i]['date'] . '</option>';
     }
     ?>
   </select>
   <input id="button" type="submit" value="VIEW">
 </form>
</div>





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
title: 'Recent Trends',
yaxis: {
  title: 'H<sub>2</sub> Total rise (ppm)',
  showgrid: false,
  zeroline: false
},
xaxis: {
  title: 'Days since first sample',
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

img {
  margin-bottom: 1.5rem;
}

#playerCard {
  width: 50%;
  text-align: center;
  font-weight: 200 !important;
  background: rgba(8, 1, 1, 0.1);
  padding: 2% 0;
  float: left;

}

#rightplayerCard {
  width: 50%;
  text-align: center;
  font-weight: 200 !important;
  background: rgba(8, 1, 1, 0.1);
  padding: 2% 0;
  margin-left: 50%;
}

#playerCard h3 {
  font-weight: 200 !important;
  font-size: 4rem;
}

#tester {
  width: 100%
}

.svg-container {
  width: 100% !important;
}

.main-svg {
  width: 100% !important;
}

@keyframes jump {
  0%   {transform: translate3d(0,0,0) scale3d(1,1,1);}
  40%  {transform: translate3d(0,30%,0) scale3d(.7,1.5,1);}
  100% {transform: translate3d(0,100%,0) scale3d(1.5,.7,1);}
}
.jump {
  transform-origin: 50% 50%;
  animation: jump .5s linear alternate;
  animation-iteration-count: 4;
}

#newPlayerCard {
  text-align: center;
  font-weight: 100 !important;
  background: rgba(8, 1, 1, 0.1);
  padding: 2% 0;
}

.sectionHeader {
  font-size: 40px;
  -webkit-text-size-adjust: none;

}

.values {
  font-size: 80px;
  -webkit-text-size-adjust: none;
  margin-top: 0;
}

.dateSelection {
  -webkit-appearance: none;
  -moz-appearance:        none;
  -ms-appearance:         none;
  -o-appearance:          none;
  appearance:             none;
  background: black;
      font-size: 2rem !important;
}

.username {
  margin-top: 0;
  -webkit-text-size-adjust: none;
  font-size: 40px;
}
</style>

</html>
