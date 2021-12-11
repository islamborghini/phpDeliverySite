<?php

    // Функция для генерации случайной строки
/*function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}*/

    session_start(); //начало сессии
    if (isset($_POST['submitData'])){ //код выполняется при нажатии на кнопку
    $server = 'localhost'; // Имя или адрес сервера
    $user = 'root'; // Имя пользователя БД
    $password = ''; // Пароль пользователя
    $dbname = 'users'; // Название БД
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = mysqli_connect($server, $user, $password, $dbname); // Подключение
    // соединение с бд

    if (!$link) {
        // Если проверку не прошло, то выводится надпись ошибки и заканчивается работа скрипта
        echo "Не удалось подключиться к базе данных"; 
    }
  if(isset($_POST['submitData']))
  {
    $login = $_POST['logint']; 
    $password = md5(md5(trim($_POST['passint']))); 
    /*
      Формируем и отсылаем SQL запрос:
      ВЫБРАТЬ ИЗ таблицы_users ГДЕ поле_логин = $login И поле_пароль = $password.
    */
    $query = 'SELECT*FROM users WHERE username="'.$login.'" AND password="'.$password.'"';
    $result = mysqli_query($link, $query); //ответ базы запишем в переменную $result. 
    $user = mysqli_fetch_assoc($result); //преобразуем ответ из БД в нормальный массив PHP
    //Если база данных вернула не пустой ответ - значит пара логин-пароль правильная
    if (!empty($user)) {
      //Стартуем сессию:
      session_start(); 
      //Пишем в сессию информацию о том, что мы авторизовались:
      $_SESSION['auth'] = true; 
      //Пишем в сессию логин и id пользователя (их мы берем из переменной $user!):
      $_SESSION['id'] = $user['id']; 
      $_SESSION['login'] = $login; 
      sleep(5);
      header('Location: index.php');
    } else {
      echo"Неправильный логин или пароль";

    }

  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>JAVA </title>
	<link rel="SHORTCUT ICON" href="img/pizza.png" type="image/x-icon">
	<link rel="stylesheet" href="auto.css">
</head>
<body>
	<header>
    	
    	<div class="logo">
    	<a><span class="topspan">JAVA</span>	</a>
    	</div>

	
    	<ul class="topnavs">
      		<li class="nav-item"><a href="index.php" class="nav-link active">О ресторане</a></li>
      		<li class="nav-item"><a href="menu.php" class="nav-link" >Меню</a></li>
      		<li class="nav-item"><a href="contacts.php" class="nav-link">Контакты</a></li>
             <li class="nav-item"><a href="aut.php" class="nav-link">Войти</a></li>

    	</ul>
  </header>
  <div class="wrapper">

  <!--form for input-->
  	<form action="" method="POST">
  		<p>Логин:<input type="text" class="inp_log" name="logint"></p>
  		<p class="inp_reg">Password:<input type="password" name="passint" id="psswrd"></p>
       <input type = "checkbox" class="show" onclick="pashow()" style="height: 50px; width: 50px; position: relative; left: 400px;">
      <p style="margin-top: -60px">Show the password</p>
  		<button class="login" name ="submitData">Sign in</button>
     

  	<a href="registration.php">Create an account</a>
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