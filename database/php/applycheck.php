<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");
    //要在這裡進行時間條件開始和結束
    //湯

    $rsp = array();
    $datas = array();
    $applycheck_time = date('Y-m-d');
    $endrebonsetime = date('Y-m-d',strtotime('+1 month'));
    $pet_num = $_GET['pet_num'] ? $_GET['pet_num'] : "";
    $apply_num = $_GET['apply_num'] ? $_GET['apply_num'] : "";

    require_once("db.php");
    $sql = "SELECT
                `rebonse_num`
            From
                `pet`
            where
                `pet_num` = '$pet_num'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    $reb = $row['rebonse_num'];
    if($reb!=0)
    {
        $datas['ok'] = false;
        $datas['msg'] = '已經同意過申請人';
    }
    else{
        $sql = "UPDATE
                    `pet`
                SET
                    `rebonse_num` = '$apply_num' , `applycheck_time` =  '$applycheck_time' , `firstrebonsetime` = '$applycheck_time' , `endrebonsetime` = '$endrebonsetime'
                where
                    `pet_num` = '$pet_num'";
        $res = mysqli_query($link, $sql);
        $sql = "UPDATE
                    `member`
                SET
                    `me_point` = `me_point` + 200
                where
                    `me_num` = '$apply_num'";
        $result = mysqli_query($link, $sql);
        if(!$result){
            $datas['ok'] = false;
            $datas['msg'] = '同意失敗';
        }else   {
            $datas['ok'] = true;
            $datas['msg'] = '已確認申請領養人';
        }
    }
    echo(json_encode($datas));
    mysqli_close($link);
?>