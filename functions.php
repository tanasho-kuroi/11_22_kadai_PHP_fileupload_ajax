<?php

function connect_to_db()
{
  // DB接続の設定
  // DB名は`gsacf_x00_00`にする
    $dbn = 'mysql:dbname=gsacf_d07_22;charset=utf8;port=3306;host=localhost';
    $user = 'root';
    $pwd = '';

    try {
        // ここでDB接続処理を実行する
        return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit();
    }
}

// ログイン状態のチェック関数
function check_session_id()
{ // 失敗時はログイン画面に戻る
        // var_dump($_SESSION['session_id']);//ここまでsession_idあるのに、if分岐の時はNULL

    if (
        !isset($_SESSION['session_id']) || // session_idがない
        $_SESSION['session_id'] != session_id() // idが一致しない
    ) {
        header('Location: ../account/joblist_login.php'); // 失敗時はログイン画面へ移動
        // このとき、ログイン失敗の表示したいが、、、またデータの受け渡しか。
    } else {
        session_regenerate_id(true); // セッションidの再生成
        $_SESSION['session_id'] = session_id(); // セッション変数上書き
    }
}

// read時の参照モード(ログインしない時)
function check_session_id_read()
{ // ログインしていない時は、編集・削除ボタンを表示しない
    if (
        !isset($_SESSION['session_id']) || // session_idがない
        $_SESSION['session_id'] != session_id() // idが一致しない
        // $_SESSION['session_id'] == NULL
    ) {
        $_SESSION['refOnly'] = 1;
        // header('Location: ./account/joblist_login.php'); // 失敗時はログイン画面へ移動
    } else {//ログインしている時は表示
        session_regenerate_id(true); // セッションidの再生成
        $_SESSION['session_id'] = session_id(); // セッション変数上書き
        $_SESSION['refOnly'] = 0;
    }
}



// // 管理者かどうかのチェック関数 →Page上でいいか？結局各ページで、管理者での対応が異なる
// function check_admin()
// { // 管理者の画面
//     if ($_SESSION['is_admin'] == 1) {//管理者フラグがある場合
//         $_SESSION[''] != session_id() // idが一致しない
//     } else {//通常ユーザの画面


//     }
// }
