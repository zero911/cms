<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 16-3-24
 * Time: 下午3:37
 */

namespace App\Models;

use Carbon\Carbon;
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
    protected $table = 'yascmf_users';
//    public $timestamps=false;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'id',
        'username',
        'nickname',
        'email',
        'realname',
        'password',
        'address',
        'phone',
        'is_lock',
        'user_type',
    ];

    public static $rules = [
        'username' => 'required|alpha_num|between:5,10',
        'password' => 'required|confirmed|alpha_dash|between:6,16',
        'email' => 'required|email',
        'realname' => 'required|between:2,4',
        'phone' => 'numeric',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'yascmf_role_user', 'user_id', 'role_id');
    }

    public static function getRoles($id){
        $aMyRoles=[];
        $aRoles=static::find($id)->roles->toArray();
        foreach($aRoles as $role){
            if(is_array($role['pivot']) && $role['pivot']){
                $aMyRoles[]=$role['pivot']['role_id'];
            }
        }
        return $aMyRoles;
    }

    public static function getUserForName($username)
    {
        return static::where('username', '=', $username)->first();
    }

    public static function getUserForType($type)
    {
        return static::where('user_type', '=', $type)->where('is_lock', '=', 0)->get();
    }

    /** [更新和创建用户组建函数,目前暂未对会员账户处理]
     * @param $oModel  object
     * @param $aInputs array
     * @param string $user_type string   类型分为manager|visitor|customer
     * @param $is_created boolean  决定是创建还是修改user
     * @return mixed object
     */
    public function compileContent($oModel, $aInputs, $user_type = 'manager', $is_created = true)
    {

        $oUser = $this->getUserForName($aInputs['username']);
        if (is_object($oUser) && $is_created) {
            return null;
        }

        if ($user_type === 'manager') {
            $oModel->username = $aInputs['username'];
            $oModel->realname = $aInputs['realname'];
        } elseif ($user_type === 'visitor') {

        } else {

        }
        if (array_key_exists('phone', $aInputs)) {
            $oModel->phone = $aInputs['phone'];
        }
        if (array_key_exists('address', $aInputs)) {
            $oModel->address = $aInputs['address'];
        }
        if (array_key_exists('is_lock', $aInputs)) {
            $oModel->is_lock = $aInputs['is_lock'];
        }
        if (array_key_exists('nickname', $aInputs)) {
            $oModel->nickname = $aInputs['nickname'];
        }
        if (array_key_exists('password', $aInputs)) {
            $oModel->password = bcrypt($aInputs['password']);
        }
        if (array_key_exists('email', $aInputs)) {
            $oModel->email = $aInputs['email'];
        }
        $oModel->user_type=$user_type;
        return $oModel;
    }
}