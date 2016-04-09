<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 16-3-23
 * Time: 下午1:32
 */

namespace App\Http\Controllers;

use App\Models\SystemLogger;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SoapBox\Formatter\Formatter;
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
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login(Request $request)
    {

        if ($request->isMethod('POST')) {
//            pr(Input::all());exit;
            $bCaptcha = Config::get('sysConfig.captcha');
            $aData = trimArray(Input::all());
            //调用check
            $aResultData = $this->checkUser($aData);
            if (!$aResultData[0]) {
                return redirect()->back()->withInput()->withErrors('error', $aResultData[1]);
            }
            //登陆成功
            SystemLogger::writeLog(Session::get('admin_user_id'),$request->url(),$request->getClientIp(),'AuthorityController@login','登陆系统');
            return route('admin.home');
        }
        return view('auth.login');
    }

    /**
     * [登出]
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function logout(Request $request)
    {
        $user_id=Auth::user()->id;
        Auth::logout();
        Session::flush();
        SystemLogger::writeLog($user_id,$request->url(),$request->getClientIp(),'AuthorityController@logout','登出系统');
        return redirect()->to('auth/login');
    }

    private function checkUser($aData)
    {
        //step1,表单验证
        //使用原生auth构建登录表单验证条件
        $rules = [
            'username' => 'required|alpha_num|between:3,10',
            'password' => 'required|between:5,60'
        ];
        $validate = Validator::make($aData, $rules);
        if ($validate->failed()) {
            return $this->validateFormat(false, __('_nologon.format-error'));
        }
        $aAttemptData = [
            'username' => $aData['username'],
            'password' => $aData['password'],
            'user_type' => 'manager',//管理员用户登陆权限
        ];
        $bSucc = Auth::attempt($aAttemptData, false, true);
        //step2 user检查失败
        if (!$bSucc) {
            return $this->validateFormat($bSucc, __('_nologon.info-error'));
        }
        //step3 用户是否锁定,暂时不处理显示出用户名错误.后期需优化
        if (Auth::user()->is_locked) {
            return $this->validateFormat(false, __('_nologon.user-locked'));
        }

        //写入session
        Session::put('admin_user_id',Auth::user()->id);
        Session::put('admin_username',Auth::user()->username);
        Session::put('admin_realname',Auth::user()->realname);
        Session::put('admin_user_type',Auth::user()->user_type);
        Session::put('admin_nickname',Auth::user()->nickname);

        //登陆成功
        return $this->validateFormat($bSucc, '');
    }

    /**[为登录校验定义统一的返回数组格式函数]
     * @param $bMsgType boolean
     * @param $sMsgInfo  string
     * @return array
     */
    private function validateFormat($bMsgType, $sMsgInfo = '')
    {

        return [$bMsgType, $sMsgInfo];
    }

    //测试curl
    public function testVisitCurl(){

        #post request

 /*       $url='m.y.cn/auth/testCurl';

        $tmp_time = microtime(true);

        $userAgent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1); /// 链接timeout 1秒
        curl_setopt($ch, CURLOPT_TIMEOUT, 3); /// 执行timeout 3秒
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($ch, CURLOPT_REFERER, $url);

        // 允许重定向
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        // 支持HTTPS(SSL)
        if (preg_match('/^https/', $url)) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        // 是否启用POST提交
        if (!empty($postData)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        }

        $ret = curl_exec($ch);

        pr($ret);exit;*/


        #GET request

        $visit='m.y.cn/auth/testCurl?username=zero&data=sg';

        // 初始化一个 cURL 对象
        $ch = curl_init();
        // 设置你需要抓取的URL
        curl_setopt($ch,CURLOPT_URL,$visit);
        // 设置header
        curl_setopt($ch, CURLOPT_HEADER, 1);
        // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        // 运行cURL，请求网页
        $output=curl_exec($ch);

        if(curl_errno($ch)){
            pr(curl_error($ch));
        }
        // 关闭URL请求
        curl_close($ch);
        pr($output);exit;

        $xmlOutput=Formatter::make($output,Formatter::XML);
        $result=$xmlOutput->toArray();

    }
}