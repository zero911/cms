<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 16-3-24
 * Time: 下午3:37
 */

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
//use Zizaco\Entrust\Traits\EntrustUserTrait;

use Illuminate\Database\Eloquent\SoftDeletes;

class User extends BaseModel implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
//    use EntrustUserTrait;
    use SoftDeletes;
    protected $table='yascmf_users';
    protected $dates=['deleted_at'];
    protected $fillable=[
        'id',
        'username',
        'nickname',
        'email',
        'realname',
    ];

    public static $rules=[
        'username'=>'required|alpha|between:5,10',
        'password'=>'required|confirmed|alpha_dash|between:6,16',
        'email'=>'required|email',
        'realname'=>'required|between:2,4',
        'phone'=>'',
    ];

    public static function getUserForName($username){
        return static::where('username','=',$username)->first();
    }

    public static function getUserForType($type){
        return static::where('user_type','=',$type)->where('is_lock','=',0)->get();
    }

    public function compileContent($oModel,$aInputs,$user_type='manager'){
        if($user_type==='manager'){
            $oModel->username=$aInputs['username'];
            $oModel->password=bcrypt($aInputs['password']);
            $oModel->email=$aInputs['email'];
            $oModel->realname=$aInputs['realname'];
        }elseif($user_type==='visitor'){

        }else{

        }
        if(array_key_exists('phone',$aInputs)){
            $oModel->phone=$aInputs['phone'];
        }
        if(array_key_exists('address',$aInputs)){
            $oModel->address=$aInputs['address'];
        }

        return $oModel;
    }
}