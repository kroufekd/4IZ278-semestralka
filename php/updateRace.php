<?php
    session_start();
    include "db.php";


    if(isset($_GET["type"]) && $_GET["type"] == "update"){
        $start_date = $_POST["start_date"] ." ". $_POST["start_time"];
        $end_date = $_POST["end_date"] ." ". $_POST["end_time"];
        $sql = $conn->prepare("UPDATE `competition` SET `name`= ?,`city`=?,`street`=?,`building_number`=?,`zip`=?,`start_time`=?,`end_time`=? WHERE id_competition = ?");
        $sql->bind_param("sssiissi", $_POST["name"], $_POST["city"], $_POST["street"], $_POST["building_number"], $_POST["zip"], $start_date, $end_date, $_GET["id_race"]);
        
        if($sql->execute()){

            
            $id_race = $_GET["id_race"];
            
            $conn->query("DELETE FROM `competition_teams` WHERE id_competition =".$id_race);

            $sql1 = "INSERT INTO `competition_teams`(`id_competition`, `id_team`) VALUES ";

            for ($i=0; $i < count($_POST["team"]); $i++) { 
                if($i == count($_POST["team"])-1){
                    $sql1 .= "(".$id_race.", ".$_POST["team"][$i].")";
                }else{
                    $sql1 .= "(".$id_race.", ".$_POST["team"][$i]."),";
                }                
            }
            $conn->query($sql1);




            header("Location: ../races.php");
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