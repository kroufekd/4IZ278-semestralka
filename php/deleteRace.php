<?php
    session_start();
    include "db.php";
    

    $sql = $conn->prepare("UPDATE competition_teams SET is_deleted='1' WHERE id_competition=?");
    $sql->bind_param("i", $_GET["id_race"]);
    

    if($sql->execute()){
        $sql1 = $conn->prepare("UPDATE competition SET is_deleted='1' WHERE id_competition=?");
        $sql1->bind_param("i", $_GET["id_race"]);
        
        if($sql1->execute()){
            header("Location: ../races.php");
        }
    }

?>