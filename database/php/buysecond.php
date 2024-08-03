<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    $rsp = array();
    $datas = array();
    $today = date('Y-m-d');

    require_once("db.php");
    
    $good_num = $_GET['good_num'];
    $me_num = $_GET['me_num'];

    require_once("db.php");
    $sql = "SELECT * 
                FROM 
                        `good_apply` 
                WHERE 
                        `good_num` = '$good_num' AND `me_num` = '$me_num'";
    $result = mysqli_query($link, $sql);
    if(mysqli_num_rows($result) == false){
        $sql = "SELECT 
                    `mname`
                FROM 
                    `member`
                WHERE
                    `me_num` = '$me_num'";
        $res = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($res);
        $mname = $row['mname'];

        $sql = "INSERT INTO 
                    `good_apply`(`good_num`,`me_name`,`me_num`,`apply_date`)
                VALUES 
                    ('$good_num','$mname','$me_num','$today')";
        $res = mysqli_query($link, $sql);
        if(!$res)
        {
            $datas['ok'] = false;
            $datas['msg'] = '申請失敗';
        }else{
            $datas['ok'] = true;
            $datas['msg'] = '申請成功';                  
        }
    }else{
        $datas['ok'] = false;
        $datas['msg'] = '申請失敗';
    }
    echo(json_encode($datas));
    mysqli_close($link);
?>