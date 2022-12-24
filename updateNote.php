<?php
require_once __DIR__ . '/boot.php';
require 'noteInformation.php';

if(isset($_POST["id_note"]) && isset($_POST["title"]) && isset($_POST["text"])){
    try{
        $stmt = pdo()->prepare("UPDATE note SET title = :title, text = :text WHERE id_note = :id_note");
        $stmt -> bindValue(":title", $_POST["title"]);
        $stmt -> bindValue(":text", $_POST["text"]);
        $stmt -> bindValue(":id_note",  $_POST["id_note"], PDO::PARAM_INT);
        $stmt -> execute();
        header("Location: index.php");
    }
    catch(PDOException $e){
        echo "Database error: " . $e->getMessage();
    }
}
?>