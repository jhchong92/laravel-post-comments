## Laravel Post Comments Application

Simple app with user registration, post and comments creation. Posts creation require valid authentication using api token.   

To setup locally, create a database, and run   
```
composer install
php artisan migrate:install 
php artisan migrate
```   

`phpunit` testing is also available.   
`./vendor/phpunit/phpunit/phpunit`   
