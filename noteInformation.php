<?php
    $sth = pdo()->prepare("SELECT * FROM `note` WHERE `id_user` = :id");
    $sth->execute(['id' => $_SESSION['user_id']]);
?>