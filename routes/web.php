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

Route::get('/', function () {
    return view('welcome');
});

//图片上传公共地址
Route::post('uploadImg','PublicController@uploadImg')->name('uploadImg');

//微信服务端接收地址
Route::any('wechat','WechatController@serve');
