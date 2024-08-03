<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //呱

    require_once("db.php");

    $good_num = $_GET['good_num'];

    $sql = "SELECT 
                `me_num`,
                `good_photo1`,
                `good_photo2`,
                `good_photo3`,
                `mname`,
                `good_name`,
                `good_amount`,
                `good_point`,
                `good_area`,
                `good_type`,
                `good_place`,
                `good_detail`,
                `mname`,
                `phone`
            FROM 
                `good`
            WHERE
                `good_num` = '$good_num'";
    
    $result = mysqli_query($link, $sql);

    $datas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $datas[] = $row;
    }

    echo(json_encode($datas));

    mysqli_close($link);
?>