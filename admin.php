<?php

require_once "database.php";

if (!$user->isLoggedIn()) {
    header("location: login.php");
}

if ($_SESSION['level'] != 'admin') {
    die("anda bukan admin");
}

$currentUser = $user->getUser();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $status_hapus = $user->delete($id);
    if ($status_hapus) {
        header('Location: index.php');
    }
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
            <h1>Selamat datang <?= $currentUser['name'] ?> anda login sebagai admin</h1>
        </div>

        <a href="insert.php">
            <button class="btn btn-success px-3" type="button">masukkan data</button>
        </a>

        <a href="logout.php">
            <button class="btn btn-primary" type="button">Logout</button>
        </a>

        <table class="table ">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $no = 1;
                foreach ($user->get() as $data) {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['title'] ?></td>
                        <td><?= $data['description']; ?></td>
                        <td><?= $data['name']; ?></td>
                        
                        <td>
                            <a href="update.php?id=<?php echo $data['id']; ?>">
                                <button class="btn btn-primary">Edit</button>
                            </a> |

                            <a href="admin.php?id=<?php echo $data['id']; ?>">
                                <button class="btn btn-danger" name="delete" onclick="return  confirm('do you want to delete')">delete</button>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>