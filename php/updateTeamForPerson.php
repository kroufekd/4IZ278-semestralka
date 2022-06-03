<?php
    session_start();
    include "db.php";
    if(!isset($_SESSION["id_user"])){
        header("Location: ../index.php");
    }

    if($_SESSION["is_coach"] == "0"){
        header("Location: ../index.php");
    }else{
        $sql = $conn->prepare("UPDATE persons SET team=? WHERE id_person=?");
        $sql->bind_param("ii", $_GET["id_team"], $_GET["id_person"]);
        
        
        if($sql->execute()){
            echo "true";
        }else{
            echo "false";
        }
    }
    
?>