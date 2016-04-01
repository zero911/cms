<?php
/**
 * Created by PhpStorm.
 * User: ziann
 * Date: 16/3/23
 * Time: 下午10:21
 */

namespace App\Http\Controllers;

use App\Models\RoleUser;
use App\Models\PermissionRole;
use App\Models\Permission;
use Session;

class HomeController extends AdminBaseController
{
    /**
     * 后台首页处理函数
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHome()
    {
        $iUserId=Session::get('admin_user_id');
        //得到当前用户的角色id
        $iRoleId = RoleUser::getRoleByUserId($iUserId);
        //等到当前用户所有的权限id数组
        $aPermissionIds = PermissionRole::getPermissionIdByRoleId($iRoleId);
        //得到当前用户的所有权限对象
        $oPermissions = Permission::getPermissionByPermissionIds($aPermissionIds);
        return view('back.index',['oPermissions'=>$oPermissions]);
    }
}