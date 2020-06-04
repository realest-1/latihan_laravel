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

Route::get('/', function () {
    $articleList = App\Article::paginate(5);
    return view('home', compact('articleList'));
});

Auth::routes();
Auth::routes(['verify'=>true]);

Route::resource('article', 'ArticleController');
Route::get('/junk', 'ArticleController@junk')->name('article.junk');
Route::post('restore/{article}', 'ArticleController@restore')->name('article.restore');
Route::post('deletePermanently/{article}', 'ArticleController@deletePermanently')->name('article.deletePermanently');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/article', 'ArticleController@index')->name('article');
