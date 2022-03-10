<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'ArticleController@article_view')->name('articles');//index,localhostのurlにアクセス時(get)、ArticleControllerの関数article_viewを渡す
Route::post('/', 'ArticleController@article_save')->name('article_save');//index,localhostのurlからの送信時(post)、ArticleControllerの関数article_saveを渡す
Route::get('/detail/{id}', 'CommentController@show_detail')->name('show');
Route::post('/detail/{id}', 'CommentController@comment_save')->name('comment_save');
Route::delete('/detail/{id}', 'CommentController@comment_destroy')->name('destroy');



