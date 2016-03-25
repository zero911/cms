<?php
/**
 * Created by PhpStorm.
 * User: ziann
 * Date: 16/3/25
 * Time: 下午11:51
 */

namespace App\Models;


class Articles extends BaseModel
{
    protected $table = 'yascmf_contents';
    protected $fillable = [
        'flag',
        'title',
        'category_id',
        'slug',
        'updated_at'
    ];

    //定义文章分类名称常量
    const CATEGORY_DEFAULT = 1;
    const CATEGORY_SOFTWARE = 2;
    const CATEGORY_DOCUMENT = 3;
    const CATEGORY_LARAVEl = 4;
    const CATEGORY_JS = 5;
    const CATEGORY_TEST = 6;

    public static $getCategory = [
        self::CATEGORY_DEFAULT => 'default', self::CATEGORY_SOFTWARE => 'software',
        self::CATEGORY_DOCUMENT => 'document', self::CATEGORY_LARAVEl => 'laravel',
        self::CATEGORY_JS => 'js', self::CATEGORY_TEST => 'test',
    ];
}