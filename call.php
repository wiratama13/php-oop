<?php
    include 'database.php';
    include 'Auth.php';

    $db = new Auth($conn);

    $id = $_SESSION['level'] = 'admin';
    $sesi = $db->getById('users','id', $id);

?>