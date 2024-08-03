<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    // 呱

    require_once("db.php");

    $me_num = isset($_GET['me_num']) ? $_GET['me_num'] : "";
    $updated_mname = isset($_GET['updated_mname']) ? $_GET['updated_mname'] : null;
    $updated_identity_card = isset($_GET['updated_identity_card']) ? $_GET['updated_identity_card'] : null;
    $updated_phone = isset($_GET['updated_phone']) ? $_GET['updated_phone'] : null;
    $updated_email = isset($_GET['updated_email']) ? $_GET['updated_email'] : null;
    $me_photo = isset($_GET['me_photo']) ? $_GET['me_photo'] : null;

    $rsp = array();
    $datas = array();

    $sql = "UPDATE `member` SET";
    $updates = array();
    if ($updated_mname !== null) {
        $updates[] = "`mname` = '$updated_mname'";
    }
    if ($updated_identity_card !== null) {
        $updates[] = "`identity_card` = '$updated_identity_card'";
    }
    if ($updated_phone !== null) {
        $updates[] = "`phone` = '$updated_phone'";
    }
    if ($updated_email !== null) {
        $updates[] = "`email` = '$updated_email'";
    }
    if ($me_photo !== null) {
        $updates[] = "`me_photo` = '$me_photo'";
    }
    
    //如果有需要更新的數值，建立SQL查詢
    if (!empty($updates)) {
        $sql .= " " . implode(", ", $updates);
        $sql .= " WHERE `me_num`='$me_num'";
        
        $result = mysqli_query($link, $sql);

        if ($result) {
            $datas['ok'] = true;
        } else {
            $datas['ok'] = false;
            $datas['msg'] = '修改會員資料失敗';
        }
    } else {
        $datas['ok'] = false;
        $datas['msg'] = '沒有要更新的資料';
    }

    mysqli_close($link);
    
    echo json_encode($datas); 
?>