<?php
/**
 * Created by PhpStorm.
 * User: ziann
 * Date: 16/3/26
 * Time: 上午12:17
 */

namespace App\Http\Controllers;


use App\Models\Articles;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Metas;
use Illuminate\Support\Facades\Validator;
use Request;
use Input;
use App\Models\Flags;

class PageController extends AdminBaseController
{
    use SoftDeletes;
    protected $modelName = 'App\Models\Articles';
    protected $customPath = 'back.page';
    protected $customView = ['index', 'create', 'edit', 'view'];
    protected $dates = ['deleted_at'];
    protected $bCustomCondition = true;
    protected $aCustomConditionArray = ['type' => ['=', 'page']];
    protected $routeName='page';

    public function beforeRender()
    {
        parent::beforeRender(); // TODO: Change the autogenerated stub
        $sModel = $this->model;
        $oFlags = Flags::getFlags();
        $this->setVars('flags', $oFlags);
        $categories = Metas::getAllCategories();
        $this->setVars('categories', $categories);
        $this->setVars('_title', __('_basic.articles'));
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
        $oArticle = $sModel::find($id);
        if (!is_object($oArticle)) {
            return $this->goBack('error', __('_basic.page-error'));
        }
        if (Request::isMethod('post')) {
//            pr(Input::all());exit;
            $aData = trimArray(Input::all());
            //表单验证
            $validate = Validator::make($aData, $sModel::$rules);
            if (!$validate->passes()) {
                return $this->goBack('error', '请确保格式正确');
            }
            $oContent = $sModel->saveContent($oArticle, $aData, $type = 'page');
            $bSucc=$oContent->save();
            return $bSucc ? $this->goBackToIndex('success', __('_articles.page-edit-success')) :
                $this->goBack('error', __('_articles.page-edit-error'));
        }
        $this->setVars('oArticle', $oArticle);
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
        $oArticle = $sModel::find($id);
        if (!is_object($oArticle)) {
            return $this->goBack('error', __('_basic.page-error'));
        }
//        pr($oArticle);exit;
        $this->setVars('oArticle', $oArticle);
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
                return $this->goBack('error','请确保输入格式正确');
            }
            $oContent=$sModel->saveContent(new Articles() ,$aData,$type='page');
            $bSucc=$oContent->save();
            return $bSucc ? $this->goBackToIndex('success', __('_articles.page-create-success')) :
                $this->goBack('error', __('_articles.page-create-error'));
        }
        return $this->render();
    }

    /** [删除]
     * @param null $ids
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($ids){
        $bSucc=$this->delete($ids);
        return $bSucc ? $this->goBackToIndex('success', __('_articles.page-destroy-success')) :
            $this->goBack('error', __('_articles.page-destroy-error'));
    }
}