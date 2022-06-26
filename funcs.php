<?php
//共通に使う関数を記述

//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}


function sql_error ($stmt) {
    $error = $stmt->errorInfo();
    exit("SQL_ERROR:".$error[2]);
}
