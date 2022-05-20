<?php
    session_start();
    include "db.php";

    $sql = $conn->prepare("UPDATE persons SET is_deleted=1 WHERE id_person=?");
    $sql->bind_param("i", $_GET["id_person"]);
    
    if($sql->execute()){
        header("Location: ../swimmers.php");
    }
?>