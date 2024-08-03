<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    $rsp = array();
    $datas = array();
    $date = date("Y-m-d");
    $apply_num = $_GET['apply_num'] ? $_GET['apply_num'] : "";
    $pet_num = $_GET['pet_num'] ? $_GET['pet_num'] : "";

    require_once("db.php");
    $sql = "SELECT * 
                FROM 
                        `pet_apply` 
                WHERE 
                        `apply_num` = '$apply_num' AND `pet_num` = '$pet_num'";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) === 0) {
        $sql = "SELECT 
                    `mname` 
                FROM 
                    `member` 
                WHERE 
                    `me_num` = '$apply_num'";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);
            $apply_name = $row['mname'];
            $sql = "INSERT INTO `pet_apply`(`pet_num`,`apply_num`,`apply_name`,`date`) 
                    VALUES ('$pet_num','$apply_num','$apply_name','$date')";
            $result = mysqli_query($link, $sql);

            if ($result) {
                $datas['ok'] = true;
                $datas['msg'] = '申請成功';
            } else {
                $datas['ok'] = false;
                $datas['msg'] = '申請失敗';
            }
    } else {
        $datas['ok'] = false;
        $datas['msg'] = '已經申請過了';
    }
    echo json_encode($datas);
    mysqli_close($link);


?>