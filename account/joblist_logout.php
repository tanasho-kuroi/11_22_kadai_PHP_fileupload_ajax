<?php
session_start(); // セッションの開始

$_SESSION = array(); // セッション変数を空の配列で上書き
if (isset($_COOKIE[session_name()])) { //クッキーがある場合
    setcookie(session_name(), '', time() - 42000, '/');
} // クッキーの保持期限を過去にする
session_destroy(); // セッションの破棄
// クッキーとセッション両方破棄(別々の話なので)
header('Location:../account/joblist_login.php'); // ログインページヘ移動
exit();
