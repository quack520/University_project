<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //呱

    require_once("db.php");

    $sql = "SELECT 
                `pet_num`,
                `pet_name`,
                `pet_area`,
                `pet_sex`,
                `pet_type`,
                `pet_photo1`
            FROM 
                `pet`
            WHERE
                `list_type` IN ('拾獲', '走失', '協尋')
            AND
                `hide_status` <> 1"; //和hide_status不等於1

    $result = mysqli_query($link, $sql);

    $datas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $datas[] = $row;
    }

    echo(json_encode($datas));

    mysqli_close($link);
?>