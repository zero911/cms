<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 16-3-31
 * Time: 下午3:54
 */

namespace App\Models;


class Methods extends BaseModel
{
    protected $table = 'yascmf_method';
    protected $fillable = [
        'method_code',
        'name',
        'url',
        'is_actived',
    ];

    public static $rules = [
        'name' => 'required|between:2,15',
        'pid' => 'required|numeric',
        'is_actived' => 'boolean',
        'method_code' => 'alpha_dash',
    ];

    public static function getTopMethods()
    {
        return static::where('pid', '=', 0)->where('is_actived', '=', 1)->get();
    }

    public static function getKids($pid)
    {
        $aKids = [];
        $sId = '';
        $oKids = static::where('pid', '=', $pid)->get(['id', 'name'])->toArray();
        foreach ($oKids as $key => $kid) {
            if ($key == count($oKids) - 1) {
                $sId .= $kid['id'];
            }else{
                $sId .= $kid['id'] . ',';
            }
        }
        $aKids[$pid]['id'] = $sId;
        return $aKids;
    }

    public static function getMethodByName($name)
    {
        return static::where('name', '=', $name)->first();
    }

    public static function getMethods()
    {
        return static::get(['id', 'name']);
    }

    /** [保存和更新数据组建]
     * @param $oModel object
     * @param $aInputs array
     * @param bool $is_create boolean true:create
     * @return array
     */
    public function saveContent($oModel, $aInputs, $is_create = true)
    {
        if ($is_create && static::getMethodByName($aInputs['name'])) {
            return null;
        }
        $oModel->name = e($aInputs['name']);
        $oModel->pid = e($aInputs['pid']);
        $oModel->is_actived = e($aInputs['is_actived']);
        if (array_key_exists('url', $aInputs)) {
            $oModel->url = e($aInputs['url']);
        }
        if (array_key_exists('method_code', $aInputs)) {
            $oModel->method_code = $aInputs['method_code'];
        }
        return $oModel;
    }

    public static function getTrees()
    {
        $tmp = [];
        $aResult=[];
        $oTops = static::getTopMethods();
        foreach ($oTops as $top) {
            $tmp[]=static::getKids($top['id']);
        }
        foreach($tmp as $key=>$val){
            foreach($val as $k=>$item){
                $aResult[$k]=$item;
            }
        }
        return $aResult;
    }
}