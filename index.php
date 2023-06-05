<?php

require_once "database.php";


if (!$user->isLoggedIn()) {
    return header("location: login.php");
}

if ($user->isLoggedIn()) {

    if($_SESSION['level'] == 'admin')
    {
        return header("location: admin.php");
    }

    if($_SESSION['level'] == 'user')
    {
        return header("location: user.php");
    }
}

$currentUser = $user->getUser();

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
            <h1>Selamat datang <?php echo $currentUser['name'] ?></h1>
            Mohon maaf anda tidak memiliki akses, silahkan login dengan akun admin
        </div>

        <a href="logout.php" class="d-flex justify-content-center align-items-center">
            <button class="btn btn-success px-5 py-2">Logout</button>
        </a>
    </div>
</body>

</html>