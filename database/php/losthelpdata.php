<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //呱

    require_once("db.php");

    $pet_num = $_GET['pet_num'];

    $sql = "SELECT 
                `me_num`,
                `pet_photo1`,
                `pet_photo2`,
                `pet_photo3`,
                `variety`,
                `pet_type`,
                `age`,
                `pet_sex`,
                `pet_size`,
                `color`,
                `ligation`,
                `pet_area`,
                `pub_time`,
                `pet_detail`,
                `mname`,
                `email`, 
                `phone`
            FROM 
                `pet`
            WHERE
                `pet_num` = '$pet_num'";
    
    $result = mysqli_query($link, $sql);

    $datas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $datas[] = $row;
    }

    echo(json_encode($datas));
    mysqli_close($link);
?>