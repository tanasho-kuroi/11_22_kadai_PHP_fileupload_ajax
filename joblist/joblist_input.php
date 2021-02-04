<!-- // ●●●●●●●●●●●●●●●　新規データ入力画面　●●●●●●●●●●●●●●●●●● -->

<?php
session_start(); // セッションの開始
include('../functions.php'); // 関数ファイル読み込み
check_session_id(); // idチェック関数の実行
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> 職業体験マッチング（入力画面）</title>
</head>

<body>
  <!-- formで"joblist_create_file.php" を使うよという宣言をする(最初これとenctypeが抜けてた) -->
  <form method="post" action="../joblist/joblist_create_file.php" enctype="multipart/form-data">/
    <fieldset>
      <legend> 職業体験マッチング（入力画面）</legend>
      <a href="../joblist/joblist_read.php">一覧画面</a>

      <div>
        お仕事: <input type="text" name="joblist" id="joblist_input">
      </div>
      <div>
        具体的なスキル(資格とかじゃなくてOK。何ができるか？を具体的に書いてください):</br>
        <input type="text" name="skill" id="skill_input">
      </div>
      <div>
        カテゴリー
        <input type="text" name="category" id="category_input">
      </div>
      <div>
        住んでいる地域: <input type="text" name="region" id="region_input">
      </div>
      <div>
        file: <input type="file" name="upfile" accept="image/*" capture="camera">
      </div>
      <div>
        登録日 <input type="date" name="resistDate" id="resistDate_input">
      </div>
      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

  <button id="btn">自動入力</button>
  <div id="echo"></div>
    
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script>
// <body>
//   <h1>オブジェクトの練習</h1>
//   <button id="btn">表示</button>
//   <div id="echo"></div>



      $('#btn').on('click', function () {

      // 乱数(ここは趣味)
        var random= Math.floor(Math.random()*11);
        console.log(random);
      // 乱数(日付)(ここは趣味)
        var ramdomdate = getRandomYmd('2020/12/01', '2021/1/31');

      // データの作成
        const classes = [
          { joblist: 'エンジニア', skill: 'PHP'+random, category: 'IT'+random,region: 'Japan',resistDate: ramdomdate },
        ];

      // 内容を確認
      // console.log(classes[0].joblist);
      // console.log(classes[0].skill);
      // console.log(classes[0].region);
      // console.log(classes[0].resistDate);

      // ブラウザ上に表示
        // $('#echo').html('<p>' + classes[0].joblist + '</p>' + '<p>' + classes[0].skill + '</p>')

        document.getElementById( "joblist_input" ).value = classes[0].joblist;
        document.getElementById( "skill_input" ).value = classes[0].skill;
        document.getElementById( "category_input" ).value = classes[0].category;
        document.getElementById( "region_input" ).value = classes[0].region;
        document.getElementById( "resistDate_input" ).value = classes[0].resistDate;
      })


      // 乱数(日付)(ここは趣味)
      function getRandomYmd(fromYmd, toYmd){
      
        var d1 = new Date(fromYmd);
        var d2 = new Date(toYmd);
      
        var c = (d2 - d1) / 86400000;
        var x = Math.floor(Math.random() * (c+1));
      
        d1.setDate(d1.getDate() + x);
      
        //フォーマット整形
        var y = d1.getFullYear();
        var m = ("00" + (d1.getMonth()+1)).slice(-2);
        var d = ("00" + d1.getDate()).slice(-2);
      
        return y + "-" + m + "-" + d;
      }
    
  </script>


</body>

</html>