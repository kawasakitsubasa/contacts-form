環境構築

Dockerビルド
・git clone git@github.com:kawasakitsubasa/contacts-form.git
・docker-compose up -d --build

Laravel環境構築

・docker-compose exec php bash
・composer install
・cp .env.example .env
・php artisan key:generate
・php artisan migrate
・php artisan db:seed

開発環境

・お問い合わせフォーム：http://localhost/
・管理者ログイン：http://localhost/login
・管理画面：http://localhost/admin
・ユーザー登録：http://localhost/register
・phpMyAdmin：http://localhost:8080/

使用技術

・PHP 8.2.11
・Laravel 8.83.8
・MySQL 8.0.26
・nginx 1.21.1
・jQuery 3.7.1

ER図



categories テーブル

| 型 | カラム名 | 制約 |
|----|---------|------|
| bigint | id | PK |
| varchar | content | NOT NULL |
| timestamp | created_at |  |
| timestamp | updated_at |  |

---

 users テーブル

| 型 | カラム名 | 制約 |
|----|---------|------|
| bigint | id | PK |
| varchar | name | NOT NULL |
| varchar | email | NOT NULL |
| varchar | password | NOT NULL |
| timestamp | created_at |  |
| timestamp | updated_at |  |

---

contacts テーブル

| 型 | カラム名 | 制約 |
|----|---------|------|
| bigint | id | PK |
| bigint | category_id | FK |
| varchar | last_name | NOT NULL |
| varchar | first_name | NOT NULL |
| tinyint | gender | NOT NULL |
| varchar | email | NOT NULL |
| varchar | tel | NOT NULL |
| varchar | address | NOT NULL |
| varchar | building |  |
| text | detail | NOT NULL |
| timestamp | created_at |  |
| timestamp | updated_at |  |

---

リレーション
- **categories.id** 1 --- n **contacts.category_id**
- **users.id**

