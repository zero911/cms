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
use Auth;
use Session;

class AuthorityController extends Controller
{


    public function __construct()
    {
        $this->middleware('guest', ['except' => 'Logout']);
    }

    public function login(Request $request){

        if($request->isMethod('POST')){
//            pr(Input::all());exit;
            $bCaptcha= Config::get('sysConfig.captcha');
            $aData=trimArray(Input::all());
            //调用check
            $aResultData=$this->checkUser($aData);
            if(!$aResultData[0]){
                return redirect()->back()->withInput()->withErrors('error',$aResultData[1]);
            }
            //登陆成功
            return route('admin.home');
        }
        return view('auth.login');
    }

    /**
     * [登出]
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect()->to('auth.login');
    }

    private function checkUser($aData){
        //step1,表单验证
        //使用原生auth构建登录表单验证条件
        $rules=[
            'username'=>'required|alpha_num|between:3,10',
            'password'=>'required|between:5,60'
        ];
        $validate=Validator::make($aData,$rules);
        if($validate->failed()){
            return $this->validateFormat(false,__('_nologon.format-error'));
        }
        $aAttemptData=[
            'username'=>$aData['username'],
            'password'=>$aData['password'],
            'user_type'=>'manager',//管理员用户登陆权限
        ];
        $bSucc=Auth::attempt($aAttemptData,false,true);
        //step2 user检查失败
        if(!$bSucc){
            return $this->validateFormat($bSucc,__('_nologon.info-error'));
        }
        //step3 用户是否锁定,暂时不处理显示出用户名错误.后期需优化
        if(Auth::user()->is_locked){
            return $this->validateFormat(false,__('_nologon.user-locked'));
        }
        //登陆成功
        return $this->validateFormat($bSucc,'');
    }

    /**[为登录校验定义统一的返回数组格式函数]
     * @param $bMsgType boolean
     * @param $sMsgInfo  string
     * @return array
     */
    private function validateFormat($bMsgType,$sMsgInfo=''){

        return [$bMsgType,$sMsgInfo];
    }
}