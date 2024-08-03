<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //呱

    $rsp = array();
    $datas = array();

    require_once("db.php");

    $mname = $_GET['mname'] ? $_GET['mname'] : "";
    $identity_card = $_GET['identity_card'] ? $_GET['identity_card'] : "";
    $phone = $_GET['phone'] ? $_GET['phone'] : "";
    $email = $_GET['email'] ? $_GET['email'] : "";
    $account = $_GET['account'] ? $_GET['account'] : "";
    $password = $_GET['password'] ? $_GET['password'] : "";
    $password_check = $_GET['password_check'] ? $_GET['password_check'] : "";

    $pa_phone = '/^09\d{8}$/';
    $pa_id = '/^[A-Z]\d{9}$/';
    $pa_email= '/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.(com|tw)$/';

    if($mname==""){
        $rsp['ok']=false;
        $rsp['msg']='姓名不可為空';
        echo json_encode($rsp);
        exit();
    }else if($identity_card==""){
        $rsp['ok']=false;
        $rsp['msg']='身分證字號不可為空';
        echo json_encode($rsp);
        exit();
    }else if(!preg_match($pa_id, $identity_card)){
        $rsp['ok'] = false;
        $rsp['msg'] = '身分證格式不正確';
        echo json_encode($rsp);
        exit();
    }else if($phone=="" ){
        $rsp['ok']=false;
        $rsp['msg']='電話不可為空';
        echo json_encode($rsp);
        exit();
    }else if (!preg_match($pa_phone, $phone)) {
        $rsp['ok'] = false;
        $rsp['msg'] = '電話格式不正確';
        echo json_encode($rsp);
        exit();
    }else if($email==""){
        $rsp['ok']=false;
        $rsp['msg']='電子信箱不可為空';
        echo json_encode($rsp);
        exit();
    }else if (!preg_match($pa_email, $email)) {
        $rsp['ok'] = false;
        $rsp['msg'] = '電子信箱格式不正確';
        echo json_encode($rsp);
        exit();
    }else if($account==""){
        $rsp['ok']=false;
        $rsp['msg']='帳號不可為空';
        echo json_encode($rsp);
        exit();
    }else if($password==""){
        $rsp['ok']=false;
        $rsp['msg']='密碼不可為空';
        echo json_encode($rsp);
        exit();
    }else if($password_check==""){
        $rsp['ok']=false;
        $rsp['msg']='確認密碼不可為空';
        echo json_encode($rsp);
        exit();
    }

    $sql = "SELECT
                `me_num`
            FROM 
                `member`
            WHERE
                 `account`='$account'";
    $result_account = mysqli_query($link, $sql);
    $row_account = mysqli_fetch_assoc($result_account);

    $sql = "SELECT
                `me_num`
            FROM 
                `member`
            WHERE
                 `identity_card`='$identity_card'";
    $result_identity_card = mysqli_query($link, $sql);
    $row_identity_card = mysqli_fetch_assoc($result_identity_card);

    if($row_account){
        $datas['ok'] = false;
        $datas['msg'] = '帳號已經存在';
    }else if($row_identity_card){
        $datas['ok'] = false;
        $datas['msg'] = '身分證字號已經存在';
    }else{
        $sql = "INSERT INTO 
                    `member`(`mname`,`identity_card`,`phone`,`email`,`account`,`password`,`password_check`)
                VALUE 
                    ('$mname','$identity_card','$phone','$email','$account','$password','$password_check')";
        $result = mysqli_query($link, $sql);
        
        if ($result) {
            //註冊成功加10點
            $me_num = mysqli_insert_id($link);
            $sql = "UPDATE `member` SET `me_point` = `me_point` + 10 WHERE `me_num` = $me_num";
            $update_result = mysqli_query($link, $sql);
            
            if ($update_result) {
                $datas['ok'] = true;
            } else {
                $datas['ok'] = false;
                $datas['msg'] = '註冊成功，但更新me_point失敗';
            }
        } else {
            $datas['ok'] = false;
            $datas['msg'] = '註冊失敗';
        }
        
    }

    echo json_encode($datas);

    mysqli_close($link);
?>