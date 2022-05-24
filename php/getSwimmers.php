<?php
    include "db.php";

    $sql = 'SELECT p.*, concat(p.name, " ", p.surname) as "full_name", t.name as "team_name" 
    FROM persons p
    left join teams t on t.id_team = p.team
<<<<<<< HEAD
     WHERE is_coach = "0" && p.is_deleted=0';
=======
     WHERE p.is_coach = "0"';

    if(isset($_GET["id_team"]) && $_GET["id_team"] != "null"){
        $sql .= " AND p.team=". $_GET["id_team"];
    }
>>>>>>> f65f40416cc8e372eb018ac3ddfca776e3d386e2

    $myArray = array();
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $myArray[] = $row;
    }
<<<<<<< HEAD
=======

    echo json_encode($myArray,JSON_UNESCAPED_UNICODE);

>>>>>>> f65f40416cc8e372eb018ac3ddfca776e3d386e2

    
    echo json_encode($myArray,JSON_UNESCAPED_UNICODE);
?>