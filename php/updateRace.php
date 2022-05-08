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

        $sql = $conn->prepare("INSERT INTO `competition`(`name`, `city`, `street`, `building_number`, `zip`, `start_time`, `end_time`) VALUES ()");
        $sql->bind_param("sssisii", $_POST["name"], $_POST["surname"], $_POST["email"], $_POST["phone"],$pswd, $_POST["role"], $_POST["team"]);
        mail("kroufekd@gmail.com","My subject","h", "");
        if($sql->execute()){
            header("Location: ../profile.php");
        }
    }
?>