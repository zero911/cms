<?php
/**
 * [权限模型].
 * User: ziann
 * Date: 16/3/25
 * Time: 下午8:35
 */

namespace App\Models;


class Permission extends BaseModel
{

    protected $table='yascmf_permissions';

    /** [得到角色的所有权限]
     * @param $sPermissionIds string
     * @return object
     */
    public static function getPermissionByPermissionIds($sPermissionIds){
        return static::whereIn('id',$sPermissionIds)->get();
    }
}