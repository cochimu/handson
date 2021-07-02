# 01.ローカル環境の準備

ローカル開発環境は Mac であることを前提に説明

## Mac の設定

### Homebrew をインストールする

```bash
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/master/install.sh)"

brew -v # インストールを確認
Homebrew 3.2.0

brew tap "homebrew/bundle"
brew tap "homebrew/cask"
brew tap "homebrew/core"
brew tap "sanemat/font"
brew tap "homebrew/cask-fonts"
brew tap "heroku/brew"

brew tap # 現在のtap一覧を確認
# tapとは、公式以外のリポジトリをフォーミュラとしてHomebrewに追加するもので、brewのもとでinstall,uninstall,updateなどが行える

heroku/brew
homebrew/bundle
homebrew/cask
homebrew/cask-fonts
homebrew/core
sanemat/font
```

### PHP をインストールする

```bash
brew install "php"

php -v # インストールを確認
PHP 8.0.7

brew install "php-cs-fixer"
brew install "phpmd"
brew install "phpstan"
brew install "phpunit"
brew install "composer"

pecl install xdebug
```

### Docker のインストール

```bash
brew install "docker"
```

### PhpStorm のインストール

有料のツールですが、使用期間1ヶ月あります。

```bash
brew install "phpstorm"
```

# 02.laravelのインストール

## Laravel プロジェクトの作成

```bash
mkdir ~/php-projects/
cd ~/php-projects/

# laravel-handson という名前のディレクトリに新しいLaravelアプリケーションを作成
curl -s "https://laravel.build/laravel-handson" | bash

# ディレクトリを移動
cd laravel-handson/

# laravel-handson/docker-compose.yml の存在を確認してください
# 存在していない時は、`php artisan sail:install` コマンドで生成します。

# Docker の起動
./vendor/bin/sail up -d
```

## PhpStorm の起動

アプリケーションから PhpStorm を起動し、「開く」から「php-projects/laravel-handson」を開きます。

![images/php-storm-open.png](images/php-storm-open.png)


## ブラウザで確認する

http://localhost にアクセスすると、welcome 画面が表示されます


# 03.認証用ライブラリのインストール

```bash
cd laravel-handson/
sail composer require laravel/jetstream
sail artisan jetstream:install livewire
```

## マイグレーションを実行

```bash
sail artisan migrate
```

## JavaScript, sass のインストール＆コンパイル

```bash
sail npm install
sail npm run dev
```

## ブラウザで確認する

http://localhost にアクセスすると、welcome 画面にログイン、新規登録のリンクが出てきます。

## ローカライズ設定

`config/app.php` をエディタで以下のように編集する

```diff
-    'timezone' => 'UTC',
+    'timezone' => 'Asia/Tokyo',

-    'locale' => 'en',
+    'locale' => 'ja',

-    'faker_locale' => 'en_US',
+    'faker_locale' => 'ja_JP',
```

## 言語ファイルを設置

@see https://github.com/takehirotakiuchi/laravel-8-resources-lang-ja

```bash
git clone https://github.com/takehirotakiuchi/laravel-8-resources-lang-ja.git
cp -pR ./laravel-8-resources-lang-ja/resources ./
rm -rf laravel-8-resources-lang-ja
```

`resources/lang` ディレクトリに

- ja/auth.php
- ja/pagination.php
- ja/passwords.php
- ja/validation.php
- ja.json

が作成されます。

## 開発用ツールのインストール

```bash
sail composer require barryvdh/laravel-ide-helper --dev
sail composer require barryvdh/laravel-debugbar --dev
```

### ide-helper の設定

```bash
sail artisan ide-helper:generate
sail artisan ide-helper:model
```
