<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //呱

    require_once("db.php");


    $sql = "SELECT 
                `animal_id`,
                `animal_place`,
                `shelter_address`,
                `animal_sex`,
                `animal_kind`,
                `album_file`
            FROM 
                `coa_opendata`";

    $result = mysqli_query($link, $sql);

    $datas = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $datas[] = $row;
    }

    echo(json_encode($datas));

    // $query = "SELECT animal_id, animal_place, shelter_address, animal_sex, animal_kind FROM coa_opendata";
    // $result = $connection->query($query);
    // $data = [];
    // while($row = $result->fetch_assoc()) {
    //     $data[] = $row;
    // }
    // echo json_encode($data);


    mysqli_close($link);
?>