<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //湯

    $rsp = array();
    $datas = array();

    $me_num = $_GET['me_num'] ? $_GET['me_num'] : "";

    require_once("db.php");

    $sql = "SELECT
                `mname`,
                `email`,                
                `phone`,
                `me_num`
            From
                `member`
            where
                `me_num` = '$me_num'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    $datas[] = $row;
    echo json_encode($datas);
    mysqli_close($link);

?>