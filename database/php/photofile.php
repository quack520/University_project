<?php
    header("Content-Type: text/html; charset=utf-8");
    date_default_timezone_set("Asia/Taipei");
    header("Access-Control-Allow-Origin: *");

    //湯
    $rsp = array();
    $datas = array();

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["photo"])) {
        $uploadDir = "D:/quack/xampp/htdocs/aars/database/img/"; //資料夾路徑，確保資料夾存在並可寫入權限
        $uploadFile = $uploadDir . basename($_FILES["photo"]["name"]);
      
        //檢查檔案是否為圖片類型（可依需求修改）
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        if (!in_array($imageFileType, array("jpg", "jpeg", "png", "gif"))) {
          $rsp['ok'] = false;
          $rsp['msg'] = '只允許上傳 JPG、JPEG、PNG 或 GIF 圖片';
          echo json_encode($rsp);
          exit();
        }
      
        //檢查檔案大小（可依需求修改）
        if ($_FILES["photo"]["size"] > 5000000) {
          $rsp['ok'] = false;
          $rsp['msg'] = '檔案太大，限制為 5MB 以下';
          echo json_encode($rsp);
          exit();
        }
      
        //將照片移動到資料夾
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $uploadFile)) {
          $datas['ok'] = true;
          echo json_encode($datas);
          exit();
        } else {
          $rsp['ok'] = false;
          $rsp['msg'] = '照片上傳失敗';
          echo json_encode($rsp);
          exit();
        }
      } else {
        $rsp['ok'] = false;
        $rsp['msg'] = '獲取不到照片資訊';
        echo json_encode($rsp);
        exit();
      }
?>