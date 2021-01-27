<?php

// var_dump($_GET);
// exit();

session_start();
include("../functions.php");
check_session_id();

$joblist_id = $_GET['joblist_id'];
$user_id = $_GET['user_id'];

// var_dump($joblist_id);
// var_dump($user_id);
// exit();

$pdo = connect_to_db();

// データ登録SQL作成
// `created_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
// $sql = 'INSERT INTO like_joblist_table(id, joblist_id, user_id, created_at) VALUES(NULL, :joblist_id, :user_id, sysdate())';
// 上記sql文は、条件分岐するため、後に移動(その前に、いいねの数で分岐処理するため)

//COUNT(*)で件数を引っ張る。該当項目の、何の件数？　後に、このuser_idからいいねされているかの判断に、COUNTが使われているということか？
$sql =
    'SELECT COUNT(*) FROM like_joblist_table WHERE user_id=:user_id AND joblist_id=:joblist_id';


// SQL準備&実行(一回実行。まずはuser_idとjoblist_idを引っ張ってくる)
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':joblist_id', $joblist_id, PDO::PARAM_INT);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$status = $stmt->execute(); //SQL実行

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    $like_count = $stmt->fetch();

    if ($like_count[0] != 0) { //既に同じuser_id から同じjoblist_idにいいねされている時。
        $sql = 'DELETE FROM like_joblist_table WHERE user_id=:user_id AND joblist_id=:joblist_id';
    } else {
        $sql = 'INSERT INTO like_joblist_table(id, user_id, joblist_id, created_at) VALUES(NULL, :user_id, :joblist_id, sysdate())';
        // var_dump($like_count[0]); //カウントできていることを確認
        // var_dump($joblist_id);
        // var_dump($user_id);
        // exit();
    }

    // SQL準備&実行(２回目実行。１回目の実行結果から分岐処理を行い、SQL文を定義。再度実行。)
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':joblist_id', $joblist_id, PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $status = $stmt->execute(); //SQL実行

    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    header("Location:../joblist/joblist_read.php");
    // exit();
}
