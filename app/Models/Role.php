<?php
/**
 * [用户角色模型]
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

        $oRole->name = e($aInputs['name']);
        $oRole->display_name = e($aInputs['display_name']);
        if (array_key_exists('description', $aInputs)) {
            $oRole->description = e($aInputs['description']);
        }
        return $oRole;
    }

    public static function getPermissions($id)
    {
        $aMyPers = [];
        $aPermissions = static::find($id)->permissions->toArray();
        foreach ($aPermissions as $per) {
            foreach ($per as $key => $value) {
                if ($key === 'pivot') {
                    $aMyPers[] = $value['permission_id'];
                }
            }
        }
        return $aMyPers;
    }
}