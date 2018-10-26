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

$user = $_POST['user'];
$pass = $_POST['pass'];


?>

<html>
<head>
  <title>BME 405</title>
  <script src="plotly-latest.min.js"></script>
  <style>
    .container {
      display: flex;
      flex-wrap: wrap;
    }

    .container > div {
      margin: 20px;
      padding: 20px;
      width: 200px;
    }
  </style>
</head>

<body>
  <img src="/405/sprites/<?php echo rand(1,11); ?>.png" height="200">
<div class="typewriter">
    <h1 id="testDiv">MyGIBuddy</h1>
</div>
<h1 id = "testDiv">WELCOME, NEW USER</h1>
  <form id="form" action="/405/thanks.php" method="post">
<br>
    <input class="field" id="userField" type="text" name="user" value="<?php echo $user; ?>" onblur="if(this.value==''){ this.value='username'; this.style.color='#BBB';}"
    onfocus="if(this.value=='username'){ this.value=''; this.style.color='#FFF';}" autocapitalize="off">
    <br>
<br>
    <input class="field" id="passField" type="password" name="pass" value="<?php echo $pass; ?>" onblur="if(this.value==''){ this.value='password'; this.style.color='#BBB';}"
    onfocus="if(this.value=='password'){ this.value=''; this.style.color='#FFF';}" autocapitalize="off">
    <br>
<br>
    <input class="field" id="email" type="text" name="email" value="E-MAIL" onblur="if(this.value==''){ this.value='E-MAIL'; this.style.color='#BBB';}"
    onfocus="if(this.value=='E-MAIL'){ this.value=''; this.style.color='#FFF';}" autocapitalize="off">
    <br>
<br>
    <input class="field" id="age" type="text" name="age" value="AGE" onblur="if(this.value==''){ this.value='AGE'; this.style.color='#BBB';}"
    onfocus="if(this.value=='AGE'){ this.value=''; this.style.color='#FFF';}" autocapitalize="off">
    <br><br>
    <h1 id = "testDiv">CHOOSE SPRITE</h1>
    <div class="container">
         <div>
           <input checked="checked" id="sprite1" type="radio" name="spriteNumber" value="1"/>
           <label class="drinkcard-cc sprite1" for="sprite1"></label>
           <br>
         </div>
         <div>
           <input id="sprite2" type="radio" name="spriteNumber" value="2" />
           <label class="drinkcard-cc sprite2"for="sprite2"></label>
           <br>
         </div>
         <div>
           <input id="sprite3" type="radio" name="spriteNumber" value="9" />
           <label class="drinkcard-cc sprite3"for="sprite3"></label>
           <br>
         </div>
         <div>
           <input id="sprite4" type="radio" name="spriteNumber" value="4" />
          <label class="drinkcard-cc sprite4"for="sprite4"></label>
          <br>
         </div>
         <div>
           <input id="sprite5" type="radio" name="spriteNumber" value="5" />
           <label class="drinkcard-cc sprite5"for="sprite5"></label>
           <br>
         </div>
         <div>
           <input id="sprite6" type="radio" name="spriteNumber" value="6" />
           <label class="drinkcard-cc sprite6"for="sprite6"></label>
           <br>
         </div>
         <div>
           <input id="sprite7" type="radio" name="spriteNumber" value="7" />
           <label class="drinkcard-cc sprite7"for="sprite7"></label>
           <br>
         </div>
         <div>
           <input id="sprite8" type="radio" name="spriteNumber" value="8" />
           <label class="drinkcard-cc sprite8"for="sprite8"></label>
           <br>
         </div>
         <div>
           <input id="sprite9" type="radio" name="spriteNumber" value="9" />
         <label class="drinkcard-cc sprite9"for="sprite9"></label>
         <br>
         <div>
           <input id="sprite10" type="radio" name="spriteNumber" value="10" />
           <label class="drinkcard-cc sprite10"for="sprite10"></label>
           <br>
         <div>
           <input id="sprite11" type="radio" name="spriteNumber" value="11" />
           <label class="drinkcard-cc sprite11"for="sprite11"></label>
         </div>
     </div>
    <input id="button" type="submit" value="REGISTER">
  </form>

  <h2 id="errorMessage"></h2>



</body>

<script>
const form = document.getElementById('form');
const userField = document.getElementById('userField');
const passField = document.getElementById('passField');
const emailField = document.getElementById('email');
const ageField = document.getElementById('age');
const button = document.getElementById('button');
const errorMessage = document.getElementById('errorMessage');
const array = <?php echo json_encode($result); ?>;
let matchUser = 0;

button.addEventListener("click", function(event) {

  //Prevent default
  event.preventDefault();

  for (let i = 0; i < (array.length); i++) {
    if (userField.value == array[i]['user']) {
      matchUser = 1;
    }
  }

  //Check if each field is filled;
  if (userField.value && passField.value && emailField.value && ageField.value && matchUser == 0) {
    form.submit();
  } else if (matchUser == 1) {
    errorMessage.textContent = "Username already taken";
    matchUser = 0;
  } else {
    errorMessage.textContent = "Please enter all information";
  }



})


</script>

<style>

body {
  background: #272727;
  color: white;
  font-family: 'Helvetica';
}
.cc-selector input{
    margin:0;padding:0;
    -webkit-appearance:none;
       -moz-appearance:none;
            appearance:none;
}

.sprite1{background-image:url(http://brianpow.us/405/sprites/1.png);}
.sprite2{background-image:url(http://brianpow.us/405/sprites/2.png);}
.sprite3{background-image:url(http://brianpow.us/405/sprites/3.png);}
.sprite4{background-image:url(http://brianpow.us/405/sprites/4.png);}
.sprite5{background-image:url(http://brianpow.us/405/sprites/5.png);}
.sprite6{background-image:url(http://brianpow.us/405/sprites/6.png);}
.sprite7{background-image:url(http://brianpow.us/405/sprites/7.png);}
.sprite8{background-image:url(http://brianpow.us/405/sprites/8.png);}
.sprite9{background-image:url(http://brianpow.us/405/sprites/9.png);}
.sprite10{background-image:url(http://brianpow.us/405/sprites/10.png);}
.sprite11{background-image:url(http://brianpow.us/405/sprites/11.png);}


.drinkcard-cc, .cc-selector input:active +.drinkcard-cc{opacity: .9;}
.drinkcard-cc, .cc-selector input:checked +.drinkcard-cc{
    -webkit-filter: none;
       -moz-filter: none;
            filter: none;
}
.drinkcard-cc{
    cursor:pointer;
    background-size:contain;
    background-repeat:no-repeat;
    display:inline-block;
    width: 200px;
    height: 200px;
    -webkit-transition: all 100ms ease-in;
       -moz-transition: all 100ms ease-in;
            transition: all 100ms ease-in;
    -webkit-filter: brightness(1.8) grayscale(1) opacity(.7);
       -moz-filter: brightness(1.8) grayscale(1) opacity(.7);
            filter: brightness(1.8) grayscale(1) opacity(.7);
}
.drinkcard-cc:hover{
    -webkit-filter: brightness(1.2) grayscale(.5) opacity(.9);
       -moz-filter: brightness(1.2) grayscale(.5) opacity(.9);
            filter: brightness(1.2) grayscale(.5) opacity(.9);
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
      margin-top: 5%;
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


</style>

</html>
