<?php

// ●●●●●●●●●●●●●●●　一覧表示　●●●●●●●●●●●●●●●●●●


//DB接続の関数化
session_start(); // セッションの開始
include('../functions.php'); // 関数ファイル読み込み

      // var_dump($_SESSION['session_id']);

check_session_id_read(); // idチェック関数の実行->ログインしていなくても、一覧表示だけはできる様にした。
// check_session_id(); 

$pdo = connect_to_db();//DB接続の関数の返り値を$pdoに代入



// データ取得SQL作成
$sql .= 'SELECT * FROM joblist_table LEFT OUTER JOIN 
(SELECT joblist_id, COUNT(id) AS cnt FROM like_joblist_table GROUP BY joblist_id) AS likes 
ON joblist_table.id = likes.joblist_id';
// １行目
// SELECT * FROM joblist_table　→joblist_tableを選択、
// LEFT OUTER JOIN 　→前後で指定したものを結合する
// ２行目
// (SELECT joblist_id, COUNT(id)
// 　→joblist_id,とCOUNT(id)(id数をカウントするもの) を選択(※GROUP BYしたい項目は、ここで選択したいずれかの項目にすること)
// FROM like_joblist_table GROUP BY joblist_id　→like_joblist_tableのjoblist_idごとに集計
// 上記より、like_joblist_tableのjoblist_idごとにCOUNT(id)を集計
// likes という仮想テーブルにする
// ちなみに、COUNT(id) AS cnt でCOUNT(id) をcntで定義
// ３行目
// 結合条件。joblist_table.id とlikes.joblist_id を連動させて結合。(likesは仮想テーブル)


// sortエラー。sql文が長いので、".=" で足していこうとしたがうまくいかなかった。
//  →間のにスペースを入れていないだけだった。あほちん。
if (isset($_POST['sort-resistDate'])) {//isset: 変数がセットされているかを調べる
  $sql .= ' ORDER BY resistDate DESC';
}elseif(isset($_POST['sort-joblist'])){
  $sql .= ' ORDER BY joblist ASC';
}elseif(isset($_POST['sort-skill'])){
  $sql .= ' ORDER BY skill ASC';
}elseif(isset($_POST['sort-category'])){
$sql .= ' ORDER BY category ASC';
}elseif(isset($_POST['sort-region'])){
$sql .= ' ORDER BY region ASC';
}else{
}



// SQL準備&実行
$stmt = $pdo->prepare($sql); //PDOクラスのprepareを引っ張ってくる


      // var_dump($_POST);

// 受け取ったデータを変数に入れる
// $joblist = $_POST['joblist'];
// $skill = $_POST['skill'];
// $region = $_POST['category'];
// $region = $_POST['region'];
// $resistDate = $_POST['resistDate'];
// var_dump($stmt);//object(PDOStatement)#2 (1) { ["queryString"]=> string(27) "SELECT * FROM joblist_table" }
// // exit();

//       var_dump($_POST);
//       var_dump($joblist);


//  (これももしかして要らない？）
$stmt->bindValue(':joblist', $joblist, PDO::PARAM_STR); //PDOクラスのbindValueを引っ張ってくる
$stmt->bindValue(':skill', $skill, PDO::PARAM_STR); 
$stmt->bindValue(':category', $category, PDO::PARAM_STR); 
$stmt->bindValue(':region', $region, PDO::PARAM_STR); 
$stmt->bindValue(':resistDate', $resistDate, PDO::PARAM_STR);

$status = $stmt->execute(); // SQLを実行 **エラーが起きていたのはMySQLの問題だった



// ●●●●●●●●●● 管理者かどうかでユーザ情報イジれるか変える(ただのリンク表示/非表示) ●●●●●●●●●●●
if ($_SESSION['is_admin'] == 1) {//管理者フラグがある場合
  $view_kanri='<div class="admin btn">
            <a href="../users/users_read.php">ユーザ管理画面へ</a>
            </div>';  
  $view_deleteAll='<div class="admin btn">
            <a href="../joblist/joblist_deleteall.php">全削除</a>
            </div>';
}else{
  $view_kanri="";
  $view_deleteAll="";
}

if ($status == false) {
  $error = $stmt->errorInfo();
  exit('sqlError:' . $error[2]);
} else {
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);//fetchAll 全てのデータを配列として格納する
  $output = "";
  $user_id = $_SESSION['id'];//いいね機能に使うuser_idの追加


// var_dump($result);//配列が全て入る
// exit();


  foreach ($result as $record) {

  // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
    if($record["delete_flag"]==1){//論理削除していたら何も表示しない
    }else{
      $output .= "<tr>"; //.=は追加していく演算子
      $output .= "<td>{$record["resistDate"]}</td>";
      $output .= "<td>{$record["joblist"]}</td>";
      $output .= "<td>{$record["skill"]}</td>";
      $output .= "<td>{$record["category"]}</td>";
      $output .= "<td>{$record["region"]}</td>";
      // ここで、ログインしていなかったら編集や削除ボタンが表示されない様にする。
      if ($_SESSION['refOnly'] == 1){//function check_session_id_read()にて定義

      } else {//ログインしている時は表示
          $output .= "<td><a href='../likes/like_create.php?user_id={$user_id}&joblist_id={$record["id"]}'>like{$record["cnt"]} </a></td>"; // cntカラムの数値（いいね数）を追加
          $output .= "<td><a href=../joblist/joblist_edit.php?id={$record["id"]}>編集</a></td>";//getでidを送っている
          $output .= "<td><a href=../joblist/joblist_logic_delete.php?id={$record["id"]}>削除</a>\n</td>";//論理削除
      }
      $output .= "</tr>";
      
      //  ↓HTMLに<tr><td>resistDate</td><td>joblist</td>....<tr>の形でデータが入る 
    }
  }
  

  // 削除したデータの表示。issetしているのは、一度削除を実行するまでmsgがundefinedであるため
  if(isset($_SESSION['deleteItem'])){//削除したデータの表示  SESSIONで定義(logic_deleteにて)
    $output_deleteData = "{$_SESSION['deleteItem']}";
    $_SESSION['deleteItem']="";//残り続けてしまうので、一度表示したらSESSIONの値は消去
  }else{
    $output_deleteData ="";
  }


  if (
    $_SESSION['refOnly'] == 1//function check_session_id_read()にて定義
  ) {//ログインしていない時はログインボタン
    $output_link = '<a href="../account/joblist_login.php">login</a>';
  } else {//ログインしている時はログアウトボタン
    $output_link = '<a href="../account/joblist_logout.php">logout</a>';
  }

      // $output .= "<td><a href=joblist_deleteall.php}>全削除</a>\n</td>";
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($record);
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DB連携型joblist（一覧画面）</title>
</head>

<body>
  <fieldset>
    <legend>DB連携型joblist（一覧画面）</legend>
    
    <a href="../joblist/joblist_input.php">入力画面</a>
    <!-- <a href="../account/joblist_logout.php">logout</a>-->
    <?= $output_link ?>

    <table>
      <thead>
        <tr>
          <th>resistDate</th>
          <th>joblist</th>
          <th>skill</th>
          <th>category</th>
          <th>region</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>resistDate</td><td>joblist</td>....<tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>

    </table>
        </br>

        <p>削除したデータ：<?= $output_deleteData ?></p>
        </br>
        </br>

        <a href="../joblist/joblist_logic_read.php">削除したデータを表示</a>
        </br>
        <a href="../joblist/joblist_calender.php">カレンダー表示</a>
        </br>
      <?= $view_deleteAll ?>


        <p>ソートボタン</p>
        <div class="sort-button">
          <form action="joblist_read.php" method="post">
            <button type="submit" name="sort-resistDate" class="btn btn-info" style="margin-right: 10px;">日付</button>
            <button type="submit" name="sort-joblist" class="btn btn-info" style="margin-right: 10px;">仕事内容</button>
            <button type="submit" name="sort-skill" class="btn btn-info" style="margin-right: 10px;">スキル</button>
            <button type="submit" name="sort-category" class="btn btn-info" style="margin-right: 10px;">カテゴリー</button>
            <button type="submit" name="sort-region" class="btn btn-info" style="margin-right: 10px;">地域</button>
          </form>
        </div>

  </fieldset>

  <!-- 管理者の場合、ユーザ管理画面に飛ぶ -->
      <?= $view_kanri ?>

</body>

</html>