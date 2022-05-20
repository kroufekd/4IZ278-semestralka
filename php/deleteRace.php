<?php
    session_start();
    include "db.php";

    $sql = $conn->prepare("UPDATE competetions_teams SET is_deleted=1 WHERE id_competetion=?");
    $sql->bind_param("i", $_GET["id_race"]);
    
    if($sql->execute()){
        $sql1 = $conn->prepare("UPDATE competetions SET is_deleted=1 WHERE id_competetion=?");
        $sql1->bind_param("i", $_GET["id_race"]);
        
        if($sql1->execute()){
            header("Location: ../racess.php");
        }
    }
?>