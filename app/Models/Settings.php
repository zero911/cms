<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 16-3-28
 * Time: 下午1:24
 */

namespace App\Models;


class Settings extends BaseModel
{
    protected $table= 'yascmf_settings';

    public function type(){
        return $this->belongsTo('App\Models\SettingType','type_id');
    }
}