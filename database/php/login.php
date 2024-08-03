<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");
    session_start();

    //呱+湯

    $rsp = array();
    $datas = array();
    
    //接收前端的資料
    $account = $_GET['account'] ? $_GET['account'] : "";
    $password = $_GET['password'] ? $_GET['password'] : "";

    require_once("db.php");
    
    if (!isset($_GET['account'])) {
        $rsp['ok'] = false;
        $rsp['err_msg'] = '帳號不可為空';
    } else if (!isset($_GET['password'])) {
        $rsp['ok'] = false;
        $rsp['err_msg'] = '密碼不可為空';
    } else {
        $account = $_GET['account'];
        $password = $_GET['password'];
        $sql = "SELECT 
                    me_num 
                FROM 
                    member 
                WHERE `account`='$account' AND `password`='$password'";
        
        $result = mysqli_query($link, $sql);
        
        $row = mysqli_fetch_assoc($result);
        
        if ($row) {
            $rsp['me_num'] = $row['me_num'];
            $rsp['ok'] = true;
            $_SESSION['mname'] = $row['me_num'];
            //將登入狀態存在 Session
            $_SESSION['logged_in'] = true;
        
            $rebonse_num = $row['me_num'];
            $pet_sql = "SELECT reportfail, nonrebonse FROM pet WHERE rebonse_num = $rebonse_num";
            $pet_result = mysqli_query($link, $pet_sql);
            $pet_row = mysqli_fetch_assoc($pet_result);
        
            if ($pet_row) {
                $reportfail = $pet_row['reportfail'];
                $nonrebonse = $pet_row['nonrebonse'];
        
                if ($reportfail >= 3 || $nonrebonse >= 3) {
                    //更新 member 中的 me_block 為 1
                    $update_me_block_sql = "UPDATE member SET me_block = 1 WHERE me_num = $rebonse_num";
                    mysqli_query($link, $update_me_block_sql);
        
                    $rsp['err_msg'] = '帳號已封鎖，無法登入';
                    $rsp['ok'] = false;
                }
            }
        } else {
            $rsp['err_msg'] = '登入失敗，帳號或密碼錯誤';
            $rsp['ok'] = false;
        }
    }

    echo json_encode($rsp);
    mysqli_close($link);
?>
