<?php
    include "db.php";

    $sql = 'SELECT * FROM persons WHERE is_coach = "0"';

    $myArray = array();
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $myArray[] = $row;
    }
    echo json_encode($myArray,JSON_UNESCAPED_UNICODE);


?>