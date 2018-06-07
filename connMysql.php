<?php 
    //資料庫主機設定
    $db_host = "localhost";
    $db_username = "jonz94";
    $db_password = "1234";
    $db_table = "homework";
    //設定資料連線
    //if (!mysqli_connect($db_host, $db_username, $db_password)) die("資料連結失敗！");
    //連接資料庫
    //if (!mysqli_select_db($db_table)) die("資料庫選擇失敗！");
    $conn = mysqli_connect($db_host, $db_username, $db_password, $db_table);
    if (!$conn) {
        die("連結失敗: " . mysqli_connect_error());
    }
    //設定字元集與連線校對
    // mysqli_query("SET NAMES 'utf8'");