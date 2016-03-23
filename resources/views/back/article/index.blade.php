@extends('layout.back_base)

@section('content')

    {{--表单提交的提示语--}}

    {{--撰写新文章button--}}
    <a href="http://g.yascmf.cn/admin/article/create" class="btn btn-primary margin-bottom">撰写新文章</a>

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">文章列表</h3>
            <div class="box-tools">
                <form action="http://g.yascmf.cn/admin/article" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm pull-right" name="s_title" value="" style="width: 150px;" placeholder="搜索文章标题">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive">
            <div class="tablebox-controls">
                <!-- Check all button -->
                <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o" title="全选/反全选"></i></button>
                <button class="btn btn-default btn-sm"><i class="fa fa-trash-o" title="删除"></i></button>
                <button class="btn btn-default btn-sm"><i class="fa fa-refresh" title="刷新"></i></button>
            </div>
            <table class="table table-hover table-bordered">
                <tbody>
                <!--tr-th start-->
                <tr>
                    <th>选择</th>
                    <th>操作</th>
                    <th>推荐位</th>
                    <th>标题</th>
                    <th>Slug</th>
                    <th>分类</th>
                    <th>最后修改时间</th>
                </tr>
                <!--tr-th end-->

                <tr>
                    <td class="table-operation"><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="1" name="checkbox[]" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></td>
                    <td>
                        <a href="http://g.yascmf.cn/admin/article/1/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-fw fa-link" title="预览"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-fw fa-minus-circle delete_item" title="删除" data-id="1"></i></a>
                    </td>
                    <td class="text-green"></td>
                    <td class="text-muted">你好，世界！</td>
                    <td class="text-green">
                        1
                    </td>
                    <td class="text-red">默认</td>
                    <td>2015-01-23 15:54:54</td>
                </tr>
                <tr>
                    <td class="table-operation"><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="4" name="checkbox[]" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></td>
                    <td>
                        <a href="http://g.yascmf.cn/admin/article/4/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-fw fa-link" title="预览"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-fw fa-minus-circle delete_item" title="删除" data-id="4"></i></a>
                    </td>
                    <td class="text-green"></td>
                    <td class="text-muted">使用PhantomJS实现网页截图</td>
                    <td class="text-green">
                        4
                    </td>
                    <td class="text-red">Javascript</td>
                    <td>2015-02-10 13:52:47</td>
                </tr>
                <tr>
                    <td class="table-operation"><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="5" name="checkbox[]" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></td>
                    <td>
                        <a href="http://g.yascmf.cn/admin/article/5/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-fw fa-link" title="预览"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-fw fa-minus-circle delete_item" title="删除" data-id="5"></i></a>
                    </td>
                    <td class="text-green"></td>
                    <td class="text-muted">Laravel 4开发人员必用扩展包</td>
                    <td class="text-green">
                        5
                    </td>
                    <td class="text-red">Laravel</td>
                    <td>2015-03-11 23:46:53</td>
                </tr>
                <tr>
                    <td class="table-operation"><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="6" name="checkbox[]" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></td>
                    <td>
                        <a href="http://g.yascmf.cn/admin/article/6/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-fw fa-link" title="预览"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-fw fa-minus-circle delete_item" title="删除" data-id="6"></i></a>
                    </td>
                    <td class="text-green"></td>
                    <td class="text-muted">芽丝博客视图文件目录结构</td>
                    <td class="text-green">
                        6
                    </td>
                    <td class="text-red">文档</td>
                    <td>2015-03-11 23:45:39</td>
                </tr>
                <tr>
                    <td class="table-operation"><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="7" name="checkbox[]" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></td>
                    <td>
                        <a href="http://g.yascmf.cn/admin/article/7/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-fw fa-link" title="预览"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-fw fa-minus-circle delete_item" title="删除" data-id="7"></i></a>
                    </td>
                    <td class="text-green"></td>
                    <td class="text-muted">芽丝内容管理框架简介</td>
                    <td class="text-green">
                        7
                    </td>
                    <td class="text-red">软件</td>
                    <td>2015-03-12 00:06:16</td>
                </tr>
                <tr>
                    <td class="table-operation"><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="8" name="checkbox[]" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></td>
                    <td>
                        <a href="http://g.yascmf.cn/admin/article/8/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-fw fa-link" title="预览"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-fw fa-minus-circle delete_item" title="删除" data-id="8"></i></a>
                    </td>
                    <td class="text-green"></td>
                    <td class="text-muted">Laravel 5 中文文档</td>
                    <td class="text-green">
                        8
                    </td>
                    <td class="text-red">Laravel</td>
                    <td>2015-03-11 23:37:10</td>
                </tr>
                <tr>
                    <td class="table-operation"><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="9" name="checkbox[]" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></td>
                    <td>
                        <a href="http://g.yascmf.cn/admin/article/9/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-fw fa-link" title="预览"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-fw fa-minus-circle delete_item" title="删除" data-id="9"></i></a>
                    </td>
                    <td class="text-green"></td>
                    <td class="text-muted">Javascript获取当前URL相关参数</td>
                    <td class="text-green">
                        9
                    </td>
                    <td class="text-red">默认</td>
                    <td>2015-03-11 23:03:06</td>
                </tr>
                <tr>
                    <td class="table-operation"><div class="icheckbox_flat-blue" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" value="10" name="checkbox[]" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div></td>
                    <td>
                        <a href="http://g.yascmf.cn/admin/article/10/edit"><i class="fa fa-fw fa-pencil" title="修改"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-fw fa-link" title="预览"></i></a>
                        <a href="javascript:void(0);"><i class="fa fa-fw fa-minus-circle delete_item" title="删除" data-id="10"></i></a>
                    </td>
                    <td class="text-green"></td>
                    <td class="text-muted">芽丝博客上线</td>
                    <td class="text-green">
                        10
                    </td>
                    <td class="text-red">默认</td>
                    <td>2015-03-11 23:40:35</td>
                </tr>

                </tbody>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">

        </div>

        <!--隐藏型删除表单-->

        <form method="post" action="http://g.yascmf.cn/admin/article" accept-charset="utf-8" id="hidden-delete-form">
            <input name="_method" type="hidden" value="delete">
            <input type="hidden" name="_token" value="AxWu5ajXsIDj5wqTJhev9EvI0fFGCBBswAQfwG5c">
        </form>

    </div>
@stop


@stop