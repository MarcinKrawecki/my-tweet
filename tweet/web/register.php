<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach (glob("../src/*.php") as $filename) {
        require_once $filename;
    }

    $pole = new tweetDb();
    $pole->createDatabaseIfNotExist('Tweet');

    user::$conn = $pole->getConn();
    $user=new user();
    $user->setUsername($_POST['name']);
    $user->setEmail($_POST['email']);
    $user->setUserPassword($_POST['password']);
    $user->saveToDB();
    
    header("Location: ../web/main.php"); 
    
    
}
?>
<html>
    <body>
        <h1>Zarejstuj sie do Tweet'a</h1>


        <form action = "register.php" method="POST">
            
            Name:<br>
            <input type = "text" name = "name" placeholder="user_name">
            <br>
            
            Email:<br>
            <input type = "text" name = "email" placeholder="user_email">
            <br>
            Password:<br>
            <input type = "password" name = "password" placeholder="user_password">
            <br><br>
            <input type = "submit" value = "Zarejestruj">
        </form>
        <a href="index.php">logowanie</a>
    </body>
</html>


