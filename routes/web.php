<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$router->get('/', function () {
    return view('welcome');
});

$router->auth();

$router->get('/home', 'HomeController@index')->name('home');
$router->get('/chat', 'Chat\\ChatController@index')->name('chat');

$router->get('/chat/messages', 'Chat\\ChatMessagesController@index')
       ->name('chat.messages');

$router->post('/chat/messages', 'Chat\\ChatMessagesController@store')
       ->name('chat.messages');
