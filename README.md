# 早押しクイズ練習アプリ
## 概要
早押しクイズのプレイヤーが「問題をより早く押す技術」を身につけられるような練習用アプリです。<br>
知識はある程度ある(クイズ大会でペーパークイズは安定して突破できる)けれど、早押しが苦手だなぁと感じていたので作成してみました。大ざっぱに説明するとAnkiに早押し機能がついたようなアプリです。<br>
いわゆる短文基本とか、ベタ問とか、そういったクイズへの反応速度を上げて、実戦の場で機能するレベルまで持っていくことができるかと思います。
## 使用技術
PHP, Laravel, HTML, CSS, Tailwind, JavaScript, MariaDB <br>
ClosureTable(ディレクトリでクイズを階層的に管理するために使用), Cloudinary(画像投稿機能のため使用)
## テストアカウント
Email: test@example.com <br>
Password: password
## 使い方
### クイズ一覧
ログインや新規登録後に最初に表示されるページです。クイズがまだない場合は「[クイズ作成](https://github.com/kumakku/qapp#%E3%82%AF%E3%82%A4%E3%82%BA%E4%BD%9C%E6%88%90)」または「[CSVインポート](https://github.com/kumakku/qapp#csv%E3%82%A4%E3%83%B3%E3%83%9D%E3%83%BC%E3%83%88)」からクイズを追加してください。<br>
クイズがある場合は以下のようにテーブル形式で一覧表示されます。
- 問題文をクリックするとクイズの詳細情報が表示されます。
- 左上の検索窓にキーワードを入力することでクイズを絞り込むことができます。
- 編集・削除ボタンからそれぞれのクイズを編集・削除することができます。
<img width="1158" alt="image" src="https://github.com/kumakku/qapp/assets/136096006/162f2482-4a66-43d5-8d4a-0ff06ded07f8">

### クイズ作成
以下の項目を入力することで、新しいクイズを追加できます。

- 問題 **(入力必須)**
- 答え **(入力必須)**
- [ディレクトリ](https://github.com/kumakku/qapp#%E3%83%87%E3%82%A3%E3%83%AC%E3%82%AF%E3%83%88%E3%83%AA) **(選択必須)**
- 注釈 (記入しなくても可。メモしたいことがあれば)
- 画像 (追加しなくても可。複数の画像を追加可能。)
- タグ (選択しなくても可。複数のタグを付けることが可能。)
![hayaoshi-84f9bd8fe80b herokuapp com_quizzes_create](https://github.com/kumakku/qapp/assets/136096006/8b60f4a8-6c1c-4240-90ea-b9d024ec5d69)

### CSVインポート
#### ファイルを選択
以下のような各行が「問題文,答え」の形式のcsvファイルを選択してください。
<img width="1061" alt="スクリーンショット 2023-09-28 16 26 18" src="https://github.com/kumakku/qapp/assets/136096006/5ad71390-6d6d-4773-b04c-ad4037a6183a">
#### [ディレクトリ](https://github.com/kumakku/qapp#%E3%83%87%E3%82%A3%E3%83%AC%E3%82%AF%E3%83%88%E3%83%AA) を選択
csvファイル内の全てのクイズは単一のディレクトリに所属します。

![hayaoshi-84f9bd8fe80b herokuapp com_import_prepare](https://github.com/kumakku/qapp/assets/136096006/31340475-80ba-452c-89c7-4dd9d390ecc7)

### 早押しクイズ
### ディレクトリ
### タグ
