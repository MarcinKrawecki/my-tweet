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
messages::$conn = $pole->getConn();



$messages = messages::loadAllMessagesRelatedToUserId($_SESSION['zalogowany']);
?>

<html>
    <head>

    </head>

    <body>
        <h2>
            Zalogowany uzytkownik <?php echo $_SESSION['user_email'];
?>

        </h2>
        <a href="main.php">strona glowna</a>

        <table border="1"> 
            <?php
            foreach ($messages as $messageRecord) {
                echo '<tr>';

                echo '<td>';
                echo '<a href="messageDetails.php?message_id=' . $messageRecord->getId() . '">' . $messageRecord->getId() . '</a>';
                echo '</td>';

                echo '<td>';
                echo $messageRecord->getCreationDate();
                echo '</td>';

                echo '<td>';
                echo substr($messageRecord->getContent(), 0, 30);
                echo '</td>';


                echo '<td>';
                $user = user::loadUserById($messageRecord->getUserIdSender());
                echo $user->getEmail();
                echo '</td>';

                echo '<td>';
                $user = user::loadUserById($messageRecord->getUserIdReciver());
                echo $user->getEmail();
                echo '</td>';


                echo '</tr>';
            }
            ?>
        </table>
    </body>
</html>

