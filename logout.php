<?php

require_once "database.php";

$user->logout();

header('location: login.php');
?>