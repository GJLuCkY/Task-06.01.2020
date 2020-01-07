<?php

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

$router->group(['prefix' => 'api', 'namespace' => 'Api'], function () use ($router) {
    // Авторизация пользователей
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');

    // Получение списка всех категорий
    $router->get('categories', 'CategoryController@index');

    // Добавление/Редактирование/Удаление категории (для авторизованных пользователей)
    $router->post('categories', 'CategoryController@store');
    $router->put('categories/{categoryId}', 'CategoryController@edit');
    $router->delete('categories/{categoryId}', 'CategoryController@destroy');

    // Получение списка товаров в конкретной категории
    $router->get('categories/{categoryId}', 'CategoryController@show');

    // Добавление/Редактирование/Удаление товара (для авторизованных пользователей)
    $router->post('products', 'ProductController@store');
    $router->put('products/{productId}', 'ProductController@edit');
    $router->delete('products/{productId}', 'ProductController@destroy');

    // Добавить фильтры к товарам (цвет, вес, цена и тд), и реализовать метод получение товара по фильтру
    $router->post('products/{productId}/add_value', 'ProductController@addValue');
    $router->get('products', 'ProductController@index');
    // Добавить сущность тэгов к товарам и категориям, написать методы для вывода тэгов по товарам и категориям
    $router->get('tags', 'TagController@index');
    // Добавить роли (админ, модератор, пользователь) и на все методы с операциями добавление/редактирование/удаление поставить валидацию ролей админа и модератора
    // TODO
});
