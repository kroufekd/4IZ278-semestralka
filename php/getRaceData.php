<?php
    include "db.php";

    $sql = 'SELECT 
    c.id_competition as "id_race",
    c.name as "race_name",t.name as "team_name",
    concat(c.street, " ", c.building_number, ", ", c.city, " ", c.zip) as "address",
    DATE_FORMAT(c.start_time, "%e.%c.%Y %k:%i") as "start_time", 
    DATE_FORMAT(c.end_time, "%e.%c.%Y %k:%i") as "end_time",
    t.*,
    c.city,
    c.street,
    c.building_number,
    c.zip,
    DATE_FORMAT(c.start_time, "%H:%i") as "st_unformated",
    DATE_FORMAT(c.start_time, "%Y-%m-%e") as "sd_unformated",
    DATE_FORMAT(c.end_time, "%H:%i") as "et_unformated",
    DATE_FORMAT(c.end_time, "%Y-%m-%e") as "ed_unformated"
    from competition_teams ct join teams t on t.id_team = ct.id_team join competition c on c.id_competition = ct.id_competition where ct.id_competition="'.$_GET["id_race"].'"';

    $myArray = array();
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $myArray[] = $row;
    }
    echo json_encode($myArray,JSON_UNESCAPED_UNICODE);


?>