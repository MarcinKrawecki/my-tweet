<?php
session_start();

unset($_SESSION['zalogowany']);
unset($_SESSION['user_email']);

header("Location: ../web/index.php");

