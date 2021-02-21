# 職業やスキルの登録フォーム(ちょっと卒制意識)

## プロダクトの紹介

-  職業、地域などを登録。→joblist\_\*\*\*.php
-  ログインやアカウント作成関連。 →account\_\*\*\*.php
-  ユーザ管理。→users\_\*\*\*.php
-  いいね！機能。→likes\_\*\*\*.php
-  リアルタイム検索(未完)→joblist\_\*\*\*.php

## 工夫した点，こだわった点

-  最後だというのにほぼ写経。。。すみません。
-  検索結果の表示(嶋田さんのパクリ)

## 苦戦した点，共有したいハマりポイントなど

-  今回はとにかく取り組む時間を確保できなかった。
-
-

## やり残したこと

-  カレンダーを予約フォームに
-  like をいいねアイコンに
-  CSS 全般
-  検索機能(AND 検索)
-  マップ表示
-

### 詳細記録(雑多)

●●● 　 ◎：完了、○：おおよそ完了、△：いまいち、×：まだ　 ●●●

●●●●●●●●●●● 記録(前回前々回の記録もそのまま残している) ●●●●●●●●●●●●

◎ 授業の todo を置き換え → 動作確認
◎ ログインしているかしていないか
◎ ログイン情報を自動で入力するボタン

◎ 職業ジャンルわけ
単純に項目を一つ追加した。

◎ 管理者かどうか(ユーザのランク)で画面が変わる
joblist_read 画面にて、管理者の時にユーザ管理画面へのリンクが出る様にした(20210112)
joblist_read 画面にて、ログインしていない時に「登録、削除」ボタンを非表示にした(20210113)

※ユーザによる画面切り替え詳細 ↓
ユーザランク的なものを設ける？ →is_admin だけでは無理？
　 → ログインなし/ ログイン(会員)：0, 管理者:1
0 ログインなし：参照のみ(登録、削除ボタンを隠せばいい？)
1 会員：データユーザ登録まではできる、更新削除ができない。
2 管理者：ユーザ登録、更新、削除もすべて可能。
０と１は授業通り,id で見分ける！
１と２で is_admin を使う！！→ ログインは一緒。だけど is_admin 情報により管理者かどうか分ける。
is_admin は id や username とともに SESSION にいれて、どこでも照合できる。
また、表示の内容やリンクなどは変数にしていれてしまうことで、HTML 側がすっきりする！(しのさんのページ参照)

◎ いいね！機能動作確認

◎ カレンダーページの作成(20210128)

https://codeforfun.jp/php-calendar/#i

上記そのままに

× カレンダーページを予約フォームに
もうちょっと細かく、必要な要素を分解してみる。(結構道のり長い)

-  カレンダーから予約ページに飛ぶリンク(リンクは出来た)
-  カレンダーに job の表示（とりあえず表示のみ
-  job ごとに、空き時間情報の情報を加える → 新たに Table が必要か。とりあえず空き日のみ
   -> joblist と空き時間情報の id を紐付ける感じ？
-  job ごとにカレンダー表示を変える(空き時間表示)
-  予約情報 → 予約したら空き時間情報から予約時間を削除。これも新たに Table 作成か？
-
-

× CSS 全般
時間がめっちゃかかる。。。

○ 検索機能
授業と嶋田さんコードの写経。自分はまだまだ。。。

× カレンダー表示

× マップ表示

×

×

×
