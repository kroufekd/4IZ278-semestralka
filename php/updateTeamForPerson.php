<?php
    session_start();
    include "db.php";

    echo $_GET["id_team"];


    $sql = $conn->prepare("UPDATE persons SET team=? WHERE id_person=?");
    $sql->bind_param("ii", $_GET["id_team"], $_GET["id_person"]);
    
    /*
    if($sql->execute()){
        header("Location: ../swimmers.php");
    }
    */
    
?>