<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @section('title')
            {{Config::get('sysinfo.back-index-title')}}
        @show
    </title>
    {{--    <meta name="description" content="{{ isset($description) ? $description : 'YASCMF AdminLTE' }}" />
        <meta name="keywords" content="YASCMF,AdminLTE,{{ Cache::get('website_keywords') }}" />
        <meta name="author" content="{{ Cache::get('system_author_website') }}" />--}}
    <meta name="renderer" content="webkit">{{-- 360浏览器使用webkit内核渲染页面 --}}
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>{{-- IE(内核)浏览器优先使用高版本内核 --}}

    @section('meta')@show

    @section('header_css')@show

    @section('header_style')@show

    @section('header_js')@show

</head>
<body>
@yield('container')
</body>
{{--底部js--}}
@section('end_js')@show
</html>