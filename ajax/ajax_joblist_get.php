<?php
// session_start();
include("../functions.php");
// check_session_id();

// ユーザ名取得
// $user_id = $_SESSION['id'];

$search_word = $_GET['searchWord'];

// var_dump($_GET);
// exit();
// DB接続
$pdo = connect_to_db();

// $sql = "SELECT * FROM todo_table WHERE todo LIKE '%PHP%'";<-動かないときは、まずは固定の文字列で確認
$sql = "SELECT * FROM joblist_table WHERE joblist LIKE '%{$search_word}%'";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':search_word', $search_word, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    // fetchAll()関数でSQLで取得したレコードを配列で取得できる
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
    echo json_encode($result);
    exit();
}
