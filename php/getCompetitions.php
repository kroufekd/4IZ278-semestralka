<?php
    include "db.php";

    $sql = 'SELECT id_competition, name, concat(street, " ", building_number, ", ", city, " ", zip) as "address", DATE_FORMAT(start_time, "%e.%c.%Y %k:%i") as "start_time", DATE_FORMAT(end_time, "%e.%c.%Y %k:%i") as "end_time" FROM `competition`;';

    $myArray = array();
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $myArray[] = $row;
    }
    echo json_encode($myArray,JSON_UNESCAPED_UNICODE);


?>