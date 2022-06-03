<?php
    session_start();
    include "db.php";
    
    if(!isset($_SESSION["id_user"])){
        header("Location: ../index.php");
    }

    if($_SESSION["is_coach"] == "0"){
        header("Location: ../index.php");
    }else{
        $sql = $conn->prepare("UPDATE competition_teams SET is_deleted='1' WHERE id_competition=?");
        $sql->bind_param("i", $_GET["id_race"]);
        

        if($sql->execute()){
            $sql1 = $conn->prepare("UPDATE competition SET is_deleted='1' WHERE id_competition=?");
            $sql1->bind_param("i", $_GET["id_race"]);
            
            if($sql1->execute()){
                header("Location: ../races.php");
            }
        }
    }
?>