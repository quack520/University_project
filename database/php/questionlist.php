<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //湯

    $rebonse_num = $_GET['rebonse_num'] ? $_GET['rebonse_num'] : "";
    require_once("db.php");
    $sql = "SELECT
                `pet_num`, 
                `pet_name`,
                `pet_type`,
                `variety`,
                `rebonse_times`
            FROM 
                `pet`
            WHERE
                `rebonse_num` = $rebonse_num";
    
    $result = mysqli_query($link, $sql);
    $datas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $datas[] = $row;
    }

    echo(json_encode($datas));

    mysqli_close($link);
?>