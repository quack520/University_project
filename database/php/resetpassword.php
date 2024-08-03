<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");
    
    //呱+湯

    $msg = array();
    
    $password_old = $_GET['password_old'] ? $_GET['password_old'] : "";
    $password_new = $_GET['password_new'] ? $_GET['password_new'] : "";
    $password_check = $_GET['password_check'] ? $_GET['password_check'] : "";
    $password_num = $_GET['password_num'] ? $_GET['password_num'] : "";

    require_once("db.php");
    
    $msg['password_old'] = $password_old;
    $msg['password_new'] = $password_new;
    $msg['password_check'] = $password_check;
    
    $query = "SELECT * FROM member WHERE me_num = '$password_num'";
    $result = mysqli_query($link, $query);
    
    $foundRecord = false; //標記是否找到符合條件的紀錄
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row1 = mysqli_fetch_assoc($result);
        if ($password_old == $row1['password']) {
            if ($password_new == $password_check) {
                $me_num = $row1['me_num'];
                $foundRecord = true;
            } else {
                $rsp['ok'] = false;
                $rsp['msg'] = '新密碼和確認密碼不同';
                echo strcmp($password_new,$password_check );
                echo json_encode($rsp);
                exit();
            }
        } else {
            $rsp['ok'] = false;
            $rsp['msg'] = '密碼錯誤';
            echo json_encode($rsp);
            exit();
        }
    } else {
        $rsp['ok'] = false;
        $rsp['msg'] = '找不到指定會員';
        echo json_encode($rsp);
        exit();
    }
    
    if (!$foundRecord) {
        $msg['ok'] = false;
        $msg['msg'] = '找不到會員編號';
        echo json_encode($msg);
        exit();
    }
    
    $sql = "UPDATE `member` SET `password` = ?, `password_check` = ? WHERE `me_num` = ?";
    
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $password_new, $password_check, $me_num);
    mysqli_stmt_execute($stmt);
    
    if ($stmt) {
        $msg['ok'] = true;
        $msg['msg'] = '修改密碼成功';
    } else {
        $msg['ok'] = false;
        $msg['msg'] = '無法修改密碼';
    }
    
    echo json_encode($msg);
    
    mysqli_close($link);
?>
