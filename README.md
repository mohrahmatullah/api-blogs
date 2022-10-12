# Requirements

PHP 7.4
Lumen 8

# Installation

1. Clone this repo

```
git clone https://github.com/mohrahmatullah/api-blogs.git
```

2. Install composer packages

```
cd api-blogs
$ composer install
```

3. Create and setup .env file

```
make a copy of .env.example
$ copy .env.example .env
$ php artisan key:generate
put database credentials in .env file
$ php artisan jwt:secret
```

4. Migrate and insert records

```
$ php artisan migrate
$ php artisan db:seed --class=CategoryTableDataSeeder
$ php artisan db:seed --class=TagTableDataSeeder
$ php artisan db:seed --class=PostTableDataSeeder
```
