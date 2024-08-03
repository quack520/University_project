<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //呱
    require_once("db.php");

    mysqli_set_charset($link, "utf8");

    $me_num = $_GET['me_num'] == "" ? "" : $_GET['me_num'];
    
    if ($me_num == "") {
        //無效的 me_num，返回錯誤訊息和直接退出
        $rsp['ok'] = false;
        $rsp['err_msg'] = '無效的 me_num';
        echo json_encode($rsp);
        exit();
    }

    $query = "  SELECT *
                FROM 
                    chatroom 
                WHERE 
                    chatroom_userID1 = '$me_num' OR chatroom_userID2 = '$me_num'";

    $result = mysqli_query($link, $query);
    $datas = array();

    while ($row = mysqli_fetch_assoc($result)) {
        //對方ID
        $other_userID = ($me_num == $row['chatroom_userID1']) ? $row['chatroom_userID2'] : $row['chatroom_userID1'];
        
        //如果 userID1 和 userID2 都等於當前登入的 me_num，跳過這個聊天室
        if ($other_userID == $me_num) {
            continue;
        }

        //查詢對方的名稱和照片
        $query_other_user = "SELECT 
                               mname,
                               me_photo
                             FROM 
                               member 
                             WHERE 
                               me_num = '$other_userID'";
        $result_other_user = mysqli_query($link, $query_other_user);
        $row_other_user = mysqli_fetch_assoc($result_other_user);

        //獲取當前登入的名稱和照片
        $query_current_user = "SELECT 
                                 mname,
                                 me_photo
                               FROM 
                                 member 
                               WHERE 
                                 me_num = '$me_num'";
        $result_current_user = mysqli_query($link, $query_current_user);
        $row_current_user = mysqli_fetch_assoc($result_current_user);
    
        //根據登錄用戶設置 name1、name2 和 chatroom_name
        if ($me_num == $row['chatroom_userID1']) {
            $row['name1'] = $row_current_user['mname'];
            $row['name2'] = $row_other_user['mname'];
            $row['chatroom_name'] = $row_other_user['mname'];
        } elseif ($me_num == $row['chatroom_userID2']) {
            $row['name1'] = $row_other_user['mname'];
            $row['name2'] = $row_current_user['mname'];
            $row['chatroom_name'] = $row_other_user['mname'];
        }

        //設置 chatroom_photo 為對方的照片
        $row['chatroom_photo'] = $row_other_user['me_photo'];
    
        //更新 chatroom 表中的記錄
        $name1 = mysqli_real_escape_string($link, $row['name1']);
        $name2 = mysqli_real_escape_string($link, $row['name2']);
        $chatroom_name = mysqli_real_escape_string($link, $row['chatroom_name']);
        $chatroom_photo = mysqli_real_escape_string($link, $row['chatroom_photo']);
        $chatroom_ID = $row['chatroom_ID'];
        $update_query = "UPDATE 
                            chatroom
                        SET 
                            chatroom_name1 = '$name1',
                            chatroom_name2 = '$name2',
                            chatroom_name = '$chatroom_name',
                            chatroom_photo = '$chatroom_photo'
                        WHERE 
                            chatroom_ID = $chatroom_ID";
        mysqli_query($link, $update_query);
    
        $datas[] = $row;
    }
    echo json_encode($datas, JSON_UNESCAPED_UNICODE);
    mysqli_close($link);
?>