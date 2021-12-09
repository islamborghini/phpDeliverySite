<?php
    
    //starting of the session
    session_start(); 

    //if button submitData is clicked =>{}
    //bd connection
    if (isset($_POST['submitData'])){ 
    $server = 'localhost'; 
    $user = 'root'; 
    $password = ''; 
    $dbname = 'users'; 
    $link = mysqli_connect($server, $user, $password, $dbname); 


    if (!$link) {
       //if not connected ==> output
        echo "Unable to connect to BD"; 
    }
    // соединение с бд
    $err = [];
//checking the login to make it right format
$login = stripslashes(htmlspecialchars(trim($_POST['user_login'])));
if(!preg_match("/^[a-zA-Z0-9]+$/", $login)){
  $err[] = "Login can be made only of letters and numbers"; // проверка логина на формат 
}
if(strlen($login) < 3 or strlen($login)>30){
  $err[] = "Login should contain more than 3 and less than 30 charachters";
}

//checking to the login for it's uniqueness
$query = mysqli_query($link, "SELECT username FROM `users` WHERE username='".mysqli_real_escape_string($link, $login)."'");  
if(mysqli_num_rows($query) > 0)
    {
        $err[] = "Пользователь с таким логином уже существует в базе данных";
    }

    //if login is unique, then inputing the password and username
if(count($err) == 0)
    {
      $password = md5(md5(trim($_POST['pass'])));
      $userName = stripslashes(htmlspecialchars(trim($_POST['user_name']))) ;
      $surname = stripslashes(htmlspecialchars(trim($_POST['user_surname']))) ;
      $email = stripslashes(htmlspecialchars(trim($_POST['user_email']))) ;
      $street = stripslashes(htmlspecialchars(trim($_POST['user_street']))) ;
      $house = stripslashes(htmlspecialchars(trim($_POST['user_house']))) ;
      $apartment = stripslashes(htmlspecialchars(trim($_POST['user_apartment']))) ;
      $phone = stripslashes(htmlspecialchars(trim($_POST['user_phone']))) ;
      $date_of_registration = date("Y/m/d");
        mysqli_query($link,"INSERT INTO users VALUES('".$login."',
        '".$userName."', '".$surname."','".$email."',
        '".$password."', '".$street."', 
        '".$house."',  '".$apartment."',
         false, '".$phone."', 
        '".$date_of_registration."' )");
        echo '<p style="font-size: 32px;">Registration success.</p> 
        <a href="index.php"><h1 position:relative; top:100px; left: 100px;">
        На главную</h1></a>';
         exit();/*echo("login:".$login." ".
        "name:".$userName." ".
        "surname:".$surname." ". 
        "email:".$email." ".
        "password:".$password." ".
        "street:".$street." ". 
        "house_number:".$house." ".
        "apartment:".$apartment." ".
        "phone:".$phone." ".
        "date:".$date_of_registration);*/
    }
    else
    {
        //errors during the registrations
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>"; //вывод массивов с ошибками
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>FastPizza </title>
	<link rel="SHORTCUT ICON" href="img/pizza.png" type="image/x-icon">
	<link rel="stylesheet" href="rega.css">
</head>
<body>
	<header>
    	
    	<div class="logo">
    	<a style="font-size:22px;"><b><span class="topspan">Java</span></b></a>
    	</div>

	
    	<ul class="topnavs">
      		<li class="nav-item"><a href="index.php" class="nav-link active">About</a></li>
      		<li class="nav-item"><a href="menu.php" class="nav-link" >Menu</a></li>
      		<li class="nav-item"><a href="contacts.php" class="nav-link">Address</a></li>
             <li class="nav-item"><a href="aut.php" class="nav-link">Sign in</a></li>

    	</ul>
  </header>
  <!--Registration form-->
  <div class="wrapper">
  	<form action="" method="POST">
  		<p>Username
              <input type="text" name = "user_login" class="inp_log" style="margin-left: 37px;">
        </p>
        <p>Email
            <input type="text" name = "user_email" class="inp_log" style="margin-left: 65px;">
        </p>
        <p class="inp_reg">Name
            <input type="text" name = "user_name" style="margin-left: 65px;">
        </p>
        <p class="inp_reg">Surname
            <input type="text" name = "user_surname" class="int" style="margin-left: 45px;">
        </p>
            <div class="passinput">
            <p>Пароль<input id = "psswrd" name = "pass" type="password" style="margin-left: 55px;" ></p>
                <input type = "checkbox" class="show" onclick="pashow()">
        </div>
        <p>Delivery Information</p>
        <p class="inp_reg">Street
            <input type="text" name = "user_street" class="int" style="margin-left: 45px;">
        </p>
        <p class="inp_reg">House number
            <input type="text" name = "user_house" class="int" style="margin-left: 45px;">
        </p>
        <p class="inp_reg">Apartment
            <input type="text" name = "user_apartment" class="int" style="margin-left: 45px;">
        </p>
        <p class="inp_reg">Phone Number
            <input type="text" name = "user_phone" class="int" style="margin-left: 45px;">
        </p>
        <p>Show the password</p>
            <button class="login" name ="submitData">Sign up</button>

        <!--show password script-->
        <script>
        function pashow()
        {
        var show = document.getElementById("psswrd");
        if (show.type === "password") {
        show.type = "text";
        } else {
        show.type = "password";
        }
        }
        </script> 
  	</form>
  	
  </div>
</body>
</html>

