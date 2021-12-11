<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>java</title>
</head>
<body>
    <h1>WELCOME TO THE java</h1>
    <h1>
        <?php 
        
        session_start();
        if($_SESSION['auth']){
        echo $_SESSION['login'];}
        
        ?>
        <button onclick =" location.href = 'profile.php'">Change profile data</button>
</body>
</html>