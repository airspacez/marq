<?php

require_once __DIR__ . '/boot.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];
    if (preg_match('/^[0-9a-zA-Z-_.]+$/', $username)) {
        echo $username;
    } else {
        exit("Введите логин английскими буквами!");
    }
    if ($username == '') {
        unset($username);
    }
}

$stmt = pdo()->prepare("SELECT * FROM `user` WHERE `username` = :username");
$stmt->execute(['username' => $_POST['username']]);
if ($stmt->rowCount() > 0) {
    error('Это имя пользователя уже занято.');
    header('Location: /registration.php');
    die;
}

$stmt = pdo()->prepare("INSERT INTO `user` (`username`, `password`) VALUES (:username, :password)");
$stmt->execute([
    'username' => $_POST['username'],
    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
]);

header('Location: index.php');