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
    $router->get('products', 'ProductController@index');

    // Получение списка товаров в конкретной категории
    $router->get('categories/{categoryId}/products', 'CategoryController@products');

    // Добавление/Редактирование/Удаление категории (для авторизованных пользователей)
    $router->put('categories/{categoryId}', 'CategoryController@create');
    $router->post('categories/{categoryId}', 'CategoryController@edit');
    $router->delete('categories/{categoryId}', 'CategoryController@delete');

    // Добавление/Редактирование/Удаление товара (для авторизованных пользователей)
    $router->put('products/{productId}', 'ProductController@create');
    $router->post('products/{productId}', 'ProductController@edit');
    $router->delete('products/{productId}', 'ProductController@delete');

    // Добавить фильтры к товарам (цвет, вес, цена и тд), и реализовать метод получение товара по фильтру
    // Добавить сущность тэгов к товарам и категориям, написать методы для вывода тэгов по товарам и категориям
    // Добавить роли (админ, модератор, пользователь) и на все методы с операциями добавление/редактирование/удаление поставить валидацию ролей админа и модератора
});
