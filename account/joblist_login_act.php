<?php
// var_dump($_POST);
// exit();


// login時にuser_idをセッションに保存していなかったです。
// これを正しく渡してあげると「ユーザーごとにいいね有無を判定する」ので
// COUNT()による集計の意味も分かるかなと思いました
// (SQLで集計できるとそれだけで便利なんです、引っ張ったデータを加工する記述がなくなるので)。



session_start(); // セッションの開始
include('../functions.php'); // 関数ファイル読み込み
$pdo = connect_to_db(); // DB接続

$username = $_POST['username']; // データ受け取り→変数に入れる
$password = $_POST['password'];

// tableの選択, 必要なデータの取り出し
$sql = 'SELECT * FROM users_table
WHERE username=:username
AND password=:password
AND id
AND is_deleted=0'; //論理削除されていないか


// var_dump(id);
// var_dump($sql);
// exit();

// $user_id = session_id();//いいね機能に使うuser_idの追加
// $user_id = id;//いいね機能に使うuser_idの追加

// 定義
$stmt = $pdo->prepare($sql);

// $stmt->bindValue(':id', $id, PDO::PARAM_STR);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();


if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し、以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit;
}


// データの有無で分岐
$val = $stmt->fetch(PDO::FETCH_ASSOC); // 該当レコードだけ取得
if (!$val) { // 該当データがない(accountデータが一致していないとき)ときはログインページへのリンクを表示
    echo "<p>ログイン情報に誤りがあります．</p>";
    echo '<a href="../account/joblist_login.php">login</a>';
    exit();
} else { //データがあった場合は、変数を格納する(必要なデータだけ！)

    $_SESSION = array(); // セッション変数を空にする
    $_SESSION["session_id"] = session_id();
    $_SESSION["is_admin"] = $val["is_admin"];
    $_SESSION["user_id"] = $user_id;
    $_SESSION["username"] = $val["username"]; //loginに直接必要ではないが、ページ上に名前表示とかのため取得する
    header("Location:../joblist/joblist_read.php"); // 一覧ページへ移動
    exit();
}// session変数には必要な値を保存する（今回は管理者フラグとユーザ名）．
// 自身のアプリで使いたい値を保存しましょう！
