<?php

require_once "database.php";

if(!$user->isLoggedIn()){
    header("location: login.php");
}

$currentUser = $user->getUser();

if ($_SESSION['level'] != 'user') {
    die("anda bukan user");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="info">
            <h1> Halo, <?php echo $currentUser['name'] ?> anda login sebagai user
        <br>
        login kembali agar  bisa melakukan edit data
    </h1>
        </div>

        <a href="logout.php" class="d-flex justify-content-center align-items-center">
            <button type="button" class="btn btn-success px-5 py-2">Logout</button>
        </a>
    </div>
</body>
</html>