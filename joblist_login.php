<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/main.css">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

  <!-- <style>
    .search_box button {
      height: 100%;
      width: 6%;
      top: -14px;
      right: 3px;
      padding: 0;
    }
  </style> -->

  <title>joblistログイン画面</title>
</head>
<body>
  <form action='joblist_login_act.php' method="POST">
    <fieldset>
      <legend>joblistログイン画面</legend>
      <div>
        username: <input type="text" name="username" id="username_input">
      </div>
      <div>
        password: <input type="text" name="password" id="password_input">
      </div>
      <div class="login_resister_btn">
        <button>Login</button>
      </div>
    </fieldset>
  </form>
  <div>
    <p>アカウントをお持ちでない方はこちら</p>
    <a href="joblist_register.php" class="login_resister_page_btn">アカウント作成</a>
    <a href="joblist_read.php" class="login_resister_page_btn">ログインせずに一覧をみる</a>
  </div>

  <div class="auto_input">
    <p>自動入力</p>
    <button id="btn">管理者 自動入力</button>
    <button id="btn2">一般 自動入力</button>
    <button id="btn3">クリア</button>
  </div>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script>
// 検証を楽にする用。自動でusernameとpasswordが入る様に。
      //管理者　自動入力 
      $('#btn').on('click', function () {
      // データの作成
        const autoKanrisha = [
          { autoUsername: '管理者', autoPassword: 'kanri'},
        ];
      
      // 内容を確認
      // console.log(autoKanrisha[0].autoUsername);
      // console.log(autoKanrisha[0].autoPassword);
      
        document.getElementById("username_input").value = autoKanrisha[0].autoUsername;
        document.getElementById("password_input").value = autoKanrisha[0].autoPassword;
      })
      // 一般ユーザ　自動入力
      $('#btn2').on('click', function () {
      // データの作成
        const autoKanrisha = [
          { autoUsername: 'ジーズ太郎1', autoPassword: '1000'},
        ];

      // 内容を確認
      // console.log(autoKanrisha[0].autoUsername);
      // console.log(autoKanrisha[0].autoPassword);

        document.getElementById("username_input").value = autoKanrisha[0].autoUsername;
        document.getElementById("password_input").value = autoKanrisha[0].autoPassword;
      })

      // 内容クリア
      $('#btn3').on('click', function () {
      // データの作成
        const autoKanrisha = [
          { autoUsername: '', autoPassword: ''},
        ];
        document.getElementById("username_input").value = autoKanrisha[0].autoUsername;
        document.getElementById("password_input").value = autoKanrisha[0].autoPassword;
      })

</script>


</body>

</html>