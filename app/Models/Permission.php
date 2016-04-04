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

    const PERMISSION_MENU_TYPE = 1;//菜单权限
    const PERMISSION_PAGE_TYPE = 2;//页面行级权限,比如页面crud
    const PERMISSION_PAGE_SET_TYPE = 3;//页面行级设置权限,单独拿出

    public static $permissionType = [
        self::PERMISSION_MENU_TYPE => 'menu_permission',
        self::PERMISSION_PAGE_TYPE => 'page_permission',
        self::PERMISSION_PAGE_SET_TYPE => 'page_set_permission',
    ];

    public static $rules = [
        'name' => 'alpha_dash|between:3,60',
        'display_name' => 'required|between:2,20',
        'type' => 'required|numeric',
    ];

    /** [得到角色的所有权限]
     * @param $sPermissionIds string
     * @return object
     */
    public static function getPermissionByPermissionIds($sPermissionIds)
    {
        return static::whereIn('id', $sPermissionIds)->get();
    }

    public function saveContent($oModel, $aInputs, $is_create = true)
    {
        if ($is_create && static::where('name', '=', $aInputs['name'])->first()) return null;

        $oModel->display_name = e($aInputs['display_name']);
        $oModel->type = e($aInputs['type']);
        !array_key_exists('name', $aInputs) or $oModel->name = e($aInputs['name']);
        !array_key_exists('description', $aInputs) or $oModel->description = e($aInputs['description']);

        return $oModel;
    }

    /** [按类别获取权限]
     * @param int $type
     * @return mixed
     */
    public static function getPermissionByType($type = self::PERMISSION_MENU_TYPE)
    {
        if (is_array($type)) {
            return static::whereIn('type', $type)->get();
        }
        return static::where('type', '=', $type)->get();
    }
}