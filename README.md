# mogitate

・環境構築
　Dockerビルド
   1, git clone　git@github.com:hiroka-like-flowers/check-test2.git
   2, DockerDesktopの立ち上げ
   3,　dockerーcompose up -d --build
      (mysqlにplatform: linux/amd64を追加）
・laravel環境構築
   1, docker compose exec php bash
   2, .env作成
   3,　.envを編集
  　　　 DB_CONNECTION=mysql
　　　　　DB_HOST=mysql
　　　　　DB_PORT=3306
　　　　　DB_DATABASE=laravel_db
　　　　　DB_USERNAME=laravel_user
　　　　　DB_PASSWORD=laravel_pass
   4, アプリケーションキーの作成
   　　　php artisan key:generate
   5,
   6,
   7,
   ・使用技術
   　　・PHP 8.2.29
      ・Laravel Framework 8.83.29
      ・MySQL 8.0.26
・ER図

<img width="1764" height="600" alt="image" src="https://github.com/user-attachments/assets/e481815b-66e6-4843-aebb-5bc40258f7b4" />

・URL
　　・開発環境 http://localhost:8080/
　　・phpMyAdmin http://localhost:8081/
