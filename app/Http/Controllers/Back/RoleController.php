<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 16-3-30
 * Time: 下午4:24
 */

namespace App\Http\Controllers;

use App\Models\Permission;
use Auth;
use Request;
use Input;


class RoleController extends AdminBaseController
{
    protected $modelName='App\Models\Role';
    protected $customPath='back.role';
    protected $customView=[
        'index','edit','create',
    ];
    protected $routeName='roles';

    public function beforeRender(){
        parent::beforeRender();
        $this->setVars('oUser',Auth::user());
        $this->setVars('permissions',Permission::all());
    }
//    public function

    public function edit($id)
    {
        if (!$id) {
            return $this->goBack('error', __('_basic.visit-error'));
        }
        $sModel = $this->model;
        $oRole = $sModel::find($id);
        if (!is_object($oRole)) {
            return $this->goBack('error', __('_basic.role-error'));
        }
        if (Request::isMethod('post')) {
//            pr(Input::all());exit;
            $aData = trimArray(Input::all());
            //表单验证
            $validate = Validator::make($aData, $sModel::$rules);
            if (!$validate->passes()) {
                return $this->goBack('error', __('_basic.role-error'));
            }
            $oContent = $sModel->compileContent($oRole ,$aData);
            $bSucc=$oContent->save();
            if($bSucc){
                //管理员用户创建角色
//                $oContent->permissions()->attach($aData['role']);
                return $this->goBackToIndex('success', __('_user.role-edit-success'));
            }else{
                return $this->goBack('error', __('_user.role-edit-error'));
            }
        }
/*        pr($oRole->permissions->toArray());exit;
        $this->setVars('role', $oRole);*/
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
            return $this->goBack('error', __('_basic.role-error'));
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
                $oManager->permissions()->attach($aData['role']);
                return $this->goBackToIndex('success', __('_user.role-create-success'));
            }else{
                return $this->goBack('error', __('_user.role-create-error'));
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
        return $bSucc ? $this->goBackToIndex('success', __('_user.role-destroy-success')) :
            $this->goBack('error', __('_user.role-destroy-error'));
    }
}