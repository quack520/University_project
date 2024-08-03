<?php
    
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    $rsp = array();
    $datas = array();
    $pub_time = date('Y-m-d');

    //接收前端的資料
    $pet_num = $_GET['pet_num'];

    //連結資料庫
    require_once("db.php");

    $sql = "SELECT
                `list_type`,
                `pet_name`,
                `pet_type`,
                `variety`,
                `rebonse_times`
            From
                `pet`
            where
                `pet_num` = '$pet_num'";
    $result = mysqli_query($link, $sql);
    $datas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $datas[] = $row;
    }
    echo json_encode($datas);
    mysqli_close($link);
?>