<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    $rsp = array();
    $datas = array();
    $today = date('Y-m-d');

    require_once("db.php");

    $good_num = $_GET['good_num'];

    $sql = "SELECT 
                `me_name`,
                `me_num`,
                `apply_date`
            FROM 
                `good_apply`
            WHERE
                `good_num` = '$good_num'";
    
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $datas[] = $row;
    }    
    echo(json_encode($datas));
    mysqli_close($link);
?>