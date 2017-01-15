<?php

foreach (glob("../src/*.ph*") as $filename) {
    require_once $filename;
}

$pole = new tweetDb();
$pole->createDatabaseIfNotExist("Tweet");

$user1 = new user('John', '1234', 'john@co.uk');
$user1->saveToDB();
$user1 = new user('Ann', '5678', 'ann@co.uk');
$user1->saveToDB();
$user1 = new user('Adam', '9012', 'adam@co.uk');
$user1->saveToDB();

$news = new news('new news1', 1);
$news->saveToDB();
$news = new news('new news2', 2);
$news->saveToDB();
$news = new news('new news3', 3);
$news->saveToDB();

$comments1 = new comments('something', 1, 2);
$comments1->saveToDB();
$comments2 = new comments('anything', 2, 3);
$comments2->saveToDB();
$comments3 = new comments('nothing', 3, 1);
$comments3->saveToDB();

$messages1 = new messages('text1', 1, 2);
$messages1->saveToDB();
$messages2 = new messages('text2', 2, 3);
$messages2->saveToDB();
$messages3 = new messages('text3', 3, 1);
$messages3->saveToDB();



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

