<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 16-3-23
 * Time: 下午3:44
 */

namespace App\Http\Controllers;

use Request;
use Route;

class AdminBaseController extends Controller
{

    protected $modelName;
    protected $model;
    protected static $pageSize = 20;//默认pageSize;
    protected $resourceTable = '';
    protected $request;
    protected $action;//当前action
    protected $bExtraSearch = false;//页面是否支持符合查询
    protected $viewVars = [];// 分配到页面的数据数组
    protected $controller;
    protected $resourceName = '';

    //自定义模板部分
    protected $customView = [];//被允许的模板数组
    protected $customPath = '';//模板文件路径
    protected $view = '';//最终整个模板的全路径  path.view

    /**
     * 构造器
     * BaseController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {

        $this->request = $request;
        $this->initCA() or abort(404);
        $this->initModel();
    }

    /**初始化controller和action
     * @return bool
     */
    public function initCA()
    {
        if (!$ca = Route::currentRouteAction()) {
            return false;
        }
        $aCAs = explode('@', $ca);
        $iPos = strripos($aCAs[0], '\\') - strlen($aCAs[0]) + 1;
        $sController = substr($aCAs[0], $iPos);
        list($this->controller, $this->action) = [$sController, $aCAs[1]];
        return true;
    }

    /**
     *  初始化模型
     */
    protected function initModel()
    {
        if ($sModelName = $this->modelName) {
            //modelName存在则实例化model
            $this->model = app()->make($sModelName);
        }
    }

    /**
     * 封装给模板传值函数
     * @param $sKey
     * @param null $mValue
     */
    public function setVars($sKey, $mValue = null)
    {
        if (is_array($sKey)) {
            foreach ($sKey as $key => $value) {
                $this->setVars($key, $value);
            }
        } else {
            $this->viewVars["$sKey"] = $mValue;
        }
    }

    /**[回退到列表页面]
     * @param $sMsgType string error|success
     * @param  $sMessage string 消息内容
     * @return \Illuminate\Http\RedirectResponse
     */
    public function goBackToIndex($sMsgType, $sMessage)
    {
        //暂时写死index文件，后续需要改进
        $sToUrl = route($this->customPath . '.' . 'index');
        return redirect()->to($sToUrl)->with($sMsgType, $sMessage);
    }

    /** 定义表单提交后返回的结果
     * @param $sMsgType string error|success
     * @param $sMessage string 消息内容
     * @return \Illuminate\Http\RedirectResponse
     */
    public function goBack($sMsgType, $sMessage)
    {
        return redirect()->back()->withInput()->with($sMsgType, $sMessage);
    }

    /**
     * 定义页面跳转的需要额外传送的数据函数
     */
    public function beforeRender()
    {

    }

    /**
     * 封装页面跳转方法
     * @return mixed
     */
    public function render()
    {
        $this->beforeRender();
        if (!$this->view) {
            if (in_array($this->action, $this->customView) && $this->customPath) {
                $this->view = $this->customPath . '.' . $this->action;
            }
        }
//        pr($this->viewVars);exit;
        return view($this->view)->with($this->viewVars);
    }

    /**首页方法
     * @return mixed
     */
    public function index()
    {
        if (is_null($this->request) || is_null($this->request->input()) || count($this->request->input()) < 2) {
//            pr($this->model);exit;
            $oQuery = $this->model->where('id', '>', 0);
        } else {
            $aData = trimArray($this->request->except('_token'));
//            组装数组格式
            $aData = $this->makeSearchCondition($aData);
            $oQuery = $this->indexQuery($aData);
        }
        //分页部分
        $pageSize = $this->request->input('pageSize');
        $pageSize = isset($pageSize) && is_numeric($pageSize) ? $pageSize : static::$pageSize;
        $datas = $oQuery->paginate($pageSize);
        $this->setVars('datas', $datas);
//        pr($datas);exit;
        return $this->render();
    }

    /** [根据主键删除模型,支持单个,多个字符串或数组传入删除]
     * @param $ids
     * @return mixed
     */
    public function delete($ids){
        $sModel=$this->model;
        return $sModel::destroy($ids);
    }

    /**页面搜索条件同一处理方法
     * @param $aData
     * @return mixed
     */
    public function indexQuery($aData)
    {
        $this->bExtraSearch && is_array($aData) ? $oQuery = $this->model->doWhere($aData) : $oQuery = $this->model;
        $aOrderSet = [];//获取排序条件
        if ($sOderColumn = $this->request->input('sort_up', $this->request->input('sort_down'))) {
            //  如果sort_up不存在则取sort_down字段
            $sSortType = $this->request->input('sort_up') ? 'asc' : 'desc';
            $aOrderSet[$sOderColumn] = $sSortType;
        }
        $oQuery = $this->model->doOrderBy($oQuery, $aOrderSet);
        return $oQuery;
    }

    /**[组装查询字段的数组]
     * @param $aData array 查询的字段数组
     * @return array 改装后的数组
     */
    private function makeSearchCondition($aData)
    {
        $aConditionData = [];
        foreach ($aData as $key => $data) {
            if ($data != '') {//过滤空字段

                if ($key == 'created_from' || $key == 'updated_from') {
                    $aConditionData[$key] = ['>=', strtotime($data)];
                } elseif ($key == 'created_to' || $key == 'updated_to') {
                    $aConditionData[$key] = ['<=', strtotime($data)];
                } else {
                    $aConditionData[$key] = ['=', $data];
                }
            }
        }
        return $aConditionData;
    }
}