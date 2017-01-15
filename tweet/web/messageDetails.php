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



$messages = messages::loadMessagesById($_GET['message_id']);
if($messages->getUserIdReciver()==$_SESSION['zalogowany'] || $messages->getUserIdSender()==$_SESSION['zalogowany']){
    echo '<a href="messageView.php">powrot do wiadomosci </a>';
    var_dump($messages);
} else { 
   header("Location: ../web/messageView.php");

}

