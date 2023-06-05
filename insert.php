<?php

require_once 'database.php';

if (isset($_POST['kirim'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $id_category = $_POST['id_category'];

    $add_data = $user->createData($title, $description, $id_category);

    if ($add_data) {
        header("location: admin.php");
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <div class="info">
            <h1>Silahkan masukkan data</h1>
        </div>
        <form action="" method="post">
            <div class="form-group my-2">
                <label for="title">Judul</label>
                <input type="text" class="form-control w-25" name="title">
            </div>

            <!-- <div class="form-group my-2">
                <label for="category">kategori</label>
                <input type="text" class="form-control w-25" name="category">
            </div> -->

            <div class="form-group my-2">
                <label for="description">deskripsi</label>
                <textarea type="text" class="form-control w-25" rows="3" name="description"></textarea>
            </div>
            
            <select class="form-select w-25 my-2" name="id_category">
                <?php
                    foreach ($user->getCategory() as $data ) {
                        echo "<option value=$data[id]>$data[name]</option>";
                    }
                ?>
            </select>
            
            
            <button type="submit" class="btn btn-success mt-2" name="kirim">Submit</button>
        </form>

    </div>
</body>

</html>