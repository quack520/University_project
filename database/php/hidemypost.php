<?php

    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //呱

    require_once("db.php");

    $pet_num = isset($_GET['pet_num']) ? $_GET['pet_num'] : null;
    $good_num = isset($_GET['good_num']) ? $_GET['good_num'] : null;
    $hide_status = isset($_GET['hide_status']) ? $_GET['hide_status'] : null;
    
    if (!is_null($pet_num)) {
        $sql = "UPDATE pet SET hide_status = ? WHERE pet_num = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("ii", $hide_status, $pet_num);
        $stmt->execute();
        $stmt->close();
    } elseif (!is_null($good_num)) {
        $sql = "UPDATE good SET hide_status = ? WHERE good_num = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("ii", $hide_status, $good_num);
        $stmt->execute();
        $stmt->close();
    }
    
    mysqli_close($link);
?>