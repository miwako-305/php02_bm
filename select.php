<?php

session_start();
require_once("funcs.php");

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=mw1994_gs_bm_table;charset=utf8;host=mysql57.mw1994.sakura.ne.jp','mw1994','PyS-_EEq6Hj5');
} catch (PDOException $e) {
  exit('DB connectionError:'.$e->getMessage());
}

sschk();

//２．データ取得SQL作成
$stmt = $pdo->prepare("select * from gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<a href="detail.php?id='.h($res["id"]).'">';
    $view .= h($res["id"])." : ".h($res["name"])." : ".h($res["comment"])."<br>";
    $view .= "</a>";
    $view .= '<a href="delete.php?id='.h($res["id"]).'">';
    $view .= "[削除]<br>";
    $view .= "</a>";
  }

}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">ブックマーク登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
