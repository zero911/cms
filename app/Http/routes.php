<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function(){

  return view('auth.login');
});*/


/*
|--------------------------------------------------------------------------
| 登录路由
|--------------------------------------------------------------------------
*/


Route::group(['prefix' => 'auth'], function () {
//
    //AuthorityController
    $sController = 'AuthorityController@';
    Route::any('login', ['as' => 'login', 'uses' => $sController . 'login']);//登录
    Route::get('logout', ['as' => 'logout', 'uses' => $sController . 'logout']);//登出
    Route::any('forgot', ['as' => 'forgot', 'uses' => $sController . 'forgotPwd']);//忘记密码
});