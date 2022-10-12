# Requirements

PHP 7.4
Lumen 8

# Installation

1. Clone this repo

```
git clone https://github.com/mohrahmatullah/api-blogs.git
```


2. Setup

```
$ cd api-blogs
$ php artisan key:generate
put database credentials in .env file
$ php artisan jwt:secret
```

3. Migrate and insert records

```
$ php artisan migrate
$ php artisan db:seed --class=CategoryTableDataSeeder
$ php artisan db:seed --class=TagTableDataSeeder
$ php artisan db:seed --class=PostTableDataSeeder
```
