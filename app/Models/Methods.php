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

    /**[获取所有顶级模块]
     * @return mixed
     */
    public static function getTopMethods()
    {
        return static::where('pid', '=', 0)->where('is_actived', '=', 1)->get();
    }

    /** [获取指定顶级模块的子集模块对象]
     * @param $pid
     * @return mixed
     */
    public function getKids($pid)
    {
        $oKids = static::where('pid', '=', $pid)->get(['id', 'name']);
        return $oKids;
    }

    /** [通过名字获取该模块对象]
     * @param $name
     * @return mixed
     */
    public static function getMethodByName($name)
    {
        return static::where('name', '=', $name)->first();
    }

    public static function getMethods()
    {
        return static::get(['id', 'name']);
    }

    public function permissions()
    {
        return static::belongsToMany('App\Models\Permission', 'yascmf_permission_method' ,
            'method_id' , 'permission_id');
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
        !array_key_exists('url', $aInputs) or $oModel->url = e($aInputs['url']);
        !array_key_exists('method_code', $aInputs) or $oModel->method_code = $aInputs['method_code'];
        return $oModel;
    }

    /** [按照分类得到所有id]
     * @return string
     */
    private function getTrees()
    {
        $tmp = [];
        $result = '';
        $oTops = static::getTopMethods();
        foreach ($oTops as $top) {
            $tmp[$top['id']] = $this->getKids($top['id'])->toArray();
        }
        //归类部分
        foreach ($tmp as $key => $val) {
            $str = $key . ',';
            foreach ($val as $k => $item) {
                $str .= $item['id'] . ',';
            }
            $result .= $str;
        }
        return $result;
    }

    /**  [分类查询出所有模块]
     * @return mixed
     */
    public function treeQuery()
    {
        $sTrees = $this->getTrees();
        return static::whereIn('id', explode(',', $sTrees))->get();
    }
}

