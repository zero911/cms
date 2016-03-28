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

    public static function getUserForName($username){
        return static::where('username','=',$username)->first();
    }

}