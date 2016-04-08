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
        return static::belongsToMany('App\Models\PermissionMethod', 'yascmf_permission_role', 'role_id', 'permission_id');
    }

    /** [用于创建和更新的函数]
     * @param $oRole object
     * @param $aInputs array
     * @return mixed
     */
    public function compileContent($oRole, $aInputs)
    {

        $oRole->name = e($aInputs['name']);
        $oRole->display_name = e($aInputs['display_name']);
        if (array_key_exists('description', $aInputs)) {
            $oRole->description = e($aInputs['description']);
        }
        return $oRole;
    }

    /** [得到角色的模块id数组，即模块权限数组]
     * @param $aRoleId array
     * @param $is_menu boolean true|false true仅获取菜单模块id
     * @return array
     */
    public static function getMethods($aRoleIds, $is_menu = true)
    {
        $aMethodIds = [];
        $aPermissions = static::whereIn('id', $aRoleIds)->get();
        foreach ($aPermissions as $per) {
            $oTmp = $per->permissions()->get();
            foreach ($oTmp as $value) {
                if ($is_menu) {
                    if ($value->permission_name == '模块访问') {
                        $aMethodIds[] = $value->method_id;
                    }
                } else {
/*                    $aMethodIds[$value->method_id][] = [
                        'permission_name' => $value->permission_name,
                        'permission_id' => $value->permission_id,
                        'method_id' => $value->method_id,
                        'method_name' => $value->method_name,
                    ];*/
                    $aMethodIds[] = $value->method_id;
                }

            }
        }
        return $aMethodIds;
    }
}