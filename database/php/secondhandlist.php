<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //呱
    
    require_once("db.php");

    $sql = "SELECT 
                `good_num`,
                `mname`,
                `good_name`,
                `good_photo1`
            FROM 
                `good`
            WHERE
                `good_num`
            AND
                `hide_status` <> 1";

    $result = mysqli_query($link, $sql);

    $datas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $datas[] = $row;
    }

    echo(json_encode($datas));

    mysqli_close($link);
?>