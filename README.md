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

```
+--------+----------+--------------------------+------+----------------------------------------------+--------------+
| Domain | Method   | URI                      | Name | Action                                       | Middleware   |
+--------+----------+--------------------------+------+----------------------------------------------+--------------+
|        | GET|HEAD | /                        |      | Closure                                      | web          |
|        | GET|HEAD | api/comments             |      | App\Http\Controllers\CommentController@index | api          |
|        | POST     | api/login                |      | App\Http\Controllers\AuthController@login    | api          |
|        | GET|HEAD | api/me                   |      | App\Http\Controllers\AuthController@me       | api,auth:api |
|        | POST     | api/post                 |      | App\Http\Controllers\PostController@store    | api,auth:api |
|        | GET|HEAD | api/posts                |      | App\Http\Controllers\PostController@index    | api          |
|        | GET|HEAD | api/posts/{post}         |      | App\Http\Controllers\PostController@show     | api          |
|        | POST     | api/posts/{post}/comment |      | App\Http\Controllers\CommentController@store | api          |
|        | POST     | api/register             |      | App\Http\Controllers\AuthController@register | api          |
|        | GET|HEAD | api/user                 |      | Closure                                      | api,auth:api |
+--------+----------+--------------------------+------+----------------------------------------------+--------------+   
```
