<?php
    include "db.php";

    $sql = 'SELECT p.*, t.name as "team_name"
    FROM persons p
    join teams t on t.id_team = p.team
    WHERE id_person = "'.$_GET["id_user"].'"';

    $myArray = array();
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $myArray[] = $row;
    }
    echo json_encode($myArray,JSON_UNESCAPED_UNICODE);


?>