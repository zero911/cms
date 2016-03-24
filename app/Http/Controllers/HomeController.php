<?php
/**
 * Created by PhpStorm.
 * User: ziann
 * Date: 16/3/23
 * Time: 下午10:21
 */

namespace App\Http\Controllers;


class HomeController extends AdminBaseController
{
    /**
     * 后台首页处理函数
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHome(){
        return view('back.index');
    }

}