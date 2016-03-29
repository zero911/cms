<?php
/**
 * [用户角色关联模型]
 * User: ziann
 * Date: 16/3/25
 * Time: 下午8:24
 */

namespace App\Models;


class Role extends BaseModel
{

    protected $table='yascmf_roles';

    public static $rules=[
        'name'=>'required|alpha|between:3,10',
        'display_name'=>'required',
    ];

}