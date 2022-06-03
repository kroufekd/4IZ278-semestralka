<?php
    session_start();
    include "db.php";

    if(!isset($_SESSION["id_user"])){
        header("Location: ../index.php");
    }

    if($_SESSION["is_coach"] == "0"){
        header("Location: ../index.php");
    }else{
        $sql = $conn->prepare("INSERT INTO `teams` (`name`, `id_coach`) VALUES (?,?)");
        $sql->bind_param("si", $_POST["name"], $_POST["coach"]);
        if($sql->execute()){
            header("Location: ../teams.php");
        }
    }
?>