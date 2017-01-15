<?php
session_start();
if (isset( $_SESSION['zalogowany'])) {
    header("Location: ../web/main.php");
}else{
 echo 'incorrect username/ password please try again.' ;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach (glob("../src/*.php") as $filename) {
        require_once $filename;
    }

    $pole = new tweetDb();
    $pole->createDatabaseIfNotExist('Tweet');

    user::$conn = $pole->getConn();
    $user = user::loadUserByEmail($_POST['email']);
    //sprawdz czy user jest null jesli jest to index! 
    if ($user->getUserPassword() == md5($_POST['password'])) {
        $_SESSION['zalogowany'] = $user->getId();
        $_SESSION['user_email']= $_POST['email'];
                header("Location: ../web/main.php");
    } else {
        echo 'blad logowania';
        header("Location: ../web/register.php");
        
    }
}
?>
<html>
    <body>
        <h1>Logowanie do Tweet'a</h1>

        <form action = "index.php" method="POST">
            Email:<br>
            <input type = "text" name = "email" placeholder="email">
            <br>
            Password:<br>
            <input type = "password" name = "password" placeholder="password">
            <br><br>
            <input type = "submit" value = "Zaloguj">
        </form>
        <a href='register.php'>rejestracja</a>
    </body>
</html>
