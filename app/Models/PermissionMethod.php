<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 16-3-31
 * Time: 下午4:02
 */

namespace App\Models;


class PermissionMethod extends BaseModel
{
    protected $table = 'yascmf_permission_method';
    public $timestamps = false;

    public static function getPermissionMethodByIds($aIds)
    {
        $obj = static::whereIn('id', $aIds)->get()->toArray();
        $aResult = [];
        foreach ($obj as $key => $ob) {
            $tmp = $obj[$key]['permission_id'];
            if ($key < count($obj) && $obj[$key]['method_id'] == $obj[$key + 1]['method_id']) {
                $tmp .= ','.$obj[$key + 1]['permission_id'];
            } else {
                $aResult[][$obj[$key]['method_id']] = $tmp;
            }

        }
        return $aResult;
    }
}