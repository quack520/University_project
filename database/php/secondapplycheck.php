<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    $rsp = array();
    $datas = array();
    $today = date('Y-m-d');

    require_once("db.php");

    $good_num = $_GET['good_num'];
    $me_num = $_GET['me_num'];
    $check_num = $_GET['check_num'];

    $sql = "SELECT 
                `me_point`                
            FROM 
                `member`
            WHERE
                `me_num` = '$me_num'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    $me_point = $row['me_point'];

    $sql = "SELECT 
                `good_point`                
            FROM 
                `good`
            WHERE
                `good_num` = '$good_num'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);

    $good_point = $row['good_point'];

    if($me_point<$good_point)
    {
        $datas['ok'] = false;
        $datas['msg'] = '對方點數不夠';
    }else{
        $sql = "UPDATE
                    `good`
                SET
                    `applycheck_num` = '$me_num' , `check_time` =  '$today'
                where
                    `good_num` = '$good_num'";
        $res = mysqli_query($link, $sql);
        $sql = "UPDATE
                    `member`
                SET
                    `me_point` = `me_point`- $good_point
                where
                    `me_num` = '$me_num'";
        $res = mysqli_query($link, $sql);
        $sql = "UPDATE
                    `member`
                SET
                    `me_point` = `me_point` + $good_point
                where
                    `me_num` = '$check_num'";
        $res = mysqli_query($link, $sql);
        $datas['ok'] = true;
        $datas['msg'] = '確認完成';
    }   

    echo(json_encode($datas));
    mysqli_close($link);
?>