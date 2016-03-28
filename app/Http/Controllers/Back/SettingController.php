<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 16-3-28
 * Time: 下午8:33
 */

namespace App\Http\Controllers;


class SettingController extends AdminBaseController
{
    protected $customPath='back.setting';
    protected $custView=[
        'index','edit','create',
    ];
    protected $modelName='App\Models\Settings';
    protected $routeName='setting';

    public function index(){

        $sModel=$this->model;
        $data = $sModel->find(2);
        pr($data->type->toArray());
        pr($data->toArray());
        exit;
    }
}