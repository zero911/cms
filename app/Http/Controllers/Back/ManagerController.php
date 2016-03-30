<?php
/**
 * Created by PhpStorm.
 * User: ziann
 * Date: 16/3/26
 * Time: 上午12:17
 */

namespace App\Http\Controllers;


use App\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Illuminate\Support\Facades\Validator;
use Request;
use Input;
use App\Models\User;

class ManagerController extends AdminBaseController
{
    use SoftDeletes;
    protected $modelName = 'App\Models\User';
    protected $customPath = 'back.manager';
    protected $customView = ['index', 'create', 'edit', 'view'];
    protected $dates = ['deleted_at'];
    protected $bCustomCondition = true;
    protected $aCustomConditionArray = ['user_type' => ['=', 'manager']];
    protected $routeName='manager';

    public function beforeRender()
    {
        parent::beforeRender(); // TODO: Change the autogenerated stub
        $sModel = $this->model;
        $oRole= Role::all();
        $this->setVars('roles',$oRole);
        $this->setVars('oUser', Auth::user());
        $this->setVars('_title', __('_basic.manager'));
    }

    /**[编辑]
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function edit($id)
    {
        if (!$id) {
            return $this->goBack('error', __('_basic.visit-error'));
        }
        $sModel = $this->model;
        $oManager = $sModel::find($id);
        if (!is_object($oManager)) {
            return $this->goBack('error', __('_basic.manager-error'));
        }
        if (Request::isMethod('post')) {
//            pr(Input::all());exit;
            $aData = trimArray(Input::all());
            //表单验证
            $validate = Validator::make($aData, $sModel::$rules);
            if (!$validate->passes()) {
                return $this->goBack('error', __('_basic.manager-error'));
            }
            $oContent = $sModel->compileContent($oManager ,$aData,$user_type='manager',false);
            $bSucc=$oContent->save();
            if($bSucc){
                //管理员用户创建角色
                $oContent->roles()->attach($aData['role']);
                return $this->goBackToIndex('success', __('_user.manager-edit-success'));
            }else{
                return $this->goBack('error', __('_user.manager-edit-error'));
            }
        }
//        pr($oManager->roles->first()->id);exit;
        $this->setVars('user', $oManager);
        return $this->render();
    }

    /** [浏览某个文章详情]
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function view($id)
    {
        if (!$id) {
            return $this->goBack('error', __('_basic.visit-error'));
        }
        $sModel = $this->model;
        $oManager = $sModel::find($id);
        if (!is_object($oManager)) {
            return $this->goBack('error', __('_basic.manager-error'));
        }
//        pr($oArticle);exit;
        $this->setVars('users', $oManager);
        return $this->render();
    }

    /**[创建]
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function create(){

        if(Request::isMethod('post')){
            $aData=trimArray(Input::all());
            $sModel=$this->model;
            $validate=Validator::make($aData,$sModel::$rules);
            if(!$validate->passes()){
                return $this->goBack('error',__('_basic.validate-error'));
            }
            $oManager=$sModel->compileContent(new User() ,$aData,$user_type='manager');
//            pr($oManager);exit;
            if($bSucc=$oManager->save()){
                //管理员用户创建角色
                $oManager->roles()->attach($aData['role']);
                return $this->goBackToIndex('success', __('_user.manager-create-success'));
            }else{
                return $this->goBack('error', __('_user.manager-create-error'));
            }
        }
        return $this->render();
    }

    /** [删除]
     * @param null $ids
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($ids){
        $bSucc=$this->delete($ids);
        return $bSucc ? $this->goBackToIndex('success', __('_user.manager-destroy-success')) :
            $this->goBack('error', __('_user.manager-destroy-error'));
    }
}