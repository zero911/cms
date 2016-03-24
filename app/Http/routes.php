<?php

/*
|--------------------------------------------------------------------------
| 登录路由
|--------------------------------------------------------------------------
*/

loadRoutes(Config::get('routes.nologon'));

/*
|--------------------------------------------------------------------------
| 登录后的路由
|--------------------------------------------------------------------------
*/
Route::group(['middleware'=>'auth'],function(){
    #首页
    Route::get('/',['as'=>'admin.home','uses'=>'HomeController@getHome']);
    loadRoutes(Config::get('routes.logon'));
});


#定义加载路由的函数
function loadRoutes($sPath){

    $aRoutes=glob($sPath.'*.php');
    foreach($aRoutes as $route){
        include ($route);
    }
    unset($aRoutes);
}