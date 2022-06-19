<?php
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ
$name = $_POST ['name'];
$url = $_POST ['url'];
$comment = $_POST ['comment'];



//2. DB接続します
// try catch (catch以下はエラー時の対応)
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=php02_bm;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DB connectionError:'.$e->getMessage());
}


//３．データ登録SQL作成
// "="は変数を定義する　$stmt の中身に対して何かしたいときには [->],で関数

$stmt = $pdo->prepare("insert into gs_bm_table (name, url, comment, indate) values (:name, :url, :comment, sysdate())");
$stmt->bindValue(':name', $name, PDO::PARAM_STR );  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_ERROR:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("location: index.php");
  exit();
}
?>
