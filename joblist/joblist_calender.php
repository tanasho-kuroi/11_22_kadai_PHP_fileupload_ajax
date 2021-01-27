<?php
// ●●●●●●●●●●●●●●●　カレンダー表示　●●●●●●●●●●●●●●●●●●

// ●●●●●●●●●●●●　Web参照　●●●●●●●●●●●●●●●●●
//https://codeforfun.jp/php-calendar/#i

// タイムゾーンを設定
date_default_timezone_set('Asia/Tokyo');

// 前月・次月リンクが押された場合は、GETパラメーターから年月を取得
if(isset($_GET['ym'])){
    $ym = $_GET['ym'];
} else {
    // 今月の年月を表示
    $ym = date('Y-m');
}
// タイムスタンプを作成し、フォーマットをチェックする
$timestamp = strtotime($ym . '-01');//時刻の情報も入れたい場合はDateTimeImmutable
if($timestamp === false){
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

// 今日の日付 フォーマット　例）2021-01-13
$today = date('Y-m-j');
// カレンダーのタイトルを作成　例）2021年1月
$html_title = date('Y年n月', $timestamp);

// 前月・次月の年月を取得
// 方法１：mktimeを使う mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0,0,0,date('m',$timestamp)-1, 1, date('Y',$timestamp)));
$next = date('Y-m', mktime(0,0,0,date('m',$timestamp)+1, 1, date('Y',$timestamp)));
// 方法２：strtotimeを使う
// $prev = date('Y-m', strtotime('-1 month', $timestamp));
// $next = date('Y-m', strtotime('-1 month', $timestamp));

// 該当月の日数を取得
$day_count = date('t', $timestamp);
// １日が何曜日か　0:日 1:月 2:火 ... 6:土
// 方法１：mktimeを使う
$youbi =  date('w', mktime(0,0,0,date('m', $timestamp), 1, date('Y', $timestamp)));
// 方法2
// $youbi = date('w',$timestamp)

// カレンダー作成の準備
$weeks = [];
$week = '';

// 第１週目：空のセルを追加
// 例）１日が水曜日だった場合、日曜日から火曜日の３つ分の空セルを追加する
$week .= str_repeat('<td></td>', $youbi);//文字列<td>を、$youbi回だけ返す
for($day = 1; $day <= $day_count; $day++, $youbi++){
    //2021-01-28
    $date = $ym . '-' . $day;

    if($today==$date){
        // 今日の日付の場合は、class="today"をつける
        $week .= '<td class="today">' . $day;
    } else {
        $week .= '<td>' . $day;
    }
    $week .= '</td>';

    // 週終わり、または、月終わりの場合
    if($youbi % 7 ==6 || $day == $day_count){
        if($day == $day_count){
            // 月の最終日の場合、空セルを追加
            // 例）最終日が木曜日の場合、金・土曜日の空セルを追加
            $week .= str_repeat('<td></td>', 6 - ($youbi % 7));
        }
        // weeks配列にtrと$weekを追加する
        $weeks[] = '<tr>' . $week . '</tr>';
        // weekをリセット
        $week = '';
    }


}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>calender</title>
    <!-- (Bootstrap CDN)Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Google Fonts を読み込む -->
     <link rel="stylesheet" href="../css/calender.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&family=Noto+Sans+JP:wght@900&display=swap" rel="stylesheet">
    <style>
        .container{
            font-family: 'Noto Sans JP', sans-serif;
        }
    </style>
</head>
<body>
    <a href="../joblist/joblist_read.php">一覧に戻る</a>


    <div class="container">
        <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
        <table class="table table-bordered">
            <tr>
                <th>日</th>
                <th>月</th>
                <th>火</th>
                <th>水</th>
                <th>木</th>
                <th>金</th>
                <th>土</th>
            </tr>

            <!-- PHPで日付を作る。 -->
            <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
            ?>
<!--             
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>1</td>
                <td>2</td>

            </tr>
            <tr>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>

            </tr>
            <tr>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
            </tr>
            <tr>
                <td>17</td>
                <td>18</td>
                <td>19</td>
                <td>20</td>
                <td>21</td>
                <td>22</td>
                <td>23</td>
            </tr>
            <tr>
                <td>24</td>
                <td>25</td>
                <td>26</td>
                <td>27</td>
                <td class="today">28</td>
                <td>29</td>
                <td>30</td>

            </tr>        
            <tr>
                <td>31</td>        
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>         -->
        </table>    
    </div>

</body>
</html>