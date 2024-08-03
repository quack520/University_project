<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //呱
    
    $rsp = array();
    $datas = array();
    $good_time = date('Y-m-d');

    //接收前端的資料
    $me_num = $_GET['me_num'] ? $_GET['me_num'] : "";
    $good_name = $_GET['good_name'] ? $_GET['good_name'] : "";
    $good_amount = $_GET['good_amount'] ? $_GET['good_amount'] : "";
    $good_point = $_GET['good_point'] ? $_GET['good_point'] : "";
    $good_area = $_GET['good_area'] ? $_GET['good_area'] : "";
    $good_type = $_GET['good_type'] ? $_GET['good_type'] : "";
    $good_place = $_GET['good_place'] ? $_GET['good_place'] : "";
    $good_detail = $_GET['good_detail'] ? $_GET['good_detail'] : "";
    $good_photo1 = $_GET['good_photo1'] ? $_GET['good_photo1'] : "";
    $good_photo2 = $_GET['good_photo2'] ? $_GET['good_photo2'] : "";
    $good_photo3 = $_GET['good_photo3'] ? $_GET['good_photo3'] : "";

    // if($good_name==""){
    //     $rsp['ok']=false;
    //     $rsp['msg']='商品名稱不可為空';
    //     echo json_encode($rsp);
    //     exit();
    // }else if($good_amount==""){
    //     $rsp['ok']=false;
    //     $rsp['msg']='商品數量不可為空';
    //     echo json_encode($rsp);
    //     exit();
    // }else if($good_point==""){
    //     $rsp['ok']=false;
    //     $rsp['msg']='商品點數不可為空';
    //     echo json_encode($rsp);
    //     exit();
    // }else if($good_area==""){
    //     $rsp['ok']=false;
    //     $rsp['msg']='所在位置不可為空';
    //     echo json_encode($rsp);
    //     exit();
    // }else if($good_type==""){
    //     $rsp['ok']=false;
    //     $rsp['msg']='類別不可為空';
    //     echo json_encode($rsp);
    //     exit();
    // }else if($good_place==""){
    //     $rsp['ok']=false;
    //     $rsp['msg']='商品產地不可為空';
    //     echo json_encode($rsp);
    //     exit();
    // }else if($good_detail==""){
    //     $rsp['ok']=false;
    //     $rsp['msg']='商品資訊不可為空';
    //     echo json_encode($rsp);
    //     exit();
    // }else if($good_photo1==""){
    //     $rsp['ok']=false;
    //     $rsp['msg']='第一張照片不可為空';
    //     echo json_encode($rsp);
    //     exit();
    // }else if($good_photo2==""){
    //     $rsp['ok']=false;
    //     $rsp['msg']='第二張照片不可為空';
    //     echo json_encode($rsp);
    //     exit();
    // }else if($good_photo3==""){
    //     $rsp['ok']=false;
    //     $rsp['msg']='第三張照片不可為空';
    //     echo json_encode($rsp);
    //     exit();
    // }

    //連結資料庫
    require_once("db.php");
    //查詢mname、phone存入member
    $member_query = "   SELECT 
                            `mname`, `phone` 
                        FROM 
                            `member` 
                        WHERE
                            `me_num` = '$me_num'";
    $member_result = mysqli_query($link, $member_query);
    $member_data = mysqli_fetch_assoc($member_result);

    $mname = $member_data['mname'];
    $phone = $member_data['phone'];

    $sql = "INSERT INTO 
                `good`(`me_num`,`good_name`, `good_amount`,`good_point`, `good_area`, `good_type`, `good_place`, `good_detail`,`good_time`,`good_photo1`,`good_photo2`,`good_photo3`,`mname`,`phone`) 
            VALUES 
                ('$me_num','$good_name','$good_amount','$good_point','$good_area','$good_type','$good_place','$good_detail','$good_time','$good_photo1','$good_photo2','$good_photo3','$mname','$phone')";

    $result = mysqli_query($link, $sql);
    if ($result) {
        //獲取剛生成的good_num
        $newgood_num = mysqli_insert_id($link);
        //使用'me_num'和'good_num'插入到'mypost'表
        $mypostSql = "  INSERT INTO 
                            `mypost`(`me_num`, `good_num`) 
                        VALUES 
                            ('$me_num', '$newgood_num')";
        $mypostResult = mysqli_query($link, $mypostSql);

        if ($mypostResult) {
            $datas['ok'] = true;
        
            //成功刊登后，在member表中更新me_point
            $updatePointSql = "UPDATE `member` SET `me_point` = `me_point` + 5 WHERE `me_num` = '$me_num'";
            $updatePointResult = mysqli_query($link, $updatePointSql);
        
            if (!$updatePointResult) {
                //如果更新失败，顯示錯誤消息
                $datas['ok'] = false;
                $datas['msg'] = '更新會員積分失敗';
            }
        } else {
            $datas['ok'] = false;
        }
        
    } else {
        $datas['ok'] = false;
    }

    echo json_encode($datas);
    mysqli_close($link);
?>