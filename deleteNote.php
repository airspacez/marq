<?php
require_once __DIR__ . '/boot.php';
require 'noteInformation.php';

if(isset($_POST["id_note"])){
    try{
        $stmt = pdo()->prepare("DELETE FROM note WHERE id_note = :id_note");
        $stmt -> bindValue(":id_note", $_POST["id_note"]);
        $stmt -> execute();
        header("Location: index.php");
    }
    catch(PDOException $e){
        echo "Database error: " . $e->getMessage();
    }
}
?>