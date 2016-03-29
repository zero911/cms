<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 16-3-28
 * Time: 下午7:11
 */

namespace App\Http\Controllers;

use Cache;
use Illuminate\Support\Facades\Validator;
use Request;
use Auth;

class SettingTypeController extends AdminBaseController
{

    protected $customPath = 'back.setting_type';
    protected $customView = ['index', 'edit', 'create'];
    protected $modelName = 'App\Models\SettingType';
    protected $routeName = 'setting_type';

    public function beforeRender()
    {
        parent::beforeRender(); // TODO: Change the autogenerated stub
        $this->setVars('_title', __('_basic.setting_ype'));
        $this->setVars('oUser', Auth::user());
    }


    /**
     * [index 加入缓存功能]
     * @return mixed
     */
    public function index()
    {

        if (Cache::has('system_type')) {
            $datas = Cache::get('system_type');
        } else {
            if (is_null($this->request) || !$this->bExtraSearch) {
//            pr($this->model);exit;
                $oQuery = $this->model->where('id', '>', 0);
                //若存在页面自定义条件检索则追加where
                $oQuery = $this->bCustomCondition ? $this->model->doWhere($this->aCustomConditionArray) : $oQuery;
            } else {
                $aData = trimArray($this->request->except('_token'));
//            组装数组格式
                $aData = $this->makeSearchCondition($aData);
                $oQuery = $this->indexQuery($aData);
                $pageSize = $this->request->input('pageSize');
            }
            $pageSize = isset($pageSize) && is_numeric($pageSize) ? $pageSize : static::$pageSize;
            $datas = $oQuery->paginate($pageSize);
            Cache::put('system_type', $datas, 60 * 24 * 7);
        }
        //分页部分
        $this->setVars('types', $datas);
        return $this->render();
    }

    public function create()
    {

        $sModel = $this->model;
        if (Request::isMethod('post')) {
            $aData = trimArray(Input::all());
            $validate = Validator::make($aData, $sModel::$rules);
            if (!$validate->passes()) {
                return $this->goBack('error', __('_basic.validate-error'));
            }
            $bSucc = $sModel->save($aData);
            if ($bSucc) {
                Cache::put('system_type', $this->model->where('id', '>', 0)->get(), 60 * 24 * 7);
                return $this->goBackToIndex('success', __('_system.systemType-create-success'));
            } else {
                return $this->goBack('error', __('_system.systemType-create-error'));
            }
        }
        return $this->render();
    }

    public function edit($id)
    {
        if (!$id) {
            return $this->goBack('error', __('_basic.visit-error'));
        }
        $sModel = $this->model;
        $oSystemType = $sModel::find($id);
        if (!is_object($oSystemType)) {
            return $this->goBack('error', __('_basic.systemType-error'));
        }
        if (Request::isMethod('post')) {

            $aData = trimArray(Input::all());
            $validate = Validator::make($aData, $sModel::$rules);
            if (!$validate->passes()) {
                return $this->goBack('error', __('_basic.validate-error'));
            }
            $bSucc = $sModel->save($aData);
            if ($bSucc) {
                Cache::put('system_type', $this->model->where('id', '>', 0)->get(), 60 * 24 * 7);
                return $this->goBackToIndex('success', __('_system.systemType-edit-success'));
            } else {
                return $this->goBack('error', __('_system.systemType-edit-error'));
            }
        }
        $this->setVars('data', $oSystemType);
        return $this->render();
    }

    public function destroy($ids)
    {
        $bSucc = $this->delete($ids);
        if ($bSucc) {
            Cache::put('system_type', $this->model->where('id', '>', 0)->get(), 60 * 24 * 7);
            return $this->goBack('success', __('_system.systemType-destroy-success'));
        } else {
            return $this->goBack('error', __('_system.systemType-destroy-error'));
        }
    }
}