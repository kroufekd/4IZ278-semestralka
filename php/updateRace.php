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

        $start_date = $_POST["start_date"] ." ". $_POST["start_time"];
        $end_date = $_POST["end_date"] ." ". $_POST["end_time"];
        $sql = $conn->prepare("INSERT INTO `competition`(`name`, `city`, `street`, `building_number`, `zip`, `start_time`, `end_time`) VALUES (?,?,?,?,?,?,?)");
        $sql->bind_param("sssiiss", $_POST["name"], $_POST["city"], $_POST["street"], $_POST["building_number"], $_POST["zip"], $start_date, $end_date);
    

        if($sql->execute()){
            $id_race = $conn->insert_id;
            
            $sql1 = "INSERT INTO `competition_teams`(`id_competition`, `id_team`) VALUES ";

            for ($i=0; $i < count($_POST["team"]); $i++) { 
                if($i == count($_POST["team"])-1){
                    $sql1 .= "(".$id_race.", ".$_POST["team"][$i].")";
                }else{
                    $sql1 .= "(".$id_race.", ".$_POST["team"][$i]."),";
                }                
            }
            $conn->query($sql1);

            header("Location: ../races.php?");
        }
    }
?>