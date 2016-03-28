<?php
/**
 * Created by PhpStorm.
 * User: ziann
 * Date: 16/3/26
 * Time: 上午1:41
 */

$sPrefix = 'article';
Route::group(['prefix' => $sPrefix], function () use ($sPrefix) {
    $sController = 'ArticlesController@';
    Route::get('/', ['as' => $sPrefix . '.index', 'uses' => $sController . 'index']);
    Route::get('{id}/view', ['as' => $sPrefix . '.view', 'uses' => $sController . 'view']);
    Route::get('{id}/destroy', ['as' => $sPrefix . '.destroy', 'uses' => $sController . 'destroy']);
    Route::any('{id}/edit', ['as' => $sPrefix . '.edit', 'uses' => $sController . 'edit']);
    Route::any('create', ['as' => $sPrefix . '.create', 'uses' => $sController . 'create']);
});