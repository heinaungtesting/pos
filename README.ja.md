# POS System

Laravel フレームワークで作成した、売上・在庫・顧客注文を管理するための POS（Point of Sale）システムです。

## このプロジェクトについて

このプロジェクトは、店舗やビジネスが販売業務、在庫、顧客取引を効率よく管理できるように作成した Web ベースの POS アプリケーションです。

## Language

[**English**](./README.md) | **日本語**

## 📄 ポートフォリオ選考用説明

### 成果物名

POS System

### 制作期間

開始日：2024年10月16日  
終了日：2025年12月16日

### 制作の目的・意図

POS Systemは、オンラインショップと店舗管理をイメージして作ったLaravelアプリケーションです。

このプロジェクトを作ったきっかけは、自分の家族のために、商品をオンラインで管理・販売できる仕組みを作りたいと思ったことです。家族が商品を登録し、注文を確認し、お客様が商品を見て購入できるようなシステムを目指しました。

しかし、ミャンマーでは地域によって、インターネットやWi-Fiが安定しないこと、停電が多いことなどがあり、すぐに実際の運用まで進めることは難しかったです。それでも、このプロジェクトを通して、実際の店舗やオンラインショップで必要になる機能を考えながら、Webアプリケーションを作る経験ができました。

制作の目的は、Laravelを使って、商品管理、注文管理、カート、決済、ユーザー管理など、業務システムに近い機能を学ぶことです。また、ただ画面を作るだけではなく、データベース設計、認証、権限管理、データを安全に扱う方法も学ぶことを目的にしました。

### 主な機能

- 管理者・顧客のロール別画面
- 商品カテゴリ管理
- 商品登録・編集・削除
- 商品一覧
- 商品検索
- フィルター、並び替え
- カート
- チェックアウト
- 注文履歴
- 決済方法管理
- 支払い履歴
- コメント、評価、問い合わせ機能
- 管理者プロフィール・アカウント管理

### 使用技術

- Laravel
- PHP
- Blade
- Tailwind CSS
- Bootstrap
- jQuery
- Laravel Breeze
- Sanctum
- Socialite
- Vite
- MySQL

### 自分が担当した範囲

このプロジェクトは個人開発として制作しました。管理者画面、顧客画面、商品管理、カテゴリ管理、カート、注文、決済まわり、画面テンプレートの統合、動作確認まで自分で行いました。

### 制作した過程で努力した点

一番大変だった点は、必要なことをほとんど一から学びながら作ったことです。

Laravelのルーティング、コントローラー、Bladeテンプレート、Eloquent、マイグレーション、認証、権限管理など、最初は分からないことが多くありました。特に、商品、ユーザー、注文、支払いなどのデータをどうつなげるかというデータベース設計は難しかったです。

また、管理者と顧客で使える機能を分けることも意識しました。管理者は商品や注文を管理でき、顧客は商品を探して、カートに入れて、注文できるようにしました。

さらに、オンラインショップではユーザー情報や注文情報を扱うため、データを安全に扱うことも大切だと感じました。そのため、認証、権限、入力フォーム、データ保存の流れについても学びながら実装しました。

開発中には、ルーティングエラー、データベースエラー、ビューの表示崩れ、認証まわりの問題などが何回もありました。そのたびに、エラー文を読み、公式ドキュメントや参考資料を確認しながら、一つずつ修正しました。

このプロジェクトを通して、ただコードを書くことだけではなく、実際に使う人を考えて、管理画面、顧客画面、データの流れを設計することの大切さを学びました。

### 今後改善したい点

今後、ミャンマーのインターネット環境や電力環境が安定したら、このシステムをより実用的なオンラインショップとして発展させたいです。

また、AIエンジニア職を目指しているため、将来的にはAIエージェントやMCPと連携し、より自動化されたAgentic Appにしたいと考えています。

例えば、管理者が自然な言葉で「今週よく売れた商品を教えて」「在庫が少ない商品をまとめて」「新しい商品の説明文を作って」と入力すると、AIエージェントがデータベースを確認し、必要な情報を整理したり、商品説明文を作ったりできるようにしたいです。

技術面では、ルート名やコントローラー名の整理、テスト追加、決済処理の安定化、README改善、初期データの整理、セキュリティ強化を進めたいです。

## 技術スタック

- **Framework:** Laravel 11.9（PHP 8.2+）
- **Authentication:** Laravel Breeze、Sanctum、Socialite
- **Frontend:** Blade テンプレートエンジン、Tailwind CSS
- **Build Tool:** Vite
- **Notifications:** RealRashid SweetAlert
- **Debug Tool:** Laravel Debugbar（開発環境）
- **Package Manager:** Composer、NPM

## システム要件

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL / PostgreSQL / SQLite データベース
- Web サーバー（Apache / Nginx）

## 主な機能

### 🔐 認証・認可

- **Laravel Breeze** - ログイン、会員登録、パスワードリセットなどの認証機能
- **Laravel Sanctum** - API トークン認証
- **Social Login（Laravel Socialite）** - Google、GitHub などのプロバイダーでログイン
- **Role-Based Access Control** - 3 種類のユーザーロール
  - **Super Admin** - 管理者管理を含むシステム全体へのアクセス
  - **Admin** - カテゴリー、商品、注文、支払い方法の管理
  - **User/Customer** - 商品購入と注文
- **Middleware Protection** - ルート単位のアクセス制御（`admin`、`superadmin`、`user` ミドルウェア）

### 👥 ユーザー管理（Super Admin のみ）

- 新しい管理者アカウントの作成
- 管理者一覧の表示
- 管理者アカウントの削除
- ユーザー / 顧客一覧の表示
- ユーザーアカウントの削除

### 📦 商品管理（Admin）

- 新商品の作成
- ページネーション付きの商品一覧表示
- 商品情報の更新
- 商品の削除
- 商品説明の表示
- 商品画像のアップロード

### 📂 カテゴリー管理（Admin）

- カテゴリーの作成
- カテゴリー一覧の表示
- カテゴリーの更新
- カテゴリーの削除

### 💳 支払い方法管理（Admin）

- 支払い方法の追加
- 支払い方法一覧の表示
- 支払い方法の更新
- 支払い方法の削除

### 🛒 顧客向けショッピング機能

- カテゴリー別の商品閲覧
- 商品詳細の表示
- 商品をカートに追加
- ショッピングカートの表示
- カート内商品の削除
- 注文の作成
- 注文一覧の表示
- 商品評価システム
- 商品コメント / レビュー機能
- 自分のコメントの削除

### 📦 注文管理

- **管理者側:**
  - すべての注文を表示
  - 注文詳細を表示
  - 注文ステータスの変更
  - 注文の承認
  - 注文の拒否

- **顧客側:**
  - 注文履歴の表示
  - 注文ステータスの確認

### 👤 プロフィール管理

- **管理者プロフィール:**
  - プロフィール表示
  - プロフィール情報の編集
  - パスワード変更

- **顧客プロフィール:**
  - 顧客情報の表示
  - 個人情報の更新
  - パスワード変更

### 📞 お問い合わせ機能

- 顧客向けお問い合わせフォーム
- お問い合わせメッセージの送信

### 🔌 API エンドポイント

- ユーザー認証（Sanctum 保護）
- 商品一覧 API
- 削除 API

## インストール方法

### 1. リポジトリをクローン

```bash
git clone https://github.com/heinaungtesting/pos.git
cd pos
```

### 2. 依存関係をインストール

```bash
# PHP の依存関係をインストール
composer install

# NPM の依存関係をインストール
npm install
```

### 3. 環境設定

```bash
# 環境設定ファイルをコピー
cp .env.example .env

# アプリケーションキーを生成
php artisan key:generate
```

### 4. データベース設定

`.env` ファイルを編集して、データベース情報を設定します。

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pos_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. ソーシャルログイン設定

`.env` にソーシャル認証プロバイダーを設定します。

```env
# Google OAuth
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URL=http://localhost:8000/auth/google/callback

# GitHub OAuth（または他のプロバイダー）
GITHUB_CLIENT_ID=your_github_client_id
GITHUB_CLIENT_SECRET=your_github_client_secret
GITHUB_REDIRECT_URL=http://localhost:8000/auth/github/callback
```

### 6. マイグレーション実行

```bash
# データベースマイグレーションを実行
php artisan migrate

# （任意）サンプルデータを投入
php artisan db:seed
```

### 7. アセットをビルド

```bash
# 本番用ビルド
npm run build

# または、ホットリロード付きの開発サーバーを起動
npm run dev
```

### 8. アプリケーションを起動

```bash
# Laravel 開発サーバーを起動
php artisan serve
```

アプリケーションは `http://localhost:8000` で利用できます。

## データベース構成

このシステムには、以下のテーブルが含まれています。

- **users** - ユーザーアカウントとロール
- **products** - 商品カタログ
- **categories** - 商品カテゴリー
- **orders** - 顧客注文
- **carts** - ショッピングカートの商品
- **payments** - 支払い方法
- **payment_histories** - 支払い取引ログ
- **discounts** - 割引管理
- **ratings** - 商品評価
- **comments** - 商品コメントとレビュー
- **contacts** - 顧客からのお問い合わせメッセージ
- **action_logs** - システム操作の監査ログ

## ユーザーロールと権限

### Super Admin

- すべての管理者権限
- 管理者アカウントの作成 / 削除
- ユーザー管理

### Admin

- カテゴリー管理（作成、更新、削除）
- 商品管理（作成、更新、削除）
- 注文管理（表示、承認、拒否、ステータス変更）
- 支払い方法の管理
- プロフィール編集とパスワード変更

### User/Customer

- 商品の閲覧
- カート追加とチェックアウト
- 注文作成と注文履歴の確認
- 商品の評価とコメント
- プロフィール管理
- お問い合わせメッセージの送信

## ルート構成

### 管理者ルート（`/admin/*`）

- `admin` ミドルウェアが必要
- `/admin/home` - 管理者ダッシュボード
- `/admin/category/*` - カテゴリー管理
- `/admin/product/*` - 商品管理
- `/admin/order/*` - 注文管理
- `/admin/profile/*` - 管理者プロフィール & ユーザー管理

### 顧客ルート（`/customer/*`）

- `user` ミドルウェアが必要
- `/customer/home` - 顧客ホームページ
- `/customer/product/detail/{id}` - 商品詳細
- `/customer/cart` - ショッピングカート
- `/customer/orderlist` - 注文履歴
- `/customer/profile/*` - 顧客プロフィール管理

### API ルート（`/api/*`）

- `/api/user` - 認証済みユーザーの取得（Sanctum 保護）
- `/api/product/list` - 商品一覧の取得
- `/api/delete` - リソース削除

## 開発

### 開発モードで実行

```bash
# ターミナル 1: Laravel サーバーを起動
php artisan serve

# ターミナル 2: ホットリロード用 Vite 開発サーバーを起動
npm run dev
```

### コードフォーマット

```bash
# Laravel Pint を使ってコードを整形
./vendor/bin/pint
```

## テスト

```bash
# すべてのテストを実行
php artisan test
```

## デプロイ

このプロジェクトには、以下の設定ファイルが含まれています。

- **Docker** - `dockerfile`
- **Vercel** - `vercel.json`
- **Netlify** - `netlify.toml`

### 本番環境チェックリスト

- [ ] `.env` で `APP_ENV=production` を設定
- [ ] `.env` で `APP_DEBUG=false` を設定
- [ ] データベース認証情報を設定
- [ ] SSL 証明書を設定
- [ ] ソーシャルログイン認証情報を設定
- [ ] `php artisan config:cache` を実行
- [ ] `php artisan route:cache` を実行
- [ ] `php artisan view:cache` を実行
- [ ] アセットをビルド: `npm run build`

## セキュリティ機能

- すべてのフォームで CSRF 保護
- bcrypt によるパスワードハッシュ化
- ロールベースのミドルウェア保護
- Sanctum API 認証
- XSS 対策
- Eloquent ORM による SQL インジェクション対策

## ライセンス

このプロジェクトは非公開のプロプライエタリソフトウェアです。

---

**Laravel Version:** 11.9  
**PHP Version:** 8.2+
