@extends('layout.back_base')
@section('title') Zero|CMS - {{__('_basic.permission-index')}} @stop

@section('content')

    @include('widgets.content-msgInfo')

    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">权限列表</h3>
            <div class="box-tips clearfix">
                <p><b>权限影响系统安全与稳定，错误或不合理的修改可能会影响系统业务与逻辑，故在此屏蔽掉权限 增、删、改 功能。</b><br/>开发者可通过阅读 Laravel <a
                            href="https://github.com/Zizaco/entrust/tree/laravel-5">Entrust</a>
                    文档，结合本内容管理框架实际，来完成相关（二次）开发任务。</p>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body table-responsive">
            <table class="table table-hover table-bordered">
                <tbody>
                <!--tr-th start-->
                <tr>
                    <th>操作</th>
                    <th>编号</th>
                    <th>权限标识串</th>
                    <th>权限展示名</th>
                    <th>创建日期</th>
                    <th>更新日期</th>
                </tr>
                <!--tr-th end-->

                @foreach ($permissions as $per)
                    <tr>
                        <td> -</td>
                        <td>{{ $per->id }}</td>
                        <td class="text-green">{{ $per->name }}</td>
                        <td class="text-red">{{ $per->display_name }}</td>
                        <td>{{ $per->created_at }}</td>
                        <td>{{ $per->updated_at }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div>
@stop

