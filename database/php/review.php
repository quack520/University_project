<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //湯

    $rsp = array();
    $datas = array();

    $pet_num = $_GET['pet_num'] ? $_GET['pet_num'] : "";
    $rebonse_times = $_GET['rebonse_times'] ? $_GET['rebonse_times'] : "";

    require_once("db.php");
    $sql = "SELECT
                `rebonse_num`
            From
                `pet`
            where
                `pet_num` = '$pet_num'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    $rebonse_num = $row['rebonse_num'];
    $sql = "UPDATE
                `pet_questionrebonse`
            SET
                `rebonse_check` = '1'
            where
                `pet_num` = '$pet_num' AND `rebonse_times` = '$rebonse_times'";
    $result = mysqli_query($link, $sql);
    if(!$result){               
        $rsp['ok']=false;
        $rsp['msg']='回報失敗';
    }
    else{
        $rsp['ok']=true;
        $rsp['msg']='回報成功';
    }
    $sql = "SELECT
                `rebonse_times`
            From
                `pet`
            where
                `pet_num` = '$pet_num'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    $reb_times = $row['rebonse_times'];
    if($reb_times<6)
    {
        $sql = "UPDATE `member` 
            SET `me_point` = `me_point` + 100 
            WHERE `me_num` = $rebonse_num";
        $result = mysqli_query($link, $sql);
    }
    elseif($reb_times=6){
        $sql = "UPDATE `member` 
            SET `me_point` = `me_point` + 300 
            WHERE `me_num` = $rebonse_num";
        $result = mysqli_query($link, $sql);
    }
    mysqli_close($link);
    echo json_encode($rsp);
    exit();
?>