<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //湯

    $pet_num = $_GET['pet_num'] ? $_GET['pet_num'] : "";
    require_once("db.php");
    $sql = "SELECT
                `pet_num`, 
                `pet_name`,
                `pet_type`,
                `variety`,
                `rebonse_times`,
                `rebonse_check`
            FROM 
                `pet_questionrebonse`
            WHERE
                `pet_num` = $pet_num";
    
    $result = mysqli_query($link, $sql);
    $datas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $datas[] = $row;
    }  
    echo(json_encode($datas));
    mysqli_close($link);
?>
