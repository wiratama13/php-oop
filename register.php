<?php

require_once "database.php";

if ($user->isLoggedIn()) {
    header("location: index.php");
}

if (isset($_POST['kirim'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    if ($user->register($name, $email, $password, $level)) {
        $success = "<p>registrasi sukses, silahkan login</p>";
    } else {
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
    <title>Register</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"> -->
</head>
<link rel="stylesheet" href="style.css">

</head>

<body>
    <div class="login-page">
        <div class="form">
            <form method="post" class="register-form">
                <?php if (isset($error)) : ?>
                    <div class="error">
                        <?php echo $error ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($success)) : ?>
                    <div class="success">
                        <?php echo $success ?>
                    </div>
                <?php endif; ?>

                <input type="text" name="name" class="form-control my-3" placeholder="name" required />
                <input type="email" name="email" class="form-control my-3" placeholder="email address" required />
                <input type="password" name="password" class="form-control my-3" placeholder="password" required />
                <select name="level" class="form-select my-3">
                    <option value="none" selected>-- pilih akses --</option>
                    <option value="admin">admin</option>
                    <option value="user">user</option>
                </select>
                

                <button type="submit" class="btn btn-success w-100" name="kirim">create</button>
                <p class="message">Already registered? <a href="login.php">Sign In</a></p>

            </form>
        </div>
    </div>
</body>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script> -->
<script>
   
</script>

</html>