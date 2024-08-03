<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //湯
    $rsp = array();
    $datas = array();

    $me_num = $_GET['me_num'] ? $_GET['me_num'] : "";
    $pet_num = $_GET['pet_num'] ? $_GET['pet_num'] : "";
    $mname = $_GET['mname'] ? $_GET['mname'] : "";
    $phone = $_GET['phone'] ? $_GET['phone'] : "";
    $email = $_GET['email'] ? $_GET['email'] : "";
    $rebonse_times = $_GET['rebonse_times'] ? $_GET['rebonse_times'] : "";
    $info = $_GET['info'] ? $_GET['info'] : "";
    $subject = $_GET['subject'] ? $_GET['subject'] : "";

    if($info == ""){
        $rsp['ok']=false;
        $rsp['msg']='主旨不可為空';
    }else if($subject==""){
        $rsp['ok']=false;
        $rsp['msg']='內容不可為空';
    }
    else{
        require_once("db.php");

        $sql = "INSERT INTO 
            `rebonse_question`(`me_num`,`pet_num`, `mname`, `phone`, `email`, `rebonse_times`, `info`, `subject`) 
        VALUES 
            ('$me_num','$pet_num','$mname','$phone','$email','$rebonse_times','$info','$subject')";
        
            $result = mysqli_query($link, $sql);
        
        $sql = "UPDATE 
                    `pet_questionrebonse` 
                SET 
                    `rebonse_check` = 2 
                WHERE 
                    `pet_num` = $pet_num AND `rebonse_times` = $rebonse_times";
        $stmt = mysqli_query($link, $sql);

        $sql = "UPDATE 
                    `pet` 
                SET 
                    `reportfail` = 	`reportfail`+1
                WHERE 
                    `pet_num` = $pet_num";
        $stmt = mysqli_query($link, $sql);
        mysqli_close($link);
        
            if(!$result){               
                $rsp['ok']=false;
                $rsp['msg']='回報失敗';
            }
            else{
                $rsp['ok']=true;
                $rsp['msg']='回報成功';
            }
    }
    echo json_encode($rsp);
    exit();
?>