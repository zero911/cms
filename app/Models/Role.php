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

    protected $table = 'yascmf_roles';
//    public $timestamps=false;

    public static $rules = [
        'name' => 'required|alpha|between:3,10',
        'display_name' => 'required',
    ];

    public function permissions()
    {
        return static::belongsToMany('App\Models\Permission', 'yascmf_permission_role', 'role_id', 'permission_id');
    }

    public function compileContent($oRole, $aInputs)
    {

        $oRole->name = $aInputs['name'];
        $oRole->display_name = $aInputs['display_name'];
        if (array_key_exists('description', $aInputs['description'])) {
            $oRole->description = $aInputs['description'];
        }
        return $oRole;
    }
}