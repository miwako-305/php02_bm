<?php
//1. POSTデータ取得
$id   = $_GET["id"];

//2. DB接続します
require_once("funcs.php");

sschk();

//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=mw1994_gs_bm_table;charset=utf8;host=mysql57.mw1994.sakura.ne.jp','mw1994','PyS-_EEq6Hj5');
} catch (PDOException $e) {
  exit('DB connectionError:'.$e->getMessage());
}

//３．データ登録SQL作成
$sql = "delete from gs_bm_table where id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    header("location: select.php");
    exit();
}

?>
