<?php
/**
 * Created by PhpStorm.
 * User: ziann
 * Date: 16/3/24
 * Time: 上午11:07
 */

namespace App\Models;


use LaravelArdent\Ardent\Ardent;

class BaseModel extends Ardent {
    protected $table='';
    protected $fillable=[];
    protected $model='';


    public function __construct()
    {

    }

}