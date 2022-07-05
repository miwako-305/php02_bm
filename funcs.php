<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}

function db_conn(){
    try {
        $db_name = "mw1994_gs_bm_table";    //データベース名
        $db_id   = "mw1994";      //アカウント名
        $db_pw   = "PyS-_EEq6Hj5";      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = "mysql57.mw1994.sakura.ne.jp"; //DBホスト
        return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
    } catch (PDOException $e) {
      exit('DB Connection Error:'.$e->getMessage());
    }
  } 

function sql_error ($stmt) {
    $error = $stmt->errorInfo();
    exit("SQL_ERROR:".$error[2]);
}

//SessionCheck(スケルトン)
function sschk(){
    if ( $_SESSION["chk_ssid"] != session_id() ) {
      exit("Login Error");
    }else{
      session_regenerate_id(true);
      $_SESSION["chk_ssid"] = session_id();
    }
  }