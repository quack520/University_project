<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //呱

    $rsp = array();
    $datas = array();
    $pub_time = date('Y-m-d');

    $me_num = $_GET['me_num'] ? $_GET['me_num'] : "";
    $list_type = $_GET['list_type'] ? $_GET['list_type'] : "";
    $pet_name = $_GET['pet_name'] ? $_GET['pet_name'] : "";
    $pet_type = $_GET['pet_type'] ? $_GET['pet_type'] : "";
    $variety = $_GET['variety'] ? $_GET['variety'] : "";
    $age = $_GET['age'] ? $_GET['age'] : "";
    $pet_sex = $_GET['pet_sex'] ? $_GET['pet_sex'] : "";
    $color = $_GET['color'] ? $_GET['color'] : "";
    $ligation = $_GET['ligation'] ? $_GET['ligation'] : "";
    $pet_area = $_GET['pet_area'] ? $_GET['pet_area'] : "";
    $pet_detail = $_GET['pet_detail'] ? $_GET['pet_detail'] : "";

    $pet_photo1 = $_GET['pet_photo1'] ? $_GET['pet_photo1'] : "";
    $pet_photo2 = $_GET['pet_photo2'] ? $_GET['pet_photo2'] : "";
    $pet_photo3 = $_GET['pet_photo3'] ? $_GET['pet_photo3'] : "";

    $mname = $_GET['mname'] ? $_GET['mname'] : "";
    $phone = $_GET['phone'] ? $_GET['phone'] : "";
    $pet_size = $_GET['pet_size'] ? $_GET['pet_size'] : "";
    $email = $_GET['email'] ? $_GET['email'] : "";

    $pa_phone = '/^09\d{8}$/';
    $pa_email= '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.(com|tw)$/';

    
    if($list_type == ""){
        $rsp['ok']=false;
        $rsp['msg']='表單類型不可為空';
        echo json_encode($rsp);
        exit();
    }else if($pet_name==""){
        $rsp['ok']=false;
        $rsp['msg']='寵物名稱不可為空';
        echo json_encode($rsp);
        exit();
    }else if($pet_type==""){
        $rsp['ok']=false;
        $rsp['msg']='寵物品種不可為空';
        echo json_encode($rsp);
        exit();
    }else if($variety==""){
        $rsp['ok']=false;
        $rsp['msg']='寵物種類不可為空';
        echo json_encode($rsp);
        exit();
    }else if($age==""){
        $rsp['ok']=false;
        $rsp['msg']='年齡不可為空';
        echo json_encode($rsp);
        exit();
    }else if($pet_sex==""){
        $rsp['ok']=false;
        $rsp['msg']='性別不可為空';
        echo json_encode($rsp);
        exit();
    }else if($color==""){
        $rsp['ok']=false;
        $rsp['msg']='毛色不可為空';
        echo json_encode($rsp);
        exit();
    }else if($ligation==""){
        $rsp['ok']=false;
        $rsp['msg']='結紮狀況不可為空';
        echo json_encode($rsp);
        exit();
    }else if($pet_area==""){
        $rsp['ok']=false;
        $rsp['msg']='區域不可為空';
        echo json_encode($rsp);
        exit();
    }else if($pet_detail==""){
        $rsp['ok']=false;
        $rsp['msg']='詳細說明不可為空';
        echo json_encode($rsp);
        exit();
    }else if($pet_photo1==""){
        $rsp['ok']=false;
        $rsp['msg']='第一張照片不可為空';
        echo json_encode($rsp);
        exit();
    }else if($pet_photo2==""){
        $rsp['ok']=false;
        $rsp['msg']='第二張照片不可為空';
        echo json_encode($rsp);
        exit();
    }else if($pet_photo3==""){
        $rsp['ok']=false;
        $rsp['msg']='第三張照片不可為空';
        echo json_encode($rsp);
        exit();
    }else if($mname==""){
        $rsp['ok']=false;
        $rsp['msg']='聯絡人姓名不可為空';
        echo json_encode($rsp);
        exit();
    }else if($phone==""){
        $rsp['ok']=false;
        $rsp['msg']='聯絡人電話不可為空';
        echo json_encode($rsp);
        exit();
    }else if (!preg_match($pa_phone, $phone)) {
        $rsp['ok'] = false;
        $rsp['msg'] = '聯絡人電話格式不正確';
        echo json_encode($rsp);
        exit();
    }else if($pet_size==""){
        $rsp['ok']=false;
        $rsp['msg']='體型不可為空';
        echo json_encode($rsp);
        exit();
    }else if($email==""){
        $rsp['ok']=false;
        $rsp['msg']='聯絡人信箱不可為空';
        echo json_encode($rsp);
        exit();
    }else if (!preg_match($pa_email, $email)) {
        $rsp['ok'] = false;
        $rsp['msg'] = '聯絡人信箱格式不正確';
        echo json_encode($rsp);
        exit();
    }
    
    require_once("db.php");

    //選擇資料庫
    $sql = "INSERT INTO 
                `pet`(`me_num`,`list_type`, `pet_name`, `pet_type`, `variety`, `age`, `pet_sex`, `color`, `ligation`, `pet_area`, `pet_detail`, `pet_photo1`,`pet_photo2`,`pet_photo3`, `mname`, `phone`, `pet_size`, `pub_time`,`email`) 
            VALUES 
                ('$me_num','$list_type','$pet_name','$pet_type','$variety','$age','$pet_sex','$color','$ligation','$pet_area','$pet_detail',
                '$pet_photo1','$pet_photo2','$pet_photo3','$mname','$phone','$pet_size','$pub_time','$email')";

    $result = mysqli_query($link, $sql);
    if ($result) {
        //取得剛生成的pet_num
        $newpet_num = mysqli_insert_id($link);
        //使用'me_num'和'pet_num'插入到'mypost'表
        $mypostSql = "  INSERT INTO 
                            `mypost`(`me_num`, `pet_num`) 
                        VALUES 
                            ('$me_num', '$newpet_num')";
        $mypostResult = mysqli_query($link, $mypostSql);

        if ($mypostResult) {
            $datas['ok'] = true;
        
            //成功刊登后，在member更新me_point
            $updatePointSql = "UPDATE `member` SET `me_point` = `me_point` + 5 WHERE `me_num` = '$me_num'";
            $updatePointResult = mysqli_query($link, $updatePointSql);
        
            if (!$updatePointResult) {
                //更新失败
                $datas['ok'] = false;
                $datas['msg'] = '更新會員積分失敗';
            }
        } else {
            //刊登失败
            $datas['ok'] = false;
        }

    } else {
        $datas['ok'] = false;
    }

    echo json_encode($datas);

    mysqli_close($link);
?>
