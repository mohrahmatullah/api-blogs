<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->post('/logout', 'AuthController@logout');
        
        $router->get('profile', 'AuthController@profile');
        $router->get('profile-user', 'AuthController@profile_user');

        $router->get('/posts', 'PostController@index');
        $router->get('/posts/{id}', 'PostController@show');
        $router->post('/posts', 'PostController@store');
        $router->post('/posts/{id}', 'PostController@update');
        $router->delete('/posts/{id}', 'PostController@destroy');

        $router->get('/category', 'CategoryController@index');        
        $router->get('/category/{id}', 'CategoryController@show');
        $router->post('/category', 'CategoryController@store');
        $router->post('/category/{id}', 'CategoryController@update');
        $router->delete('/category/{id}', 'CategoryController@destroy');

        $router->get('/tag', 'TagController@index');        
        $router->get('/tag/{id}', 'TagController@show');
        $router->post('/tag', 'TagController@store');
        $router->post('/tag/{id}', 'TagController@update');
        $router->delete('/tag/{id}', 'TagController@destroy');
    });

    $router->get('/posts/category/{id}', 'HomeController@index');
    $router->get('/posts/{id}', 'HomeController@show');
    $router->get('/tag', 'TagController@index');  
});
