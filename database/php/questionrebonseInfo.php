<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //湯

    $rsp = array();
    $datas = array();

    $pet_num = $_GET['pet_num'] ? $_GET['pet_num'] : "";
    $rebonse_times = $_GET['rebonse_times'] ? $_GET['rebonse_times'] : "";

    require_once("db.php");
    $sql = "SELECT
                `list_type`, 
                `pet_name`,
                `pet_type`,
                `variety`,
                `age`,
                `ligation`,
                `rebonse_photo`,
                `rebonse_check`
            FROM 
                `pet_questionrebonse`
            WHERE
                `rebonse_times` = $rebonse_times AND `pet_num` = $pet_num";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);


$datas[] = $row;
echo json_encode($datas);
    mysqli_close($link);

?>