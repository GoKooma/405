<?php
include 'password.php';
$servername = "localhost";
$username = "brianpo3_tester";
$dbname = "brianpo3_tester";

$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

$sql= "SELECT * FROM `bme405userpass`";

$qry = $pdo->query($sql);
$result = $qry->fetchAll();
$count = count($result) - 1;

?>

<html>
<head>
<title>BME 405</title>
</head>

<body>
<img src="/405/sprites/<?php echo rand(1,11); ?>.png" height="200">
<div class="typewriter">
  <h1 id = "testDiv">MyGIBuddy</h1>
</div>

<br>
  <form id="form" action="home.php" method="post">

    <input class="field" id="userField" type="text" name="user" value="USERNAME" onblur="if(this.value==''){ this.value='USERNAME'; this.style.color='#BBB';}"
    onfocus="if(this.value=='USERNAME'){ this.value=''; this.style.color='#FFF';}" autocapitalize="off">

    <br>
    <input class="field" id="passField" type="password" name="pass" value="PASSWORD"onblur="if(this.value==''){ this.value='PASSWORD'; this.style.color='#BBB';}"
    onfocus="if(this.value=='PASSWORD'){ this.value=''; this.style.color='#FFF';}" autocapitalize="off">
    <br><br><br><br>
    <input id="button" type="submit" value="LOGIN"><br><br>
    <input id="buttonReg" type="submit" value="REGISTER">
  </form>
  <h2 id="errorMessage"></h2>


</body>

<script>

//Declarations
const button = document.querySelector('#button');
const buttonReg = document.querySelector('#buttonReg');
const userField = document.querySelector('#userField');
const passField = document.querySelector('#passField');
const testDiv = document.querySelector('#testDiv');
const form = document.getElementById("form");
const array = <?php echo json_encode($result); ?>;
const errorMessage = document.getElementById('errorMessage');
let matchUser = 0;
let matchPass = 0;
//When click submit event
button.addEventListener("click", function(event) {

  //Prevent default
  event.preventDefault();

  //Match username
  for (let i = 0; i < (array.length); i++) {
    if (userField.value == array[i]['user']) {
      matchUser = 1;
    }
  }

  //Match password
  for (let j = 0; j < (array.length); j++) {
    if (passField.value == array[j]['pass']) {
      matchPass = 1;
    }
  }

  //If both match
  if (matchUser==1 && matchPass==1) {
    errorMessage.textContent = "Ok";
    form.submit();
  } else {
    errorMessage.textContent = "Incorrect username or password";
  }

  matchUser = 0;
  matchPass = 0;

});

buttonReg.addEventListener("click", function(event){
  form.action="/405/register.php";
  form.submit();
});


</script>

<style>


img {
    /* Start the shake animation and make the animation last for 0.5 seconds */
    animation: shake 0.5s;
    /* When the animation is finished, start again */
    animation-iteration-count: infinite;
}

@keyframes shake {
    0% { transform: translate(1px, 1px) rotate(0deg); }
    10% { transform: translate(-1px, -2px) rotate(-1deg); }
    20% { transform: translate(-3px, 0px) rotate(1deg); }
    30% { transform: translate(3px, 2px) rotate(0deg); }
    40% { transform: translate(1px, -1px) rotate(1deg); }
    50% { transform: translate(-1px, 2px) rotate(-1deg); }
    60% { transform: translate(-3px, 1px) rotate(0deg); }
    70% { transform: translate(3px, 1px) rotate(-1deg); }
    80% { transform: translate(-1px, -1px) rotate(1deg); }
    90% { transform: translate(1px, 2px) rotate(0deg); }
    100% { transform: translate(1px, -2px) rotate(-1deg); }
}

body {
  background: linear-gradient(225deg, #676767, #2f2f2f);
  text-align: center;
  font-family: 'Courier New';
  color: white;
}

input {
    font-size: 2.5rem;
    border-radius: 0;
}

.field {
  background: none;
  border: none;
  border-bottom: 1px solid white;
  color: white;
  font-family: 'Courier New';
}

#testDiv {
  font-weight: 200;
  font-size: 2.5rem;
}

#button {
	background: none;
	color: inherit;
	border: none;
	padding: 0;
	font: inherit;
	cursor: pointer;
	outline: inherit;
  font-size: 2rem;
  background: #1619277d;
  width: 50%;
  height: 7%;
  -webkit-appearance: none;

}

#buttonReg {
	background: none;
	color: inherit;
	border: none;
	padding: 0;
	font: inherit;
	cursor: pointer;
	outline: inherit;
  font-size: 2rem;
  background: #1619277d;
  width: 50%;
  height: 7%;
  -webkit-appearance: none;
}

@media only screen
  and (min-device-width: 375px)
  and (max-device-width: 667px)
  and (-webkit-min-device-pixel-ratio: 2) {
    img {
      margin-top: 30%;
    }
}

.typewriter h1 {
  overflow: hidden; /* Ensures the content is not revealed until the animation */
  white-space: nowrap; /* Keeps the content on a single line */
  margin: 0 auto; /* Gives that scrolling effect as the typing happens */
  letter-spacing: .15em; /* Adjust as needed */
  animation:
    typing 3s steps(40, end)
}

/* The typing effect */
@keyframes typing {
  from { width: 0 }
  to { width: 100% }
}


}
</style>

</html>
