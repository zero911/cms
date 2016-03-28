<?php

$sPrefix='upload';

Route::group(['prefix'=>$sPrefix],function()use($sPrefix){

    $sController='AdminController@';

    Route::get('/',['as'=>$sPrefix.'.upload','use'=>$sController.'getUpload']);
    Route::post('/',['as'=>$sPrefix.'.store','use'=>$sController.'postUpload']);
});