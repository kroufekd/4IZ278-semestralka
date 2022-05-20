<?php
    session_start();
    include "db.php";

    $sql = $conn->prepare("UPDATE persons SET team=? WHERE id_person=?");
    $sql->bind_param("ii", $_GET["id_team"], $_GET["id_person"]);
    
    
    if($sql->execute()){
        echo "true";
    }else{
        echo "false";
    }
    
    
?>