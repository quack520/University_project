<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //呱

    require_once("db.php");

    $me_num = $_GET['me_num'] ? $_GET['me_num'] : "";

    $sql = "SELECT 
                `me_num`,
                `mname`,
                `identity_card`,
                `phone`,
                `email`
            FROM 
                `member`
            WHERE
                `me_num` = '$me_num'";

    $result = mysqli_query($link, $sql);

    $datas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $datas[] = $row;
    }

    echo(json_encode($datas));

    mysqli_close($link);
?>