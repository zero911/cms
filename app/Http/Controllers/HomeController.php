<?php
/**
 * Created by PhpStorm.
 * User: ziann
 * Date: 16/3/23
 * Time: 下午10:21
 */

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Session;

class HomeController extends AdminBaseController
{
    /**
     * 后台首页处理函数
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHome()
    {
        $iUserId = Session::get('admin_user_id');

        $aRoleIds = User::getRoles($iUserId);

        if (count($aRoleIds) < 1) {
            return view('back.index', ['msg' => '当前用户无角色信息，请联系超级管理员']);
        }
        $aPermissions = Role::getMenus($aRoleIds);

        return view('back.index', ['aPermissions' => $aPermissions]);
    }
}