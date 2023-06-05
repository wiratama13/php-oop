<?php

require_once 'database.php';

if ($user->isLoggedIn()) {
    if ($_SESSION['level'] == 'admin') {
        header("location: admin.php");
    }

    if ($_SESSION['level'] == 'user') {
        header("location: user.php");
    }

    if ($_SESSION['level'] == '') {
        header("location: index.php");
    }
}


if (isset($_POST['kirim'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    if ($user->login($email, $password)) {

        if ($_SESSION['level'] == 'admin') {
            header("location: admin.php");
        }

        if ($_SESSION['level'] == 'user') {
            header("location: user-page.php");
        }

        if ($_SESSION['level'] == '') {
            header("location: index.php");
        }
    } else {
        // jika gagal ambil pesan error
        $error = $user->getLastError();
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="login-page">
        <div class="form">
            <form method="post" class="login-form">

                <?php if (isset($error)) : ?>
                    <div class="error">
                        <?php echo $error ?>
                    </div>

                <?php endif; ?>

                <input type="email" class="form-control my-3" name="email" placeholder="email required" />
                <input type="password" class="form-control my-3" name="password" placeholder="password required" />




                <button class="btn btn-success w-100" type="submit" name="kirim">login</button>
                <p class="message"> Not registered? <a href="register.php">Create an account</a> </p>
            </form>
        </div>
    </div>

</body>

</html>