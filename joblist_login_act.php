<?php
// var_dump($_POST);
// exit();

session_start(); // セッションの開始
include('functions.php'); // 関数ファイル読み込み
$pdo = connect_to_db(); // DB接続

$username = $_POST['username']; // データ受け取り→変数に入れる
$password = $_POST['password'];

// tableの選択, 必要なデータの取り出し
$sql = 'SELECT * FROM users_table
WHERE username=:username
AND password=:password
AND is_deleted=0'; //論理削除されていないか

// 定義
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();
//
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し、以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit;
}

// データの有無で分岐
$val = $stmt->fetch(PDO::FETCH_ASSOC); // 該当レコードだけ取得
if (!$val) { // 該当データがない(っkぴぉデータが一致していないとき)ときはログインページへのリンクを表示
    echo "<p>ログイン情報に誤りがあります．</p>";
    echo '<a href="joblist_login.php">login</a>';
    exit();
} else { //データがあった場合は、変数を格納する(必要なデータだけ！)

    $_SESSION = array(); // セッション変数を空にする
    $_SESSION["session_id"] = session_id();
    $_SESSION["is_admin"] = $val["is_admin"];
    $_SESSION["username"] = $val["username"]; //loginに直接必要ではないが、ページ上に名前表示とかのため取得する
    header("Location:joblist_read.php"); // 一覧ページへ移動
    exit();
}// session変数には必要な値を保存する（今回は管理者フラグとユーザ名）．
// 自身のアプリで使いたい値を保存しましょう！
