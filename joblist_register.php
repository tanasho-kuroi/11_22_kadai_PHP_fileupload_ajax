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

  <title>ユーザ登録画面</title>
</head>


<body>
  <form action="joblist_register_act.php" method="POST">
    <fieldset>
      <legend>ユーザ登録画面</legend>
      <div>
        username: <input type="text" name="username">
      </div>
      <div>
        password: <input type="text" name="password">
      </div>
      <div class="login_resister_btn">
        <button>アカウント登録</button>
      </div>
      <div>
      <p>既にアカウントをお持ちの方はこちら</p>
      <a href="joblist_login.php" class="login_resister_page_btn">ログイン</a>
      </div>
    </fieldset>
  </form>




</body>

</html>