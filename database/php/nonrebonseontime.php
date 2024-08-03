<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");
    $rsp = array();
    $datas = array();
    $pet_num = $_GET['pet_num'] ? $_GET['pet_num'] : "";
    $today = date('Y-m-d');

    require_once("db.php");
    $sql = "SELECT
                `firstrebonsetime`,
                `endrebonsetime`
            From
                `pet`
            where
                `pet_num` = '$pet_num'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    $firstrebonsetime = $row['firstrebonsetime'];
    $endrebonsetime = $row['endrebonsetime'];

    if($today>$endrebonsetime)
    {
        $sql = "SELECT
                    `nonrebonse`
                From
                    `pet`
                where
                    `pet_num` = '$pet_num'";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);
        $nonrebonse = $row['nonrebonse']+1;
        $firstrebonsetime_timestamp = strtotime($firstrebonsetime);
        $endrebonsetime_timestamp = strtotime($endrebonsetime);
        $firstrebonsetime_new = date('Y-m-d', strtotime('+1 month', $firstrebonsetime_timestamp));
        $endrebonsetime_new = date('Y-m-d', strtotime('+1 month', $endrebonsetime_timestamp));
        $sql = "UPDATE `pet` 
                SET `nonrebonse` = '$nonrebonse' ,`firstrebonsetime` = '$firstrebonsetime_new' ,`endrebonsetime` = '$endrebonsetime_new' 
                WHERE `pet_num` = $pet_num";
        $result = mysqli_query($link, $sql);
        $rsp['ok']=true;
        $rsp['msg']='已收到回覆';        
    }
    else
    {
        $rsp['ok']=false;
        $rsp['msg']='請於'.$endrebonsetime.'之後的時間回覆';
    }
    mysqli_close($link);
    echo json_encode($rsp);
?>