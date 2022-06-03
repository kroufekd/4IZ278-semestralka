<?php
    include "db.php";

    $sql = 'SELECT t.*, p.name as "coach_name", p.surname as "coach_surname", p.id_person as "id_coach" FROM `teams` t
    join persons p on p.id_person = t.id_coach WHERE t.is_deleted = "0"';

    $myArray = array();
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $myArray[] = $row;
    }
    echo json_encode($myArray,JSON_UNESCAPED_UNICODE);


?>