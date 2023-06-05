<?php

require_once 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $data_news = $user->getById($id);
} else {
    header('location: admin.php');
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $id_category = $_POST['id_category'];

    $update_data = $user->update($id, $title, $description, $id_category);


    if ($update_data) {
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
    <title>update data</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <div class="info">
            <h1>Silahkan update data</h1>
        </div>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $data_news['id']; ?>" />
            <div class="form-group my-2">
                <label for="title">Judul</label>
                <input type="text" class="form-control w-25" name="title" value="<?= $data_news['title']; ?>">
            </div>

            <div class="form-group my-2">
                <label for="description">deskripsi</label>
                <textarea type="text" class="form-control w-25" rows="3" name="description">
                <?= $data_news['description']; ?>
            </textarea>
            </div>
            <select class="form-select w-25" name="id_category">

                <?php
                foreach ($user->getCategory() as $data) { ?>

                    <option value="<?= $data['id'] ?>" <?= ($data['id'] == $data['id']) ? 'selected' : '' ?>><?=$data['name'] ?></option>";

                <?php } ?>

               


            </select>

            <button type="submit" class="btn btn-success mt-2" name="update" value="update">Submit</button>
        </form>

    </div>
</body>

</html>