{{--后台base--}}
@extends('base)

@section('meta')
    <meta name="csrf-token" content="{{csrf_token()}}">
@stop

@section('header_css')
    {!! style('bootstrap') !!}
    {!! style('font-awesome') !!}
    {!! style('ionicons') !!}
    {!! style('cms') !!}
    {!! style('_all-skins') !!}
    {!! style('all') !!}
@stop

@section('header_js')
    {!! script('respond') !!}
    {!! script('html5shiv') !!}
@stop

@section('body_attr')
    class="skin-black sidebar-mini"
    @stop

    @section('body')
            <!--侦测是否启用JavaScript脚本-->
    <noscript>
        <style type="text/css">
            .noscript {
                width: 100%;
                height: 100%;
                overflow: hidden;
                background: #000;
                color: #fff;
                position: absolute;
                z-index: 99999999;
                background-color: #000;
                opacity: 1.0;
                filter: alpha(opacity=100);
                margin: 0 auto;
                top: 0;
                left: 0;
            }

            .noscript h1 {
                font-size: 36px;
                margin-top: 50px;
                text-align: center;
                line-height: 40px;
            }

            html {
                overflow-x: hidden;
                overflow-y: hidden;
            }

            /*禁止出现滚动条*/
        </style>
        <div class="noscript">
            <h1>
                您的浏览器不支持JavaScript，请启用后重试！
            </h1>
        </div>
    </noscript>

    {{--主体部分--}}
    <div class="wrapper">
        {{--引入顶部header--}}
        @include('widgets.main-header')
        {{--引入左侧菜单--}}
        @include('widgets.main-sidebar')
        {{--右侧内容主体部分--}}
        <div class="content-wrapper">
            {{--右侧内容header--}}
            <section class="content-header">
                @section('content-header')
                @show
            </section>
            {{--右侧内容主体--}}
            <section class="content">

                @section('content')
                @show
            </section>
        </div>
        {{--内容footer--}}
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.3.2
            </div>
            <strong>Copyright © 2016-{{date('Y')}} <a href="#">Almsaeed Studio</a>.</strong> All rights reserved.
        </footer>
        @stop

        @section('afterBody')
                <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">

            @include('widgets.control-sidebar')

        </aside><!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
             immediately after the control sidebar -->
        <div class='control-sidebar-bg'></div>
    </div><!-- ./wrapper -->

    {{--底部js部分--}}
    {{script('jQuery')}}
    {{script('bootstrap_js')}}
    {{script('app')}}
    {{script('scroll')}}

    {{--定义引入js依赖插件部分--}}
    @section('extraPlugin')@show

{{--页面级js代码--}}
<script type="text/javascript">
    $(document).ready(function () {
        <!--左侧菜单样式统一调整-->
        {{--{{ cur_nav(Route::currentRouteName()) }}  {{ cur_nav(Route::currentRouteName()) }}  {{ cur_nav(Route::currentRouteName()) }}--}}
        $('ul.treeview-menu>li').find('a[href="#"]').closest('li').addClass('active');  //二级链接高亮
        $('ul.treeview-menu>li').find('a[href="#"]').closest('li.treeview').addClass('active');  //一级栏目[含二级链接]高亮
        $('.sidebar-menu>li').find('a[href="#"]').closest('li').addClass('active');  //一级栏目[不含二级链接]高亮

        {{-- 在document ready 里面填充一些JS代码 --}}
        @section('filledScript')
        @show
    });
</script>

<!-- 引入自身写的js-->
{{script('my_js')}}
{{--<script src="{{ asset('dist/js/yascmf.js') }}" type="text/javascript"></script>--}}

@section('extraSection')@show{{-- 补充额外的一些东东，不一定是JS，可能是HTML --}}


@stop
@stop