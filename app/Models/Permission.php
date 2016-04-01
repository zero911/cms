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

    protected $table = 'yascmf_permissions';

    public static $rules = [
        'name' => 'alpha_dash',
        'display_name' => 'required|between:2,10',
    ];

    /** [得到角色的所有权限]
     * @param $sPermissionIds string
     * @return object
     */
    public static function getPermissionByPermissionIds($sPermissionIds)
    {
        return static::whereIn('id', $sPermissionIds)->get();
    }

    public function methods()
    {
        return static::belongsToMany('App\Models\Methods', 'yascmf_permission_method', 'permission_id', 'method_id');
    }

    public function saveContent($oModel, $aInputs,$is_create=true)
    {
        if($is_create && static::where('name','=',$aInputs['name'])->first()) return null;

        $oModel->display_name=e($aInputs['display_name']);
        !array_key_exists('name',$aInputs) or $oModel->name=e($aInputs['name']);
        !array_key_exists('description',$aInputs) or $oModel->description=e($aInputs['description']);

        return $oModel;
    }

    public static function getTypes(){
        return static::get(['id','type']);
    }
}