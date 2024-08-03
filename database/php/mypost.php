<?php

    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //呱

    require_once("db.php");

    $me_num = $_GET['me_num'];

    $petsData = array();
    $pets_lostData = array();
    $pets_takeData = array();
    $goodsData = array();

    //送養
    $sql = "SELECT 
                `pet_num`,
                `me_num`,
                `pet_type`,
                `pet_name`,
                `variety`,
                `hide_status`
            FROM 
                `pet`
            WHERE
                `me_num` = '$me_num' AND `list_type` IN ('送養')";
    
    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $row['pet_num'] = (int)$row['pet_num'];
        if ($row['hide_status'] == 0) {
            $petsData[] = $row;
        }
    }

    //走失
    $sql = "SELECT 
                `pet_num`,
                `me_num`,
                `pet_type`,
                `pet_name`,
                `variety`,
                `hide_status`
            FROM 
                `pet`
            WHERE
                `me_num` = '$me_num' AND `list_type` IN ('走失')";

    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $row['pet_num'] = (int)$row['pet_num'];
        if ($row['hide_status'] == 0) {
            $pets_lostData[] = $row;
        }
    }

    //拾獲
    $sql = "SELECT 
                `pet_num`,
                `me_num`,
                `pet_type`,
                `pet_name`,
                `variety`,
                `hide_status`
            FROM 
                `pet`
            WHERE
                `me_num` = '$me_num' AND `list_type` IN ('拾獲')";

    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $row['pet_num'] = (int)$row['pet_num'];
        if ($row['hide_status'] == 0) {
            $pets_takeData[] = $row;
        }
    }

    //二手用品
    $sql = "SELECT 
                `good_num`,
                `me_num`,
                `good_name`,
                `good_amount`,
                `hide_status`
            FROM 
                `good`
            WHERE
                `me_num` = '$me_num'";

    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $row['good_num'] = (int)$row['good_num'];
        if ($row['hide_status'] == 0) {
            $goodsData[] = $row;
        }
    }

    $res = array(
        'pets' => $petsData,
        'pets_lost' => $pets_lostData,
        'pets_take' => $pets_takeData,
        'goods' => $goodsData,
    );


    echo(json_encode($res));

    mysqli_close($link);
    
?>