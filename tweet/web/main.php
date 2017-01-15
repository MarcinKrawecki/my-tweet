<?php
session_start();
if (!isset($_SESSION['zalogowany'])) {
    header("Location: ../web/index.php");
}

foreach (glob("../src/*.php") as $filename) {
    require_once $filename;
}

$pole = new tweetDb();
$pole->createDatabaseIfNotExist('Tweet');
news::$conn = $pole->getConn();
user::$conn = $pole->getConn();
       
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $news1 = htmlspecialchars($_POST['news'], ENT_QUOTES);
    $news = new news($news1, $_SESSION['zalogowany']);
    $news->saveToDB();
}

$news = news::loadAllNews();
?>   


<html>
    <head>

    </head>

    <body>
        <h2>
            Zalogowany uzytkownik <?php echo $_SESSION['user_email']; ?>

        </h2>
        <a href="logout.php">wyloguj</a>
        <a href="messageView.php">zobacz wiadomosci </a>
        
        <form action = "main.php" method="POST">
            news:<br>
            <input type="text" name="news"><br>
            <input type="submit" value="Submit">
        </form>
        <table border="1"> 
            <?php
            foreach ($news as $newsRecord) {
                echo '<tr>';

                echo '<td>';
                echo $newsRecord->getId();
                echo '</td>';

                echo '<td>';
                echo $newsRecord->getCreationDate();
                echo '</td>';

                echo '<td>';
                echo $newsRecord->getContent();
                echo '</td>';

                echo '<td>';
                $user = user::loadUserById($newsRecord->getUserId());
                echo  '<a href="messageSender.php?user_id='.$user->getId().'">'.$user->getEmail().'</a>';
                echo '</td>';

                echo '</tr>';
                
            }
            ?>
        </table>
    </body>
</html>
