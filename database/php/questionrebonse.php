<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //湯

    $rsp = array();
    $datas = array();
    $rebonse_time = date('Y-m-d');

    $pet_num = $_GET['pet_num'] ? $_GET['pet_num'] : "";
    $list_type = $_GET['list_type'] ? $_GET['list_type'] : "";
    $pet_name = $_GET['pet_name'] ? $_GET['pet_name'] : "";
    $pet_type = $_GET['pet_type'] ? $_GET['pet_type'] : "";
    $variety = $_GET['variety'] ? $_GET['variety'] : "";
    $age = $_GET['age'] ? $_GET['age'] : "";
    $ligation = $_GET['ligation'] ? $_GET['ligation'] : "";
    $rebonse_photo = $_GET['rebonse_photo'] ? $_GET['rebonse_photo'] : "";
    $today = date('Y-m-d');

    if($age == ""){
        $rsp['ok']=false;
        $rsp['msg']='年齡不可為空';
        
    }else if($ligation==""){
        $rsp['ok']=false;
        $rsp['msg']='結紮狀況不可為空';
        
    }else if($rebonse_photo==""){
        $rsp['ok']=false;
        $rsp['msg']='照片不可為空';
        
    }else{

        require_once("db.php");
        $sql = "SELECT
                    `rebonse_num`,
                    `me_num`,
                    `rebonse_times`,
                    `firstrebonsetime`,
                    `endrebonsetime`
                From
                    `pet`
                where
                    `pet_num` = '$pet_num'";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);
        $rebonse_num = $row['rebonse_num'];
        $me_num = $row['me_num'];
        $rebonse_times = $row['rebonse_times']+1;

        $firstrebonsetime = $row['firstrebonsetime'];
        $endrebonsetime = $row['endrebonsetime'];
        
        $firstrebonsetime_timestamp = strtotime($firstrebonsetime);
        $endrebonsetime_timestamp = strtotime($endrebonsetime);
        $firstrebonsetime_new = date('Y-m-d', strtotime('+1 month', $firstrebonsetime_timestamp));
        $endrebonsetime_new = date('Y-m-d', strtotime('+1 month', $endrebonsetime_timestamp));
        $sql = "INSERT INTO
                    `pet_questionrebonse`(`pet_num`,`rebonse_num`,`rebonse_times`,`me_num`,`list_type`, `pet_type`,`pet_name`, `variety`, `age`, `ligation`,`date`,`rebonse_photo`) 
                VALUES
                    ('$pet_num','$rebonse_num','$rebonse_times','$me_num','$list_type','$pet_type','$pet_name','$variety','$age','$ligation','$rebonse_time','$rebonse_photo')";
        $result = mysqli_query($link, $sql);
        $sql = "UPDATE `pet` 
                SET `rebonse_times` = '$rebonse_times' ,`firstrebonsetime` = '$firstrebonsetime_new' ,`endrebonsetime` = '$endrebonsetime_new' 
                WHERE `pet_num` = $pet_num";
        $result = mysqli_query($link, $sql);
        if(!$result){
            $rsp['ok']=false;
            $rsp['msg']='填寫失敗';
        }
        else{
            $rsp['ok']=true;
            $rsp['msg']='填寫成功';
        }
        mysqli_close($link);
    }    
    echo json_encode($rsp);
    exit();
?>