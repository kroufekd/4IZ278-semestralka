<?php
    include "db.php";

    

    if(isset($_GET["id"]) && $_GET["id"] != "null"){
        $sql1 = "SELECT * FROM persons WHERE id_person=".$_GET["id"];
        $result = $conn->query($sql1);
        $row = $result->fetch_assoc();
        
        $sql = 'SELECT c.id_competition, c.name, 
        concat(c.street, " ", c.building_number, ", ", c.city, " ", c.zip) as "address", 
        DATE_FORMAT(c.start_time, "%e.%c.%Y %k:%i") as "start_time", DATE_FORMAT(c.end_time, "%e.%c.%Y %k:%i") as "end_time" 
        FROM competition c
        inner join competition_teams ct on ct.id_competition = c.id_competition
        inner join teams t on t.id_team = ct.id_team
        WHERE c.is_deleted=0  && t.id_team ='. $row["team"];
        
    }else{
        $sql = 'SELECT c.id_competition, c.name, 
            concat(c.street, " ", c.building_number, ", ", c.city, " ", c.zip) as "address", 
            DATE_FORMAT(c.start_time, "%e.%c.%Y %k:%i") as "start_time", DATE_FORMAT(c.end_time, "%e.%c.%Y %k:%i") as "end_time" 
            FROM competition c
            WHERE c.is_deleted=0';
    }


    $myArray = array();
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $myArray[] = $row;
    }
    echo json_encode($myArray,JSON_UNESCAPED_UNICODE);


?>