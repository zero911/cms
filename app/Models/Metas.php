<?php
/**
 * Created by PhpStorm.
 * User: ziann
 * Date: 16/3/26
 * Time: 上午12:13
 */

namespace App\Models;


class Metas extends BaseModel
{
    protected $table='yascmf_metas';

    /** [通过id得到name]
     * @param $iId
     * @return string
     */
    public static function getMetaNameById($iId){
        $sName='';
        $oMeta=static::where('id','=',$iId)->first();
        $sName=$oMeta->name;
        return $sName;
    }
}