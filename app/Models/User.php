<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 16-3-24
 * Time: 下午3:37
 */

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class User extends BaseModel
{
    use SoftDeletes;
    protected $table='users';
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