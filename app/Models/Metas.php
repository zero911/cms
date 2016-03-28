<?php
/**
 * meta模型,目前暂对catetory支持
 * User: ziann
 * Date: 16/3/26
 * Time: 上午12:13
 */

namespace App\Models;


class Metas extends BaseModel
{
    protected $table='yascmf_metas';


    public static $rules=[
        'name'=>'required|between:2,10',
        'description'=>'required|between:2,20',
        'slug'=>'required|alpha_dash|between:2,10',
    ];

    /** [得到所有分类名称]
     * @return array
     */
    public static function getAllCategories(){
        return static::where('type','=','category')->get();
    }

    /**[分类统计+1]
     * @param $id int
     * @param $type string
     */
    public static function setCountById($id,$type){
        $_objct=static::where('type','=',$type)->where('id','=',$id)->first();
        $_objct->count=$_objct->count+1;
        $_objct->save();
        exit;
    }

    /** [组建创建和更新meta数据]
     * @param $oMenta object
     * @param $aInputs array
     * @param string $type string
     * @return mixed  object
     */
    public function compileData($oMenta,$aInputs,$type='category'){

        if($type=='category'){
            $oMenta->slug=e($aInputs['slug']);
            $oMenta->name=e($aInputs['name']);
            $oMenta->description=e($aInputs['description']);
        }
        if(array_key_exists('thumb',$aInputs)){
            $oMenta->thumb=$aInputs['thumb'];
        }
        if(array_key_exists('sort',$aInputs)){
            $oMenta->sort=$aInputs['sort'];
        }
        $oMenta->type=$type;
        return $oMenta;
    }
}