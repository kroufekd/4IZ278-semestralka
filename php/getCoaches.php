<?php
    include "db.php";

    $sql = 'SELECT * from persons WHERE is_coach = 1';

    $myArray = array();
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $myArray[] = $row;
    }

    echo json_encode($myArray,JSON_UNESCAPED_UNICODE);
?>