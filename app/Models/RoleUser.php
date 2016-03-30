<?php
/**
 * [用户角色关联模型]
 * User: ziann
 * Date: 16/3/25
 * Time: 下午8:24
 */

namespace App\Models;


class RoleUser extends BaseModel
{

    protected $table='yascmf_role_user';
    public $timestamps=false;

    /**
     *  [得到角色id]
     * @param $iUserId int 用户id
     * @return int 角色id
     */
    public static function getRoleByUserId($iUserId){
        $oRoleUser=static::where('user_id','=',$iUserId)->first();
        return $oRoleUser->role_id;
    }
}