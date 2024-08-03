<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //呱

    $chatroom_userID1 = $_GET['chatroom_userID1'] == "" ? "" : $_GET['chatroom_userID1'];
    $chatroom_userID2 = $_GET['chatroom_userID2'] == "" ? "" : $_GET['chatroom_userID2'];

    $rsp = array();
    if($chatroom_userID1=="" or $chatroom_userID2==""){
        $rsp['ok']=false;
        $rsp['err_msg']='系統錯誤';
        echo json_encode($rsp);
        exit();
    }

    require_once("db.php");

    $sql = "SELECT 
                `chatroom_ID`
            FROM 
                `chatroom`
            WHERE
                `chatroom_userID1` = $chatroom_userID1 && `chatroom_userID2` = $chatroom_userID2 
                OR 
                `chatroom_userID1` = $chatroom_userID2 && `chatroom_userID2` = $chatroom_userID1" ;

    $result = mysqli_query($link, $sql);
    
    $row = mysqli_fetch_assoc($result);
    
    $query_other_user = "SELECT mname FROM member WHERE me_num = '$chatroom_userID2'";
    $result_other_user = mysqli_query($link, $query_other_user);
    $row_other_user = mysqli_fetch_assoc($result_other_user);
    $chatroom_name2 = $row_other_user['mname'];

    if($row){
        $datas['chatroom_ID'] = $row['chatroom_ID'];
    }else{
        $insertSql = "INSERT INTO 
                        `chatroom` (`chatroom_userID1`, `chatroom_userID2`,`chatroom_name`) 
                      VALUES 
                        ('$chatroom_userID1', '$chatroom_userID2', '$chatroom_name2')";
        $insertResult = mysqli_query($link, $insertSql);
        if ($insertResult) {
            // 新增成功，取得新插入的資料的 chatroom_ID
            // $datas['chatroom_ID'] = mysqli_insert_id($link);
            $newChatroomID = mysqli_insert_id($link);
            $datas['chatroom_ID'] = $newChatroomID;
        } else {
            $rsp['ok'] = false;
            $rsp['err_msg'] = '創建聊天室失敗';
            echo json_encode($rsp);
            exit();
        }
    }
    echo json_encode($datas); 
    mysqli_close($link);
?>