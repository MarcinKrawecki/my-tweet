<?php
session_start();
if (!isset($_SESSION['zalogowany'])) {
    header("Location: ../web/index.php");
}

foreach (glob("../src/*.php") as $filename) {
    require_once $filename;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pole = new tweetDb();
    $pole->createDatabaseIfNotExist('Tweet');
    messages::$conn = $pole->getConn();

    $message1 = htmlspecialchars($_POST['content'], ENT_QUOTES);
    $message = new messages($message1, $_POST['from'], $_POST['to']);
    $message->saveToDB();
    header("Location: ../web/main.php");
}


if (!isset($_GET['user_id'])) {
    header("Location: ../web/index.php");
}

if ($_GET['user_id'] === $_SESSION['zalogowany']) {
    header("Location: ../web/index.php");
}

?>
<html>
    <body>

        <form action="messageSender.php" method="POST">
            <input type='hidden' name='from' value="<?php echo $_SESSION['zalogowany']; ?>">
            <input type='hidden' name='to' value="<?php echo $_GET['user_id']; ?>">
            <input type='text' name='content'>
            <input type="submit" value="wyslij wiadomosc">
        </form>

    </body>


</html>

