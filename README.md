##  勤怠管理  
###  Docker  
  1.git clone git@github.com:kens1987/attendance_management_app.git  
  2.docker-compose up -d --build  
###  Laravel環境構築  
  1.docker-compose exec php bash  
  2.composer install  
  3.envファイルは.env.exampleをコピーし修正  
    DB_HOST=mysql  
    DB_DATABASE=laravel_db  
    DB_USERNAME=laravel_user  
    DB_PASSWORD=laravel_pass  
  4.php artisan ley:generate  
  ※権限変更：$ sudo chmod -R 777 src/*  
  5.php artisan migrate  
  6.php artisan db:seed  
###  使用技術  
  
###  ER図  
  
###  URL  
  勤怠管理：http://localhost/login  
  一般ユーザー6名分のアカウント  
  メールアドレス：user1@example.com  
  メールアドレス：user2@example.com  
  メールアドレス：user3@example.com  
  メールアドレス：user4@example.com  
  メールアドレス：user5@example.com  
  メールアドレス：user6@example.com  
  パスワードは同じ：password123  
  管理者用勤怠：http://localhost/admin/login  
  管理者アカウント  
  メールアドレス：admin@example.com  
  パスワード：password123  
  php MyAdmin： http://localhost:8080/  
