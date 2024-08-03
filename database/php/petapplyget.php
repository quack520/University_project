<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //湯

    $rsp = array();
    $datas = array();
    $rebonse_time = date('Y-m-d');

    $pet_num = $_GET['pet_num'] ? $_GET['pet_num'] : "";

    require_once("db.php");

    $sql = "SELECT
                `pet_num`,
                `apply_num`,
                `apply_name`,
                `date`                
            From
                `pet_apply`
            where
                `pet_num` = '$pet_num'";
    $result = mysqli_query($link, $sql);
    $datas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $datas[] = $row;
    }
    echo(json_encode($datas));
    mysqli_close($link);

?>