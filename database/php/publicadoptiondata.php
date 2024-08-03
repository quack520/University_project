<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //呱

    require_once("db.php");

    $animal_id = $_GET['animal_id'] ? $_GET['animal_id'] : "";

    $sql = "SELECT 
                `animal_id`,
                `album_file`,
                `animal_place`,
                `animal_subid`,
                `animal_age`,
                `animal_sex`,
                `animal_bodytype`,
                `animal_colour`,
                `animal_sterilization`,
                `animal_bacterin`,
                `animal_remark`,
                `shelter_address`,
                `shelter_tel`
            FROM 
                `coa_opendata`
            WHERE
                `animal_id` = '$animal_id'";
    
    $result = mysqli_query($link, $sql);

    $datas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $datas[] = $row;
    }

    echo(json_encode($datas));

    mysqli_close($link);
?>