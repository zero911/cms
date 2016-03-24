<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 16-3-23
 * Time: 下午1:32
 */

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Input;
use Config;
use Lang;
use Strting;

class AuthorityController extends Controller
{


    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function login(Request $request){

        if($request->isMethod('POST')){
//            pr(Input::all());exit;
            $bCaptcha= Config::get('sysConfig.captcha');
            $aData=trimArray(Input::all());
            //调用check
            $aResultData=$this->checkUser($aData);
        }
        return view('auth.login');
    }


    private function checkUser($aData){
        //step1,表单验证
        //使用原生auth构建登录表单验证条件
        $rules=[
            'username'=>'required|alpha_num|between:3,10',
            'password'=>'required|between:6,60'
        ];
        $validate=Validator::make($aData,$rules);
        if($validate->failed){
            return $this->validateFormat(false,__('_nologon.format-error'));
        }
        //step2 检查改用是否存在
        $oUser=User::getUserForName($aData['username']);
        if(!is_object($oUser)){
            return $this->validateFormat(false,__('_nologon.info-error'));
        }
        //用户是否锁定
        if($oUser->is_lock){
            return $this->validateFormat(false,__)
        }

    }

    /**[为登录校验定义统一的返回数组格式函数]
     * @param $bMsgType boolean
     * @param $sMsgInfo  string
     * @param $oData  object
     * @return array
     */
    private function validateFormat($bMsgType,$sMsgInfo,$oData=null){

        return [$bMsgType,$sMsgInfo,$oData];
    }
}