<?php
    session_start();
    $server = 'localhost'; // Имя или адрес сервера
    $user = 'root'; // Имя пользователя БД
    $password = ''; // Пароль пользователя
    $dbname = 'users'; // Название БД
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $link = mysqli_connect($server, $user, $password, $dbname); // Подключение
    $_SESSION['ll'] = $link;
    //starting a session
    

    //if user is authorized, outputing his data into $res variable
    if($_SESSION['auth']){
        
    //output the login
    echo"<h1>username:{$_SESSION['login']}</h1>";
    $query = 'SELECT*FROM users WHERE username="'.$_SESSION['login'].'"';
    $result = mysqli_query($link, $query); //ответ базы запишем в переменную $result. 
    $res = mysqli_fetch_array($result);
    echo"<form method='post'>";
    echo"<h1>name:<input name = 'new_name' value = '{$res[1]}'</h1>"; 
    echo"<h1>surname:<input name = 'new_surname' value = '{$res[2]}'</h1>";  
    echo"<h1>street<input name = 'new_street' value = '{$res[5]}'</h1>";
    echo"<h1>house number<input name = 'new_house' value = '{$res[6]}'</h1>";    
    echo"<h1>apartment<input name = 'new_apartment' value = '{$res[7]}'</h1>";  
    echo"<h1>phone number<input name = 'new_phone' value = '{$res[9]}'</h1>";          
    echo"<button name = 'deleteAccount' id = 'deleteAccount' value = 'RUN'>Delete</button>";
    echo"</form>";
}
    if(array_key_exists('deleteAccount',$_POST)){
    deleteAccount();
    }
    if(array_key_exists('updateData',$_POST)){
        updateData();
        }
   
    
        function updateData(){
        $name = $_POST['new_name']; 
        $surname = $_POST['new_surname']; 
        $street = $_POST['new_street']; 
        $house = $_POST['new_house']; 
        $apartment = $_POST['new_apartment']; 
        $phone = $_POST['new_phone'];
        mysqli_query($_SESSION['ll'],
        "UPDATE users 
        SET name = '{$name}', 
        surname = '{$surname}',
        street = '{$street}',
        house_number = '{$house}',
        apartment = '{$apartment}',
        phone_number = '{$phone}'
        WHERE username = '{$_SESSION['login']}'");
        echo("<h1 margin-top:'100'>data changed succesfully</h1>");
        }

        function deleteAccount(){
           mysqli_query($_SESSION['ll'],'DELETE FROM users WHERE username = "'.$_SESSION['login'].'"');
           echo"<script>alert('succesfully destroyed';)</script>"; 
           session_destroy();
           header('Location: authorization.php');
        }
        /*function deleteAccount(){
            $name = $_POST['new_name']; 
            $surname = $_POST['new_surname']; 
            $street = $_POST['new_street']; 
            $house = $_POST['new_house']; 
            $apartment = $_POST['new_apartment']; 
            $phone = $_POST['new_phone'];
            mysqli_query($_SESSION['ll'],
            "UPDATE users 
            SET name = '{$name}', 
            surname = '{$surname}',
            street = '{$street}',
            house_number = '{$house}',
            apartment = '{$apartment}',
            phone_number = '{$phone}'
            WHERE username = '{$_SESSION['login']}'");
            }
    */
        
      
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button name="updateData" id="updateData" value="RUN">Save the changes</button>
    <button>Change the password</button>
    
</body>
</html>