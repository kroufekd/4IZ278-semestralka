<?php
    session_start();
    include "db.php";

    if(!isset($_SESSION["id_user"])){
        header("Location: ../index.php");
    }

    if($_SESSION["is_coach"] == "0"){
        header("Location: ../index.php");
    }else{
        $sql = $conn->prepare("UPDATE teams SET is_deleted=1 WHERE id_team=?");
        $sql->bind_param("i", $_GET["id_team"]);
        
        if($sql->execute()){
            header("Location: ../teams.php?success=true");
        }
    }
?>