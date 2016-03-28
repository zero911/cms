<?php
/**
 * meta控制器,目前暂对catetory支持
 * User: ziann
 * Date: 16/3/27
 * Time: 下午1:25
 */

namespace App\Http\Controllers;


use App\Http\Controllers\AdminBaseController;
use Illuminate\Support\Facades\Validator;
use Request;
use Input;
use Auth;

class MetasController extends AdminBaseController
{

    protected $modelName = 'App\Models\Metas';
    protected $customPath = 'back.meta';
    protected $customView = ['index', 'create', 'edit', 'view'];
    protected $bCustomCondition = true;
    protected $aCustomConditionArray = ['type' => ['=', 'category']];
    protected $routeName='category';

    public function beforeRender()
    {
        parent::beforeRender(); // TODO: Change the autogenerated stub
        $sModel = $this->model;
        $this->setVars('oUser', Auth::user());
        $this->setVars('_title', __('_basic.category'));
    }

    public function create(){
        if(Request::isMethod('post')){
            $sModel=$this->model;
            $aData=trimArray(Input::all());
            $validate=Validator::make($aData,$sModel::$rules);
            if(!$validate->passes()){
                return $this->goBack('error',__('_basic.validate-error'));
            }
            $oMeta=$sModel->compileData($sModel,$aData);
            if($bSucc=$oMeta->save()){
                return $this->goBackToIndex('success',__('_articles.category-create-success'));
            }else{
                return $this->goBackToIndex('error',__('_articles.category-create-error'));
            }
        }
        return $this->render();
    }

    public function edit($id){
        if (!$id) {
            return $this->goBack('error', __('_basic.visit-error'));
        }
        $sModel = $this->model;
        $oMeta = $sModel::find($id);
        if (!is_object($oMeta)) {
            return $this->goBack('error', __('_basic.category-error'));
        }
        if(Request::isMethod('post')){
            $aData=trimArray(Input::all());
            $validate=Validator::make($aData,$sModel::$rules);
            if(!$validate->passes()){
                return $this->goBack('error',__('_basic.validate-error'));
            }
            $_oMeta=$sModel->compileData($oMeta,$aData);
            if($bSucc=$_oMeta->save()){
                return $this->goBackToIndex('success',__('_articles.category-edit-success'));
            }else{
                return $this->goBackToIndex('error',__('_articles.category-edit-error'));
            }
        }
        $this->setVars('category',$oMeta);
        return $this->render();
    }

    public function view($id){
        if (!$id) {
            return $this->goBack('error', __('_basic.visit-error'));
        }
        $sModel = $this->model;
        $oMeta = $sModel::find($id);
        if (!is_object($oMeta)) {
            return $this->goBack('error', __('_basic.category-error'));
        }
        $this->setVars('oMeta',$oMeta);
        return $this->render();
    }

    public function destroy($ids){
        $bSucc=$this->delete($ids);
        return $bSucc ? $this->goBackToIndex('success', __('_articles.category-destroy-success')) :
            $this->goBack('error', __('_articles.category-destroy-error'));
    }
}