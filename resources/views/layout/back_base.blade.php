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
            .noscript{ width:100%;height:100%;overflow:hidden;background:#000;color:#fff;position:absolute;z-index:99999999; background-color:#000;opacity:1.0;filter:alpha(opacity=100);margin:0 auto;top:0;left:0;}
            .noscript h1{font-size:36px;margin-top:50px;text-align:center;line-height:40px;}
            html {overflow-x:hidden;overflow-y:hidden;}/*禁止出现滚动条*/
        </style>
        <div class="noscript">
            <h1>
                您的浏览器不支持JavaScript，请启用后重试！
            </h1>
        </div>
    </noscript>

@stop
@section('end_js')
    {!! script('jquery') !!}
    {!! script('bootstrap_js') !!}
    {!! script('app') !!}
    {!! script('scroll') !!}

@stop
@stop