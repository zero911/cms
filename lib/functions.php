<?php
/**
 * Created by PhpStorm.
 * User: zero
 * Date: 16-3-22
 * Time: 下午7:09
 */



/**
 * 样式别名加载（支持批量加载）
 * @param  string|array $aliases    配置文件中的别名
 * @param  array        $attributes 标签中需要加入的其它参数的数组
 * @return string
 */
function style($aliases, $attributes = array(), $interim = '')
{
    if (is_array($aliases)) {
        foreach ($aliases as $key => $value) {
            $interim .= (is_int($key)) ? style($value, $attributes, $interim) : style($key, $value, $interim);
        }
        return $interim;
    }
    $cssAliases = app('config')->get('extend.webAssets.cssAliases');
    $url        = isset($cssAliases[$aliases]) ? $cssAliases[$aliases] : $aliases;
//    pr(app('html')->style($url,$attributes));exit;
    return app('html')->style($url, $attributes);
}

/**
 * 脚本别名加载（支持批量加载）
 * @param  string|array $aliases    配置文件中的别名
 * @param  array        $attributes 标签中需要加入的其它参数的数组
 * @return string
 */
function script($aliases, $attributes = array(), $interim = '')
{
    if (is_array($aliases)) {
        foreach ($aliases as $key => $value) {
            $interim .= (is_int($key)) ? script($value, $attributes, $interim) : script($key, $value, $interim);
        }
        return $interim;
    }
    $jsAliases = app('config')->get('extend.webAssets.jsAliases');
    $url       = isset($jsAliases[$aliases]) ? $jsAliases[$aliases] : $aliases;
    return app('html')->script($url, $attributes);
}

/**
 * [格式话输出函数,用于调试]
 * @param $val object/array/basic type
 */
function pr($val){
    $bCli = php_sapi_name() == 'cli';
    $prefix = $bCli ? "\n" : '<pre>';
    $suffix = $bCli ? "\n" : '</pre>';
    if (app('config')->get('app.debug')){
        echo $prefix;
        print_r($val);
        echo $suffix;
    }
}

function trimArray($arrayData){
    $result=[];
    foreach($arrayData as $key => $data){
        if(is_array($data)){
            $result[$key]=trimArray($data);
        }else{
            $result[$key]=trim($data);
        }
    }
    return $result;
}
