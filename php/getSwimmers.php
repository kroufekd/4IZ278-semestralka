<?php
    include "db.php";

    $sql = 'SELECT p.*, concat(p.name, " ", p.surname) as "full_name", t.name as "team_name" 
    FROM persons p
    join teams t on t.id_team = p.team
     WHERE is_coach = "0"';

    $myArray = array();
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $myArray[] = $row;
    }
    echo json_encode($myArray,JSON_UNESCAPED_UNICODE);


?>