<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //呱
    
    $me_num = $_GET['me_num'];

    require_once("db.php");

    $sql = "SELECT
                `mname`,
                `me_photo`,
                `me_point`
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