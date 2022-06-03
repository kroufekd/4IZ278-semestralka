<?php
    session_start();
    include "db.php";
    if(!isset($_SESSION["id_user"])){
        header("Location: ../index.php");
    }

    if($_SESSION["is_coach"] == "0"){
        header("Location: ../index.php");
    }else{
        $sql = $conn->prepare("UPDATE teams SET id_coach=? WHERE id_team=?");
        $sql->bind_param("ii", $_GET["id_coach"], $_GET["id_team"]);
        
        
        if($sql->execute()){
            echo "true";
        }else{
            echo "false";
        }
    }
    
?>