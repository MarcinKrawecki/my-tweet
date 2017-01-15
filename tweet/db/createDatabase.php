<?php

require_once '../polaczenie.php';

$pole = new tweetDb();
$pole->createDatabaseIfNotExist('Tweet');

$pole->createTableIfNotExist('users');
$pole->addColumn('users', ['user_name', 'varchar(255)']);
$pole->addColumn('users', ['user_email', 'varchar(64)', 'UNIQUE']);
$pole->addColumn('users', ['user_password', 'varchar(32)']);

$pole->createTableIfNotExist('news');
$pole->addColumn('news', ['content', 'varchar(140)']);
$pole->addColumn('news', ['user_id', 'integer']);
$pole->addColumn('news', ['creation_date', 'datetime']);
$pole->addForeignKey("news", "user_id", "users", "id");

$pole->createTableIfNotExist('coments');
$pole->addColumn('coments', ['content', 'varchar(60)']);
$pole->addColumn('coments', ['user_id', 'integer']);
$pole->addColumn('coments', ['news_id', 'integer']);
$pole->addColumn('coments', ['creation_date', 'datetime']);
$pole->addForeignKey("coments", "user_id", "users", "id");
$pole->addForeignKey("coments", "news_id", "news", "id");

$pole->createTableIfNotExist('messages');
$pole->addColumn('messages', ['content', 'text']);
$pole->addColumn('messages', ['user_id_sender', 'integer']);
$pole->addColumn('messages', ['user_id_reciver', 'integer']);
$pole->addColumn('messages', ['creation_date', 'datetime']);
$pole->addColumn('messages', ['messege_read', 'integer']);
$pole->addForeignKey("messages", "user_id_sender", "users", "id");
$pole->addForeignKey("messages", "user_id_reciver", "users", "id");
