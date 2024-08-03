<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //湯

    $me_num = $_GET['me_num'] ? $_GET['me_num'] : "";
    require_once("db.php");
    $sql = "SELECT
                `list_type`,
                `rebonse_num`,
                `pet_num`, 
                `pet_name`,
                `pet_type`,
                `variety`
            FROM 
                `pet`
            WHERE
                `me_num` = $me_num";
    
    $result = mysqli_query($link, $sql);
    $datas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rebonse_num = $row['rebonse_num'];
        if($rebonse_num!= 0){
            $datas[] = $row;
        }
    }

    echo(json_encode($datas));

    mysqli_close($link);
?>