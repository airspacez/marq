<?php
require_once __DIR__ . '/boot.php';
require('date.php');
    $stmt = pdo()->prepare("INSERT INTO `note`(`title`, `text`, `id_user`, `date_note`) VALUES (:title, :text, :id_user, '$today')");
    $stmt->execute([
        'title' => $_POST['title'],
        'text' => $_POST['text'],
        'id_user' => $_SESSION['user_id'],
    ]);
    header('Location: index.php');
?>