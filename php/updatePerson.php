<?php
    session_start();
    include "db.php";


    if(isset($_GET["type"]) && $_GET["type"] == "update"){
        $sql = $conn->prepare("UPDATE persons SET name=?,surname=?,email=?,phone=? WHERE id_person=?");
        $sql->bind_param("sssii", $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["phone"], $_SESSION["id_user"]);
        
        if($sql->execute()){
            header("Location: ../profile.php");
        }
        
    }else{
        $pswd = password_hash("heslo", PASSWORD_DEFAULT);
        $sql = $conn->prepare("INSERT INTO `persons`(`name`, `surname`, `email`, `phone`, `password`, `is_coach`, `team`) VALUES (?,?,?,?,?,?,?)");
        $sql->bind_param("sssisii", $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["phone"],$pswd, $_POST["role"], $_POST["team"]);
        if($sql->execute()){
            header("Location: ../profile.php");
        }
    }
?>