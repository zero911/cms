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

    public static $rules=[
        'title'=>'required|between:1,80',
        'content'=>'required|min:10',
        'is_top'=>'boolean',
        'category_id'=>'numeric'
    ];

    /**
     * 创建或更新内容
     *
     * @param  Douyasi\Models\Content $content
     * @param  array $inputs
     * @param  string $type
     * @param  string|int $user_id
     * @return Douyasi\Models\Content
     */
    public function saveContent($content, $inputs, $type = 'article', $user_id = '0')
    {
        $content->title   = e($inputs['title']);
        $content->content = e($inputs['content']);
        $content->thumb   = e($inputs['thumb']);
        if ($type === 'article') {
            $content->category_id = e($inputs['category_id']);
            $content->type        = 'article';
            $tmp_flag = '';
            /*这里需要对推荐位flag进行处理*/
            if(!empty($inputs['flag']) && is_array($inputs['flag'])) {
                foreach($inputs['flag'] as $flag)
                {
                    if(!empty($flag)){
                        $tmp_flag .= $flag.',';
                    }
                }
                $content->flag = $tmp_flag;
            }
        } elseif ($type === 'page') {
            $content->category_id = 0;
            $content->type        = 'page';
        } elseif ($type === 'fragment') {
            $content->category_id = 0;
            $content->type        = 'fragment';
        }
        if (array_key_exists('is_top', $inputs)) {
            $content->is_top = e($inputs['is_top']);
        }
        if (array_key_exists('outer_link', $inputs)) {
            $content->outer_link = trim(e($inputs['outer_link']));
        }
        if (array_key_exists('slug', $inputs)) {
            $content->slug = e($inputs['slug']) ;
        }
        if ($user_id) {
            $content->user_id = $user_id;
        }
        return $content;
    }

}