<?php
session_start();
include('../functions.php'); // 関数ファイル読み込み

check_session_id_read(); // idチェック関数の実行->ログインしていなくても、一覧表示だけはできる様にした。
// check_session_id(); 

// 入力チェック（未入力の場合は弾く，commentのみ任意）
if ( //!isset: 変数が宣言されてかつNULLではないこと。今回は！なのでその反対
  !isset($_POST['joblist']) || $_POST['joblist'] == '' || //POSTが入っていないか、データがからだった時
  !isset($_POST['skill']) || $_POST['skill'] == ''|| 
  !isset($_POST['category']) || $_POST['category'] == ''|| 
  !isset($_POST['region']) || $_POST['region'] == ''|| 
  !isset($_POST['resistDate']) || $_POST['resistDate'] == ''
) {
  exit('ParamError'); //処理終了しつつParamError出力
}

// 変数定義
$joblist = $_POST['joblist'];
$skill = $_POST['skill'];
$category = $_POST['category'];
$region= $_POST['region'];
$resistDate = $_POST['resistDate'];

if (!isset($_FILES['upfile']) && $_FILES['upfile']['error'] != 0) {
  // 送られていない，エラーが発生，などの場合
  exit('Error:画像が送信されていません');
} else {
  // アップロードしたファイル名を取得．
  // 一時保管しているtmpフォルダの場所の取得．
  // アップロード先のパスの設定（サンプルではuploadフォルダ <- 作成！）
  // コード
  $uploaded_file_name = $_FILES['upfile']['name']; //ファイル名の取得
  $temp_path = $_FILES['upfile']['tmp_name']; //tmpフォルダの場所
  $directory_path = '../upload/'; //アップロード先フォルダ
  // （↑自分で決める）
  // ファイルの拡張子の種類を取得．
  // ファイルごとにユニークな名前を作成．（最後に拡張子を追加）
  // ファイルの保存場所をファイル名に追加．
  $extension = pathinfo($uploaded_file_name, PATHINFO_EXTENSION);
  $unique_name = date('YmdHis') . md5(session_id()) . "." . $extension;
  $filename_to_save = $directory_path . $unique_name;
  // 最終的に「upload/hogehoge.png」のような形になる
  $img = '';
  if (!is_uploaded_file($temp_path)) {
    exit('Error:画像がありません'); // tmpフォルダにデータがない
  } else { // ↓ここでtmpファイルを移動する
    if (!move_uploaded_file($temp_path, $filename_to_save)) {
      exit('Error:アップロードできませんでした'); // 画像の保存に失敗
    } else {
      chmod($filename_to_save, 0644); // 権限の変更
    }
  }

  // DB接続
  $pdo = connect_to_db();
  // SQL作成&実行,カラム名と値  (SQL: DBの操作のための言語)
$sql = 'INSERT INTO 
joblist_table(id, joblist, skill, category, region, image, resistDate, created_at, updated_at)
VALUES(NULL, :joblist, :skill, :category, :region, :image, :resistDate, sysdate(), sysdate())';
// VALUESの「:」はバインド変数の宣言
  // var_dump($pdo);

  // SQL準備&実行
  $stmt = $pdo->prepare($sql);
  // var_dump($sql);

// バインド変数を設定
  $stmt->bindValue(':joblist', $joblist, PDO::PARAM_STR); //PDOクラスのbindValueを引っ張ってくる
  $stmt->bindValue(':skill', $skill, PDO::PARAM_STR); 
  $stmt->bindValue(':category', $category, PDO::PARAM_STR); 
  $stmt->bindValue(':region', $region, PDO::PARAM_STR); 
  $stmt->bindValue(':image', $filename_to_save, PDO::PARAM_STR);
  $stmt->bindValue(':resistDate', $resistDate, PDO::PARAM_STR);
  $status = $stmt->execute();

  // var_dump($sql);

  if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
  } else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し、入力ページの処理実行
  header('Location:../joblist/joblist_input.php');
  }
}
